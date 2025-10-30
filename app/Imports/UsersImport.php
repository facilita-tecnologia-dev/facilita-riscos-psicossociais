<?php

namespace App\Imports;

use App\Models\User;
use App\Rules\validateCPF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError, SkipsEmptyRows
{
    use Importable, SkipsFailures, SkipsErrors;

    public function model(array $row)
    {
        return DB::transaction(function () use ($row) {
            if ($row['nome_completo'] != null && $row['cpf'] != null) {
                $user = User::firstWhere('cpf', $row['cpf']);
                
                $birth_date = $row['data_de_nascimento'] ? $this->convertDate($row['data_de_nascimento']) : ($user ? $user->birth_date : null);
                $admission = $row['admissao'] ? $this->convertDate($row['admissao']) : ($user ? $user->admission : null);

                if ($user) {
                    $user->update([
                        'name' => $row['nome_completo'],
                        'department' => $row['setor'],
                        'occupation' => $row['cargo'],
                        'work_shift' => $row['turno'],
                        'gender' => $row['sexo'],
                        'marital_status' => $row['estado_civil'],
                        'education_level' => $row['grau_de_instrucao'],
                        'email' => $row['email'],
                        'admission' => $admission,
                        'birth_date' => $birth_date,
                    ]);
                    
                    $userAlreadyOnCompany = session('auth:company')->users()->where('users.id', $user->id)->exists();
                    if(!$userAlreadyOnCompany) session('auth:company')->users()->syncWithoutDetaching([$user->id => ['role_id' => 2]]);
                    
                    return $user;
                }

                $user = User::create([
                    'name' => $row['nome_completo'],
                    'cpf' => $row['cpf'],
                    'department' => $row['setor'],
                    'occupation' => $row['cargo'],
                    'work_shift' => $row['turno'],
                    'gender' => $row['sexo'],
                    'marital_status' => $row['estado_civil'],
                    'education_level' => $row['grau_de_instrucao'],
                    'email' => $row['email'],
                    'birth_date' => $birth_date,
                    'admission' => $admission,
                ]);

                session('auth:company')->users()->attach($user, ['role_id' => 2]);

                return $user;
            }

            return null;
        });
    }

    public function rules(): array
    {
        return [
            'nome_completo' => ['required', 'string', 'min:5', 'max:255'],
            'cpf' => ['required', 'string', new validateCPF],
            'email' => ['nullable', 'email'],
            'data_de_nascimento' => ['nullable'],
            'setor' => ['required', 'string' ,'max:255'],
            'cargo' => ['required', 'string' ,'max:255'],
            'turno' => ['nullable', 'string' ,'max:255'],
            'admissao' => ['nullable'],
            'sexo' => ['nullable', 'string'],
            'estado_civil' => ['nullable', 'string', 'max:255'],
            'grau_de_instrucao' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function convertDate($value)
    {
        // normaliza
        $value = trim((string) $value);
        if ($value === '') {
            return null;
        }

        // --- 1) Excel serial (ex.: 29500, 29500.0)
        if (is_numeric($value)) {
            try {
                // use PhpOffice\PhpSpreadsheet\Shared\Date;
                $dt = Date::excelToDateTimeObject((float) $value);
                return $dt->format('Y-m-d');
            } catch (\Throwable $e) {}
        }

        // --- 2) Se parece com dd/mm/yyyy ou dd-mm-yyyy (com ou sem hora) tente formatos explícitos
        // preferimos d/m/Y por padrão (usuário no Brasil)
        $commonFormats = ['d/m/Y', 'd-m-Y', 'd.m.Y', 'd/m/Y H:i', 'd/m/Y H:i:s', 'Y-m-d', 'Y/m/d', 'Y-m-d H:i:s', 'm/d/Y'];

        foreach ($commonFormats as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $value);
            if ($dt !== false) {
                return $dt->format('Y-m-d');
            }
        }

        try {
            return \Carbon\Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
