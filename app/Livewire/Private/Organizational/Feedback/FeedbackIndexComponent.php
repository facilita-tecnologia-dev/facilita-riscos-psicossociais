<?php

namespace App\Livewire\Private\Organizational\Feedback;

use App\Exports\FeedbacksExport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class FeedbackIndexComponent extends Component
{
    public Collection $feedbacks;

    public function render()
    {
        return view('livewire.private.organizational.feedback.feedback-index-component');
    }

    public function mount()
    {
        $this->feedbacks = session('auth:company')->feedbacks()->with(['user'])->get();
    }

    public function exportFeedbacks()
    {
        try {
            return Excel::download(new FeedbacksExport, 'feedbacks-pesquisa-de-clima-'  . Str::slug(session('auth:company')->name) . '.xlsx');
        } catch (\Throwable $th) {
            Log::error('Erro ao gerar o relatório.', [
                'company' => session('auth:company')->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao gerar o relatório.');
        }
    }
}
