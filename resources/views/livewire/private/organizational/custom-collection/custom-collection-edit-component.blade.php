<div class="contents">
    <x-new-components.structure.page-header icon="cloud" label="Customizar Formulário" :breadcrumbs="['Formulários de Pesquisa de Clima' => route('organizational.custom-collection.index'), 'Customizar Formulário' => null]" />

    <div class="border-borders bg-main-background flex flex-col gap-3 rounded-lg border p-4">
        <form class="flex flex-col md:flex-row md:items-end gap-3 md:gap-4" wire:submit.prevent="filter">
            <x-new-components.form.select wireModel="group" name="group" label="Grupo" placeholder="Selecione o grupo" tooltip="Selecione o grupo" :options="$groups" />

            <div class="w-full md:w-fit"> 
                <x-new-components.actions.button type="submit">
                    <div wire:loading wire:target="filter">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="filter" class="font-heading text-main-background text-center text-sm font-semibold">Filtrar</span>
                </x-new-components.actions.button>
            </div>
        </form>
    </div>

    <div class="border-borders bg-main-background flex flex-col gap-6 rounded-lg border p-4">
        <header class="flex items-center justify-between">
            <h2 class="text-main-text font-heading text-left text-lg font-semibold">Valor das opções</h2>

            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Esta legenda mostra como cada opção de resposta é avaliada. Ela é fixa e não pode ser alterada, por isso, revise com atenção ao escrever o enunciado da questão.">
                <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
            </div>
        </header>

        <div class="space-y-3">
            <span class="block text-base text-main-text text-left font-normal">Abaixo você vê o conteúdo e o valor de cada opção de resposta. Elas são iguais para todas as questões e não podem ser editadas.</span>

            <div class="flex items-center gap-2 lg:gap-4 flex-wrap">
                @foreach (array_reverse(App\Enums\OC\OCOption::cases()) as $option)
                    <span class="p-2 bg-borders text-sm rounded-sm text-main-text text-left font-normal">
                        {{ $option->label() }} ({{ $option->value }})
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
        @foreach ($questions as $group => $groupQuestions)
            <div class="border-borders bg-secondary-background flex flex-col gap-4 rounded-lg border p-4">
                <header class="flex items-center justify-between">
                    <h2 class="text-main-text font-heading text-left text-lg font-semibold">{{ App\Enums\OC\OCgroup::from($group)->label() }}</h2>

                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode editar as questões do grupo '{{ App\Enums\OC\OCgroup::from($group)->label() }}'">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <div class="flex flex-col gap-3">
                    @foreach ($groupQuestions as $question)
                        <livewire:private.organizational.custom-collection.custom-collection-question-component wire:key='{{ uniqid() }}' :question="$question" />
                    @endforeach
                </div>

                <button wire:click='create("{{ $group }}")' class="w-full bg-borders flex justify-center items-center py-2 px-4 rounded-sm cursor-pointer hover:brightness-95 transition">
                    <span wire:loading.remove wire:target='create("{{ $group }}")' class="text-xs text-center text-main-text font-normal">Adicionar questão</span>
                    
                    <div wire:loading wire:target='create("{{ $group }}")'>
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>
                </button>
            </div>
        @endforeach
    </section>
</div>