<section id="sign-section" class="w-screen min-h-screen overflow-y-auto flex flex-col gap-8 items-center px-3 py-12 md:px-6">
    <div class="min-h-screen flex w-full max-w-[760px] flex-col items-center justify-center gap-8">
        <div class="flex flex-col items-center gap-4">
            <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl">Assine e comece a usar agora</h2>
        </div>

        <div class="w-full space-y-4">

            {{-- Quantidade de funcionários --}}
            <div class="flex items-center flex-col sm:flex-row sm:justify-between gap-4 w-full p-6 rounded-md border border-borders shadow-sm">
                <h3 class="text-md md:text-lg text-left text-main-text font-heading font-semibold">Quantos funcionários sua empresa tem?</h3>

                <div class="flex items-center gap-2">
                    <div class="w-24">
                        <x-form.input-number wireModel="employees" wireModelType="lazy" name="employees" placeholder="50" isRequired />
                    </div>
                    <span class="text-sm md:text-md text-main-text text-right font-normal font-text">funcionários</span>
                </div>
            </div>

            {{-- Formas de pagamento --}}
            <div class="w-full grid sm:grid-cols-2 gap-4">

                <div wire:click="setPaymentType('yearly')" class="flex flex-col gap-2 w-full p-6 rounded-md border  shadow-sm cursor-pointer hover:bg-secondary-background transition {{ $paymentType->value === 'yearly' ? 'border-primary-solid' : 'border-borders' }}">
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

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Assinar agora</span>
            </x-actions.button>

            <div class="w-full flex justify-center">
                <span class="text-xs sm:text-sm text-secondary-text text-center font-normal font-text flex items-center gap-1.5">
                    <x-icon icon="locker" class="w-5 h-5 object-scale-down text-primary-solid" />
                    Pagamento processado com segurança pelo PagSeguro
                </span>
            </div>
        </div>

        <button type="button" wire:click="logout" class="text-secondary-text font-text text-left text-sm font-normal underline cursor-pointer transition hover:scale-105">
            Sair do sistema
        </button>
    </div>
</section>

