<div x-data="{ tab: 'absences' }" class="contents">
    <x-structure.page-header icon="brain" label="Indicadores Organizacionais" :breadcrumbs="['Indicadores Organizacionais' => null]" />

    <div class="bg-main-background border-borders flex items-start gap-3 rounded-lg border px-4 py-3">
        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain shrink-0 mt-0.5" />
        <span class="text-sm text-secondary-text text-left font-normal">Os indicadores organizacionais complementam a avaliação de riscos psicossociais, tornando os resultados <span class="font-semibold">mais precisos e contextualizados</span>. Registre dados de <span class="font-semibold">afastamentos</span> e <span class="font-semibold">desempenho</span> (turnover, absenteísmo, horas extras) para que o sistema correlacione esses números com os riscos identificados nas campanhas.</span>
    </div>

    {{-- TABS --}}
    <div class="w-fit flex border border-borders rounded-md">
        <button @click="tab = 'absences'" class="bg-main-background rounded-l-md cursor-pointer px-4 py-2 text-sm font-semibold transition hover:brightness-95" :class="tab === 'absences' ? 'bg-primary-solid text-main-background' : 'text-secondary-text'">
            Afastamentos
        </button>

        <button @click="tab = 'performance'" class="bg-main-background rounded-r-md cursor-pointer px-4 py-2 text-sm font-semibold transition hover:brightness-95" :class="tab === 'performance' ? 'bg-primary-solid text-main-background' : 'text-secondary-text'">
            Dados de Desempenho
        </button>
    </div>


    <div x-show="tab === 'absences'" class="contents">
        <livewire:private.psychosocial.indicator.absence-index-component>
    </div>

    <div x-show="tab === 'performance'"  class="contents">
        <livewire:private.psychosocial.indicator.organizational-indicator-edit-component>
    </div>
</div>