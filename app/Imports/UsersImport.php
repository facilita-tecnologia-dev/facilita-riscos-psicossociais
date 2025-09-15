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
            if ($row['nome_completo'] != null) {
                
                $birth_date = $this->convertDate($row['data_de_nascimento']) ?? null;
                $admission = $this->convertDate($row['admissao']);
                $user = User::firstWhere('cpf', $row['cpf']);

                if ($user) {
                    $user->update([
                        'name' => $row['nome_completo'],
                        'birth_date' => $birth_date,
                        'department' => $row['setor'],
                        'occupation' => $row['cargo'],
                        'work_shift' => $row['turno'],
                        'admission' => $admission,
                        'gender' => $row['sexo'] ?? null,
                        'marital_status' => $row['estado_civil'] ?? null,
                        'education_level' => $row['grau_de_instrucao'] ?? null,
                        'email' => $row['email'] ?? null,
                    ]);
                
                    $user->companies()->syncWithoutDetaching([
                        session('company')->id => ['role_id' => 2]
                    ]);
                
                    return $user;
                }

                $user = User::create([
                    'name' => $row['nome_completo'],
                    'birth_date' => $birth_date,
                    'cpf' => $row['cpf'],
                    'department' => $row['setor'],
                    'occupation' => $row['cargo'],
                    'work_shift' => $row['turno'],
                    'admission' => $admission,
                    'gender' => $row['sexo'] ?? '',
                    'marital_status' => $row['estado_civil'] ?? '',
                    'education_level' => $row['grau_de_instrucao'] ?? '',
                    'email' => $row['email'] ?? '',
                ]);

                $user->companies()->attach(session('company')->id, ['role_id' => 2]);

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
            'turno' => ['required', 'string' ,'max:255'],
            'admissao' => ['required'],
            'sexo' => ['nullable', 'string'],
            'estado_civil' => ['nullable', 'string', 'max:255'],
            'grau_de_instrucao' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function convertDate($value)
    {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
