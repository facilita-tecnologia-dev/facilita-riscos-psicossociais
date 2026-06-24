<?php

namespace App\Livewire\Private\User;

use App\Repositories\UserRepository;
use App\Services\Subscription\CompanySubscriptionLimitService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class UserImportComponent extends Component
{
    use WithFileUploads;

    public $import_users_file;
    public Collection $importErrors;

    public function render()
    {
        return view('livewire.private.user.user-import-component');
    }
    
    public function mount()
    {
        if((session('auth:company')->hasActiveTrial() && session('auth:company')->hasReachedTrialEmployeeLimit()) || (!CompanySubscriptionLimitService::canAddEmployee(session('auth:company')))){
            return redirect()->to(route('user.index'));
        }
    }

    public function downloadTemplate()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        $path = env('AWS_IMPORT_USER_TEMPLATE_PATH') . '/modelo-importacao-funcionarios.xlsx';

        if (! $s3->exists($path)) {
            $this->dispatch('alert:danger', 'Não foi possível encontrar o arquivo. Por favor, gere-o novamente.');
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($path);
    }

    public function uploadUsersFile()
    {
        $this->validate([
            'import_users_file' => ['required', 'file', 'mimes:xlsx', 'max:' . env('IMPORT_USER_MAX_SIZE', 51200)],
        ]); 

        try {
            $importResponse = UserRepository::import(session('auth:company'), $this->import_users_file);

            if($importResponse instanceof Collection){
                $importErrors = $importResponse->map(function($validationError){
                    $username = $validationError->values()['nome_completo'] ?? 'Nome do colaborador ausente';
                    $nameBagFormatted = str_replace('_', ' ', $validationError->errors()[0]);
                    return "Linha " . $validationError->row() . " - " . $username . ' - ' . $nameBagFormatted;
                });
    
                $this->importErrors = $importErrors;
                $this->dispatch('alert:danger', 'O arquivo contém alguns erros, corrija-os e tente novamente!');
            } else {
                $this->dispatch('alert:success', 'Importação concluída com sucesso!');
                return redirect()->to(route('user.index'));
            }
        } catch (ValidationException $e) {
            $this->dispatch('alert:danger', collect($e->errors())->flatten()->first());
            return;
        }
        catch (Throwable $th) {
            Log::error('Erro ao importar arquivo de funcionários', [
                'company_id' => session('auth:company')->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao importar os funcionários. Tente novamente mais tarde.');
        }
    }
}
