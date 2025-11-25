<?php

namespace App\Livewire\Private\Home;

use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class CompanyHomeImportUsersComponent extends Component
{
    use WithFileUploads;

    public $importUsersFile;
    public Collection $importErrors;

    public function render()
    {
        return view('livewire.private.home.company-home-import-users-component');
    }

    public function nextStep()
    {
        $this->dispatch('step-by-step:next', 'import-users');
    }

    public function downloadTemplate()
    {
        $filePath = 'files/template-importacao-de-funcionarios-facilita.xlsx';

         if (!Storage::exists($filePath)) return $this->dispatch('alert:danger', 'Arquivo não encontrado, tente novamente mais tarde.');

        return Storage::download($filePath, 'facilita-arquivo-modelo-importacao-funcionarios.xlsx');
    }

    public function submit()
    {
        $this->validate([
            'importUsersFile' => ['required', 'file', 'mimes:xlsx', 'max:' . env('IMPORT_USER_MAX_SIZE', 51200)],
        ]); 

        try {
            $importResponse = UserRepository::import(session('auth:company'), $this->importUsersFile);

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
                $this->nextStep();
            }
        } catch (Throwable $e) {
            $this->dispatch('alert:danger', 'Ocorreu um erro ao importar os funcionários. Tente novamente mais tarde.');
        }
    }
}
