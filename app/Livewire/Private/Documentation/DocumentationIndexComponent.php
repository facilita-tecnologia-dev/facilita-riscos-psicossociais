<?php

namespace App\Livewire\Private\Documentation;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DocumentationIndexComponent extends Component
{
    public function render()
    {
        return view('livewire.private.documentation.documentation-index-component');
    }

    public function downloadMetodology()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        
        $file_path = config('app.aws-documentation-path') . '/' . (session('auth:company')->usesHSE() ? 'metodologia/riscos-psicossociais-hse.pdf' : 'metodologia/riscos-psicossociais-proart.pdf');;

        if (! $s3->exists($file_path)) {
            $this->dispatch('alert:danger', 'Arquivo não encontrado, tente novamente mais tarde.');
            return;
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($file_path);
    }

    public function downloadPolicy()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        
        $file_path = config('app.aws-documentation-path') . '/' . 'seguranca/politica-de-privacidade-psicossociais.pdf';

        if (! $s3->exists($file_path)) {
            $this->dispatch('alert:danger', 'Arquivo não encontrado, tente novamente mais tarde.');
            return;
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($file_path);
    }

    public function downloadTerms()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        
        $file_path = config('app.aws-documentation-path') . '/' . 'seguranca/termo-de-confidencialidade-psicossociais.pdf';

        if (! $s3->exists($file_path)) {
            $this->dispatch('alert:danger', 'Arquivo não encontrado, tente novamente mais tarde.');
            return;
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($file_path);
    }

} 
