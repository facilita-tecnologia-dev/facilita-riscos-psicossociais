<div class="contents">
    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input-number wireModel="turnover" name="turnover" sufix="%" step="0.1" label="{{ App\Enums\Psychosocial\Indicator::TURNOVER->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\Indicator::TURNOVER->label()) . ' na sua empresa nos últimos 12 meses...'" tooltip="Cálculo: (Nº de funcionários que saíram durante o ano / quadro médio) * 100" />
            <x-form.input-number wireModel="absenteeism" name="absenteeism" sufix="%" step="0.1" label="{{ App\Enums\Psychosocial\Indicator::ABSENTEEISM->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\Indicator::ABSENTEEISM->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: (Nº de horas de faltas, atestados / Nº de horas trabalhadas disponíveis) * 100 <br/> OBS: Horas disponíveis: nº de funcionários * nº de horas produtivas disponíveis no mês" />
            <x-form.input-number wireModel="extra_hours" name="extra_hours" sufix="%" step="0.1" label="{{ App\Enums\Psychosocial\Indicator::EXTRA_HOURS->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\Indicator::EXTRA_HOURS->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: Nº total de horas extras / Nº de horas trabalhadas * 100" />
            <x-form.input-number wireModel="reports" name="reports" sufix="%" step="0.1" label="{{ App\Enums\Psychosocial\Indicator::REPORTS->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\Indicator::REPORTS->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: Nº total de acidentes / Nº de funcionários * 100" />
        </div>
        
        <x-actions.button>
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
        </x-actions.button>
    </form>
</div>
