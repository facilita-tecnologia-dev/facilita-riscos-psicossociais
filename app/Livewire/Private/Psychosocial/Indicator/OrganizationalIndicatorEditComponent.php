<?php

namespace App\Livewire\Private\Psychosocial\Indicator;

use App\Enums\Psychosocial\Indicator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrganizationalIndicatorEditComponent extends Component
{
    public Collection $indicators;

    public ?string $extra_hours = null;
    public ?string $absenteeism = null;
    public ?string $turnover = null;
    public ?string $reports = null;

    public function render()
    {
        return view('livewire.private.psychosocial.indicator.organizational-indicator-edit-component');
    }

    public function mount()
    {
        $this->indicators =  session('auth:company')->organizationalIndicators()->with('indicator')->get()->keyBy('indicator.type');
  
        $this->extra_hours = $this->indicators->get(Indicator::EXTRA_HOURS->value)->value;
        $this->absenteeism = $this->indicators->get(Indicator::ABSENTEEISM->value)->value;
        $this->turnover = $this->indicators->get(Indicator::TURNOVER->value)->value;
        $this->reports = $this->indicators->get(Indicator::REPORTS->value)->value;
    }

    public function submit()
    {
        $this->validate([
            "extra_hours" => ['nullable', 'between:0,100'],
            "absenteeism" => ['nullable', 'between:0,100'],
            "turnover" => ['nullable', 'between:0,100'],
            "reports" => ['nullable', 'between:0,100'],
        ]);

        try {
            DB::transaction(function(){
                $this->indicators->get(Indicator::EXTRA_HOURS->value)->update(['value' => $this->extra_hours === '' ? null : $this->extra_hours]);
                $this->indicators->get(Indicator::ABSENTEEISM->value)->update(['value' => $this->absenteeism === '' ? null : $this->absenteeism]);
                $this->indicators->get(Indicator::TURNOVER->value)->update(['value' => $this->turnover === '' ? null : $this->turnover]);
                $this->indicators->get(Indicator::REPORTS->value)->update(['value' => $this->reports === '' ? null : $this->reports]);
            });
            
            $this->dispatch('alert:success', 'Dados de Desempenho atualizados com sucesso!');
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar dados de desempenho', [
                'company' => session('auth:company')->id,
                'extra_hours' => $this->extra_hours,
                'absenteeism' => $this->absenteeism,
                'turnover' => $this->turnover,
                'reports' => $this->reports,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar os dados de desempenho.');
        }

    }
}
