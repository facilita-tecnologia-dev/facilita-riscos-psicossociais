<?php

namespace App\Livewire\Private\Psychosocial\Indicator;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\PROART\PROARTHazard;
use App\Enums\Psychosocial\PROART\PROARTIndicator;
use App\Models\BaseCollection;
use App\Models\Hazard;
use App\Services\ReportChannel\ReportChannelService;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class IndicatorEditComponent extends Component
{
    public EloquentCollection $indicators;

    public ?string $turnover = null;
    public ?string $absenteeism = null;
    public ?string $extra_hours = null;
    public ?string $accidents = null;
    public ?string $absences = null;

    public bool $hasReportChannel;
    public Collection $reports;
    
    public ?string $moral_harassment = null;
    public ?string $sexual_harassment = null;
    public ?string $discrimination = null;
    public ?string $other_forms_of_violence = null;


    public function render()
    {
        return view('livewire.private.psychosocial.indicator.indicator-edit-component');
    }

    public function mount()
    {
        // Indicators
        $this->indicators =  session('auth:company')->proartIndicators()->with('indicator')->get()->keyBy('indicator.type');
        $this->turnover = $this->indicators->get(PROARTIndicator::TURNOVER->value)->value;
        $this->absenteeism = $this->indicators->get(PROARTIndicator::ABSENTEEISM->value)->value;
        $this->extra_hours = $this->indicators->get(PROARTIndicator::EXTRA_HOURS->value)->value;
        $this->accidents = $this->indicators->get(PROARTIndicator::ACCIDENTS->value)->value;
        $this->absences = $this->indicators->get(PROARTIndicator::ABSENCES->value)->value;

        // Reports
        $this->hasReportChannel = ReportChannelService::hasReportChannel(session('auth:company'));

        if($this->hasReportChannel){
            $baseCollection = BaseCollection::firstWhere('key', MetodologyType::PROART);
            $hazards = Hazard::where('base_collection_id', $baseCollection->id)->get();

            $reportChannelReports = ReportChannelService::reports(session('auth:company'));
            $this->reports = $hazards->mapWithKeys(fn($risk) => [$risk->type => $reportChannelReports->get($risk->type, 0)])->sortDesc();
        } else{
            $this->reports = session('auth:company')->reports()->get();

            $this->moral_harassment = $this->reports->where('type', PROARTHazard::MORAL_HARASSMENT->value)->first()->value;
            $this->sexual_harassment = $this->reports->where('type', PROARTHazard::SEXUAL_HARASSMENT->value)->first()->value;
            $this->discrimination = $this->reports->where('type', PROARTHazard::DISCRIMINATION->value)->first()->value;
            $this->other_forms_of_violence = $this->reports->where('type', PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->first()->value;
        }
    }

    public function updateIndicators()
    {
        $this->validate([
            "turnover" => ['nullable', 'between:0,100'],
            "absenteeism" => ['nullable', 'between:0,100'],
            "extra_hours" => ['nullable', 'between:0,100'],
            "accidents" => ['nullable', 'between:0,100'],
            "absences" => ['nullable', 'between:0,100'],
        ]);

        try {
            DB::transaction(function(){
                $this->indicators->get(PROARTIndicator::TURNOVER->value)->update(['value' => $this->turnover === '' ? null : $this->turnover]);
                $this->indicators->get(PROARTIndicator::ABSENTEEISM->value)->update(['value' => $this->absenteeism === '' ? null : $this->absenteeism]);
                $this->indicators->get(PROARTIndicator::EXTRA_HOURS->value)->update(['value' => $this->extra_hours === '' ? null : $this->extra_hours]);
                $this->indicators->get(PROARTIndicator::ACCIDENTS->value)->update(['value' => $this->accidents === '' ? null : $this->accidents]);
                $this->indicators->get(PROARTIndicator::ABSENCES->value)->update(['value' => $this->absences === '' ? null : $this->absences]);
            });
            
            $this->dispatch('alert:success', 'Dados de Desempenho atualizados com sucesso!');
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar dados de desempenho', [
                'company' => session('auth:company')->id,
                'turnover' => $this->turnover,
                'absenteeism' => $this->absenteeism,
                'extra_hours' => $this->extra_hours,
                'accidents' => $this->accidents,
                'absences' => $this->absences,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar os dados de desempenho.');
        }

    }

    public function updateReports()
    {
        $this->validate([
            "moral_harassment" => ['nullable', 'between:0,100'],
            "sexual_harassment" => ['nullable', 'between:0,100'],
            "discrimination" => ['nullable', 'between:0,100'],
            "other_forms_of_violence" => ['nullable', 'between:0,100'],
        ]);

        try {
            DB::transaction(function(){
                $this->reports->where('type', PROARTHazard::MORAL_HARASSMENT->value)->first()->update(['value' => $this->moral_harassment === '' ? null : $this->moral_harassment]);
                $this->reports->where('type', PROARTHazard::SEXUAL_HARASSMENT->value)->first()->update(['value' => $this->sexual_harassment === '' ? null : $this->sexual_harassment]);
                $this->reports->where('type', PROARTHazard::DISCRIMINATION->value)->first()->update(['value' => $this->discrimination === '' ? null : $this->discrimination]);
                $this->reports->where('type', PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->first()->update(['value' => $this->other_forms_of_violence === '' ? null : $this->other_forms_of_violence]);
            });
            
            $this->dispatch('alert:success', 'Dados atualizados com sucesso!');
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar os dados sobre denúncias', [
                'company' => session('auth:company')->id,
                'moral_harassment' => $this->moral_harassment,
                'sexual_harassment' => $this->sexual_harassment,
                'discrimination' => $this->discrimination,
                'other_forms_of_violence' => $this->other_forms_of_violence,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar os dados sobre denúncias.');
        }
    }
}
