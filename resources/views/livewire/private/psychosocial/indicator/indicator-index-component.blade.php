<div x-data="{ tab: 'absences' }" class="contents">
    <x-structure.page-header icon="brain" label="Indicadores Organizacionais" :breadcrumbs="['Indicadores Organizacionais' => null]" />

    {{-- TABS --}}
    <div class="w-fit flex border border-borders rounded-md overflow-hidden">
        <button @click="tab = 'absences'" class="bg-main-background cursor-pointer px-4 py-2 text-sm font-semibold transition hover:brightness-95" :class="tab === 'absences' ? 'bg-primary-solid text-main-background' : 'text-secondary-text'">
            Afastamentos
        </button>

        <button @click="tab = 'performance'" class="bg-main-background cursor-pointer px-4 py-2 text-sm font-semibold transition hover:brightness-95" :class="tab === 'performance' ? 'bg-primary-solid text-main-background' : 'text-secondary-text'">
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