<div class="contents">
    <x-new-components.structure.page-header icon="brain" label="Dados de Desempenho Organizacional" :breadcrumbs="['Dados de Desempenho Organizacional' => null]" />

    <div id="indicators">
        <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="updateIndicators">
            <header class="flex items-center justify-between">
                <h2 class="text-main-text font-heading text-left text-lg font-semibold">Dados de Desempenho</h2>

                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Preencha, se disponível, os dados de desempenho no formulário abaixo. Essas informações contribuem para uma avaliação mais precisa dos riscos psicossociais.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-new-components.form.input-number wireModel="turnover" name="turnover" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTIndicator::TURNOVER->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\PROART\PROARTIndicator::TURNOVER->label()) . ' na sua empresa nos últimos 12 meses...'" tooltip="Cálculo: (Nº de funcionários que saíram durante o ano / quadro médio) * 100" />
                <x-new-components.form.input-number wireModel="absenteeism" name="absenteeism" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTIndicator::ABSENTEEISM->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\PROART\PROARTIndicator::ABSENTEEISM->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: (Nº de horas de faltas, atestados / Nº de horas trabalhadas disponíveis) * 100 <br/> OBS: Horas disponíveis: nº de funcionários * nº de horas produtivas disponíveis no mês" />
                <x-new-components.form.input-number wireModel="extra_hours" name="extra_hours" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTIndicator::EXTRA_HOURS->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\PROART\PROARTIndicator::EXTRA_HOURS->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: Nº total de horas extras / Nº de horas trabalhadas * 100" />
                <x-new-components.form.input-number wireModel="accidents" name="accidents" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTIndicator::ACCIDENTS->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\PROART\PROARTIndicator::ACCIDENTS->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: Nº total de acidentes / Nº de funcionários * 100" />
                <x-new-components.form.input-number wireModel="absences" name="absences" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTIndicator::ABSENCES->label() }}" :placeholder="'Digite a porcentagem de ' . strtolower(App\Enums\Psychosocial\PROART\PROARTIndicator::ABSENCES->label()) . ' na sua empresa nos últimos 12 meses...'"  tooltip="Cálculo: Nº total de afastamentos / Nº de funcionários * 100" />
            </div>

            <x-new-components.actions.button>
                <div wire:loading wire:target="updateIndicators">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="updateIndicators" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
            </x-new-components.actions.button>
        </form>
    </div>

    <div id="reports">
        @if($hasReportChannel && $reports && $reports->isNotEmpty())
            <div class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6">
                <header class="flex items-center justify-between">
                    <h2 class="text-main-text font-heading text-left text-lg font-semibold">Denúncias Recebidas</h2>

                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Estas informações foram obtidas a partir das denúncias registradas pela sua empresa no Facilita Canal de Denúncias">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <p class="text-sm text-main-text">Estamos acessando sua conta no <span class="font-semibold">Facilita Canal de Denúncias</span> para recuperar os dados disponíveis.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($reports as $risk => $count)
                        <div class="w-full border border-borders rounded-sm py-2 px-4 flex items-center justify-between">
                            <span class="text-main-text font-normal text-left text-sm">{{ App\Enums\Psychosocial\PROART\PROARTHazard::from($risk)->label() }}</span>
                            <span class="text-main-text font-normal text-left text-sm">{{ $count }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="updateReports">
                <header class="flex items-center justify-between">
                    <h2 class="text-main-text font-heading text-left text-lg font-semibold">Denúncias Recebidas</h2>

                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Como você ainda não utiliza o Facilita Canal de Denúncias, por favor, informe a quantidade de denúncias em cada risco abaixo, se tiver conhecimento">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <p class="text-sm text-main-text">Como você ainda não utiliza o Facilita Canal de Denúncias, por favor, informe a quantidade de denúncias em cada risco abaixo, se tiver conhecimento.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-new-components.form.input-number wireModel="moral_harassment" name="moral_harassment" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTHazard::MORAL_HARASSMENT->label() }}" placeholder="Digite a porcentagem de denúncias recebidas..." tooltip="Cálculo: (nº de denúncias recebidas / nº de funcionários) * 100" />
                    <x-new-components.form.input-number wireModel="sexual_harassment" name="sexual_harassment" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTHazard::SEXUAL_HARASSMENT->label() }}" placeholder="Digite a porcentagem de denúncias recebidas"  tooltip="Cálculo: (nº de denúncias recebidas / nº de funcionários) * 100" />
                    <x-new-components.form.input-number wireModel="discrimination" name="discrimination" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTHazard::DISCRIMINATION->label() }}" placeholder="Digite a porcentagem de denúncias recebidas"  tooltip="Cálculo: (nº de denúncias recebidas / nº de funcionários) * 100" />
                    <x-new-components.form.input-number wireModel="other_forms_of_violence" name="other_forms_of_violence" sufix="%" label="{{ App\Enums\Psychosocial\PROART\PROARTHazard::OTHER_FORMS_OF_VIOLENCE->label() }}" placeholder="Digite a porcentagem de denúncias recebidas"  tooltip="Cálculo: (nº de denúncias recebidas / nº de funcionários) * 100" />
                </div>

                <x-new-components.actions.button>
                    <div wire:loading wire:target="updateReports">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="updateReports" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
                </x-new-components.actions.button>
            </form>
        @endif
    </div>
</div>
