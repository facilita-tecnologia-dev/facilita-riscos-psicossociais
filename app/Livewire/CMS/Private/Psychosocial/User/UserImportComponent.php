<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use App\Models\Company;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class UserImportComponent extends Component
{
    use WithFileUploads;

    public Company $company;

    public $importUsersFile;
    public Collection $importErrors;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.user.user-import-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function downloadTemplate()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        
        $file_path = 'modelos-importacao-funcionarios/modelo-importacao-funcionarios.xlsx';

        if (! $s3->exists($file_path)) {
            $this->dispatch('alert:danger', 'Arquivo não encontrado, tente novamente mais tarde.');
            return;
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($file_path);
    }

    public function uploadUsersFile()
    {
        $this->validate([
            'importUsersFile' => ['required', 'file', 'mimes:xlsx', 'max:' . env('IMPORT_USER_MAX_SIZE', 51200)],
        ]); 

        try {
            $importResponse = UserRepository::import($this->company, $this->importUsersFile);

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
                return redirect()->to(route('cms.psychosocial.user.index', $this->company));
            }
        } catch (Throwable $e) {
            $this->dispatch('alert:danger', 'Ocorreu um erro ao importar os funcionários. Tente novamente mais tarde.');
        }
    }
}
