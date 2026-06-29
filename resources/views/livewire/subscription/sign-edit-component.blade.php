<div class="contents" x-data="{ signEditModalOpen: false }" x-on:open-sign-edit-modal.window="signEditModalOpen = true" x-on:close-sign-edit-modal.window="signEditModalOpen = false">
    <x-actions.button wire:click="openSignEditModal" type="button">
        <div wire:loading wire:target="openSignEditModal">
            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
        </div>
        <span wire:loading.remove wire:target="openSignEditModal" class="font-heading text-main-background text-center text-sm font-semibold">Alterar plano</span>
    </x-actions.button>

    <div x-show="signEditModalOpen" x-transition.opacity x-cloak class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div x-on:click.away="$wire.closeSignEditModal()" class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-2xl rounded-lg border p-6 shadow-sm">

            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Alterar plano de assinatura</h2>
                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Altere a faixa de funcionários ou a forma de cobrança separadamente.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <div class="w-full space-y-4">
                @if($subscription->hasScheduledTypeChange())
                    <div class="px-4 py-2 bg-alert/20 border border-alert rounded-md flex items-start flex-col gap-1">
                        <span class="text-sm text-left text-main-text font-normal">
                            Sua forma de cobrança será alterada de {{ $subscription->type->label() }} para {{ $subscription->scheduled_type->label() }} na próxima renovação ({{ $subscription->current_period_end->format('d/m/y') }}).
                        </span>
                    </div>
                @endif

                {{-- Quantidade de funcionários --}}
                <div class="flex flex-col gap-4 w-full p-6 rounded-md border border-borders shadow-sm">
                    <h3 class="text-md md:text-lg text-left text-main-text font-heading font-semibold">Quantos funcionários sua empresa tem?</h3>

                    <div class="flex flex-wrap gap-2">
                        @foreach($employeeTiers as $tier)
                            <button
                                type="button"
                                wire:click="setEmployees({{ $tier['value'] }})"
                                class="px-4 py-2 rounded-md border text-sm font-text font-medium transition cursor-pointer
                                    {{ $employees === $tier['value']
                                        ? 'border-primary-solid bg-primary-solid text-main-background'
                                        : 'border-borders text-main-text hover:bg-secondary-background' }}"
                            >
                                {{ $tier['label'] }}
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Formas de pagamento --}}
                <div class="w-full grid sm:grid-cols-2 gap-4">
                    <div wire:click="setPaymentType('yearly')" class="flex flex-col gap-2 w-full p-6 rounded-md border shadow-sm cursor-pointer hover:bg-secondary-background transition {{ $paymentType->value === 'yearly' ? 'border-primary-solid' : 'border-borders' }}">
                        <h3 class="text-md md:text-lg text-left text-main-text font-heading font-semibold">Pagamento único anual</h3>
                        <span class="text-xl md:text-2xl text-left font-semibold font-text transition {{ $paymentType->value === 'yearly' ? 'text-primary-solid' : 'text-main-text' }}">R$ {{ $this->formattedYearly }}</span>
                        <span class="text-sm md:text-md text-secondary-text text-left font-normal font-text">pagamento único por ano</span>
                    </div>

                    <div wire:click="setPaymentType('monthly')" class="flex flex-col gap-2 w-full p-6 rounded-md border shadow-sm cursor-pointer hover:bg-secondary-background transition {{ $paymentType->value === 'monthly' ? 'border-primary-solid' : 'border-borders' }}">
                        <h3 class="text-md md:text-lg text-left text-main-text font-heading font-semibold">Parcelado em 12x</h3>
                        <span class="text-xl md:text-2xl text-left font-semibold font-text transition {{ $paymentType->value === 'monthly' ? 'text-primary-solid' : 'text-main-text' }}">R$ {{ $this->formattedMonthly }}</span>
                        <span class="text-sm md:text-md text-secondary-text text-left font-normal font-text">por mês, no cartão</span>
                    </div>
                </div>

                {{-- Resumo --}}
                <div class="w-full space-y-4 p-6 rounded-md border border-borders shadow-sm">
                    <h3 class="text-md md:text-lg text-left text-main-text font-heading font-semibold">Resumo da assinatura</h3>

                    <ul class="w-full space-y-2">
                        <li class="w-full flex items-center justify-between gap-4">
                            <span class="text-sm sm:text-md text-left text-secondary-text font-text font-normal">Faixa de funcionários</span>
                            <span class="text-sm sm:text-md text-right text-main-text font-text font-semibold">{{ $this->employeeRange }}</span>
                        </li>
                        <li class="w-full flex items-center justify-between gap-4">
                            <span class="text-sm sm:text-md text-left text-secondary-text font-text font-normal">Forma de pagamento</span>
                            <span class="text-sm sm:text-md text-right text-main-text font-text font-semibold">{{ $paymentType->value === 'monthly' ? 'Parcelado em 12x' : 'Anual' }}</span>
                        </li>
                    </ul>

                    <footer class="w-full flex items-center justify-between gap-4 border-t border-borders pt-4">
                        <span class="text-md md:text-lg text-left text-main-text font-text font-semibold">Total</span>
                        <span class="text-md md:text-lg text-right text-main-text font-text font-semibold">
                            @if($paymentType->value === 'monthly')
                                R$ {{ $this->formattedMonthly }}/mês
                            @else
                                R$ {{ $this->formattedYearly }}/ano
                            @endif
                        </span>
                    </footer>
                </div>

                <x-actions.button class="w-full" wire:click="submit">
                    <div wire:loading wire:target="submit">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>
                    <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Confirmar alteração</span>
                </x-actions.button>

                <div class="w-full flex justify-center">
                    <span class="text-xs sm:text-sm text-secondary-text text-center font-normal font-text flex items-center gap-1.5">
                        <x-icon icon="locker" class="w-5 h-5 object-scale-down text-primary-solid" />
                        Pagamento processado com segurança pelo PagBank
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
