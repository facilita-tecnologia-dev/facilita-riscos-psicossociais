<section id="sign-section" class="w-screen min-h-screen overflow-y-auto flex flex-col gap-8 items-center px-3 py-12 md:px-6">
    <div class="min-h-screen flex w-full max-w-[760px] flex-col items-center justify-center gap-8">

        {{-- ========================= STEP: PLAN ========================= --}}
        @if($step === 'plan')

            <div class="flex flex-col items-center gap-4">
                <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl">Assine e comece a usar agora</h2>
            </div>

            <div class="w-full space-y-4">

                {{-- Faixa de funcionários --}}
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

                {{-- Formas de cobrança --}}
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
                            R$ {{ $this->formattedSelected }}/{{ $paymentType->value === 'monthly' ? 'mês' : 'ano' }}
                        </span>
                    </footer>
                </div>

                <x-actions.button class="w-full" wire:click="goToPayment">
                    <div wire:loading wire:target="goToPayment">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>
                    <span wire:loading.remove wire:target="goToPayment" class="font-heading text-main-background text-center text-sm font-semibold">Continuar para pagamento</span>
                </x-actions.button>
            </div>

            <button type="button" wire:click="logout" class="text-secondary-text font-text text-left text-sm font-normal underline cursor-pointer transition hover:scale-105">
                Sair do sistema
            </button>

        {{-- ========================= STEP: PAYMENT ========================= --}}
        @elseif($step === 'payment')

            <div class="flex flex-col items-center gap-2">
                <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl">Pagamento</h2>
                <p class="text-secondary-text font-text text-sm text-center">
                    {{ $this->employeeRange }} funcionários &mdash;
                    R$ {{ $this->formattedSelected }}/{{ $paymentType->value === 'monthly' ? 'mês' : 'ano' }}
                </p>
            </div>

            <div class="w-full space-y-4">

                {{-- Seleção de método --}}
                <div class="w-full grid grid-cols-2 gap-3">
                    <button
                        type="button"
                        wire:click="setPaymentMethod('credit_card')"
                        class="flex items-center justify-center gap-2 p-4 rounded-md border text-sm font-text font-medium transition cursor-pointer
                            {{ $paymentMethod === 'credit_card'
                                ? 'border-primary-solid bg-primary-solid text-main-background'
                                : 'border-borders text-main-text hover:bg-secondary-background' }}"
                    >
                        Cartão de crédito
                    </button>

                    <button
                        type="button"
                        wire:click="setPaymentMethod('pix')"
                        class="flex items-center justify-center gap-2 p-4 rounded-md border text-sm font-text font-medium transition cursor-pointer
                            {{ $paymentMethod === 'pix'
                                ? 'border-primary-solid bg-primary-solid text-main-background'
                                : 'border-borders text-main-text hover:bg-secondary-background' }}"
                    >
                        PIX
                    </button>
                </div>

                {{-- ---- Cartão ---- --}}
                @if($paymentMethod === 'credit_card')
                    <div
                        x-data="{
                            holder: '',
                            number: '',
                            expiry: '',
                            cvv: '',
                            loading: false,
                            get expMonth() {
                                return this.expiry.split('/')[0] ?? '';
                            },
                            get expYear() {
                                const y = this.expiry.split('/')[1] ?? '';
                                return y.length === 2 ? '20' + y : y;
                            },
                            async pay() {
                                this.loading = true;
                                try {
                                    if (typeof PagSeguro === 'undefined') {
                                        $wire.set('cardError', 'Módulo de pagamento não carregado. Recarregue a página e tente novamente.');
                                        this.loading = false;
                                        return;
                                    }
                                    const result = PagSeguro.encryptCard({
                                        publicKey: $wire.publicKey,
                                        holder: this.holder.toUpperCase(),
                                        number: this.number.replace(/\D/g, ''),
                                        expMonth: this.expMonth,
                                        expYear: this.expYear,
                                        securityCode: this.cvv,
                                    });
                                    if (result.hasErrors) {
                                        $wire.set('cardError', 'Dados do cartão inválidos. Verifique e tente novamente.');
                                        this.loading = false;
                                        return;
                                    }
                                    if (!result.encryptedCard) {
                                        $wire.set('cardError', 'Não foi possível processar o cartão. Verifique os dados e tente novamente.');
                                        this.loading = false;
                                        return;
                                    }
                                    await $wire.submitCard(result.encryptedCard);
                                } catch (e) {
                                    $wire.set('cardError', 'Erro ao processar o cartão: ' + e.message);
                                }
                                this.loading = false;
                            }
                        }"
                        class="w-full space-y-4 p-6 rounded-md border border-borders shadow-sm"
                    >
                        {{-- Erro do cartão --}}
                        @if($cardError)
                            <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-md">
                                <span class="text-sm text-red-700 font-text">{{ $cardError }}</span>
                            </div>
                        @endif

                        <div class="space-y-3">
                            {{-- Número do cartão --}}
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-main-text font-text font-medium">Número do cartão</label>
                                <input
                                    type="text"
                                    x-model="number"
                                    inputmode="numeric"
                                    maxlength="19"
                                    placeholder="0000 0000 0000 0000"
                                    @input="number = $event.target.value.replace(/\D/g,'').replace(/(.{4})/g,'$1 ').trim()"
                                    class="w-full px-3 py-2 rounded-md border border-borders bg-main-background text-main-text font-text text-sm focus:outline-none focus:border-primary-solid"
                                />
                            </div>

                            {{-- Nome no cartão --}}
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-main-text font-text font-medium">Nome impresso no cartão</label>
                                <input
                                    type="text"
                                    x-model="holder"
                                    placeholder="NOME SOBRENOME"
                                    class="w-full px-3 py-2 rounded-md border border-borders bg-main-background text-main-text font-text text-sm focus:outline-none focus:border-primary-solid uppercase"
                                />
                            </div>

                            {{-- Validade + CVV --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label class="text-sm text-main-text font-text font-medium">Validade</label>
                                    <input
                                        type="text"
                                        x-model="expiry"
                                        inputmode="numeric"
                                        maxlength="5"
                                        placeholder="MM/AA"
                                        @input="
                                            let v = $event.target.value.replace(/\D/g, '');
                                            if (v.length >= 3) v = v.slice(0,2) + '/' + v.slice(2,4);
                                            expiry = v;
                                            $event.target.value = v;
                                        "
                                        class="w-full px-3 py-2 rounded-md border border-borders bg-main-background text-main-text font-text text-sm focus:outline-none focus:border-primary-solid"
                                    />
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label class="text-sm text-main-text font-text font-medium">CVV</label>
                                    <input
                                        type="text"
                                        x-model="cvv"
                                        inputmode="numeric"
                                        maxlength="4"
                                        placeholder="000"
                                        class="w-full px-3 py-2 rounded-md border border-borders bg-main-background text-main-text font-text text-sm focus:outline-none focus:border-primary-solid"
                                    />
                                </div>
                            </div>
                        </div>

                        <x-actions.button class="w-full" @click="pay()" x-bind:disabled="loading">
                            <x-icon x-show="loading" icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                            <span x-show="!loading" class="font-heading text-main-background text-center text-sm font-semibold">Pagar agora</span>
                        </x-actions.button>
                    </div>
                @endif

                {{-- ---- PIX ---- --}}
                @if($paymentMethod === 'pix')
                    <div class="w-full space-y-4 p-6 rounded-md border border-borders shadow-sm">
                        <div class="flex flex-col gap-1">
                            <h3 class="text-md text-main-text font-heading font-semibold">Pague com PIX</h3>
                            <p class="text-sm text-secondary-text font-text">Um QR Code será gerado. Você terá 24 horas para realizar o pagamento.</p>
                        </div>

                        <x-actions.button class="w-full" wire:click="submitPix">
                            <div wire:loading wire:target="submitPix">
                                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                            </div>
                            <span wire:loading.remove wire:target="submitPix" class="font-heading text-main-background text-center text-sm font-semibold">Gerar QR Code PIX</span>
                        </x-actions.button>
                    </div>
                @endif

                {{-- Segurança --}}
                <div class="w-full flex justify-center">
                    <span class="text-xs sm:text-sm text-secondary-text text-center font-normal font-text flex items-center gap-1.5">
                        <x-icon icon="locker" class="w-5 h-5 object-scale-down text-primary-solid" />
                        Pagamento processado com segurança pelo PagBank
                    </span>
                </div>

                <button type="button" wire:click="backToPlan" class="w-full text-center text-secondary-text font-text text-sm font-normal underline cursor-pointer transition hover:scale-105">
                    Voltar e alterar o plano
                </button>
            </div>

        {{-- ========================= STEP: PIX WAITING ========================= --}}
        @elseif($step === 'pix_waiting')

            <div wire:poll.3000ms="checkPixPayment" class="w-full space-y-6 flex flex-col items-center">

                <div class="flex flex-col items-center gap-2">
                    <h2 class="text-main-text font-heading text-center text-2xl font-semibold">Aguardando pagamento</h2>
                    <p class="text-secondary-text font-text text-sm text-center">Escaneie o QR Code ou copie o código PIX no seu aplicativo de banco.</p>
                </div>

                <div class="w-full max-w-sm space-y-4 p-6 rounded-md border border-borders shadow-sm flex flex-col items-center">

                    {{-- QR Code (imagem ou placeholder) --}}
                    @if($pixQrCodeImage)
                        <img src="{{ $pixQrCodeImage }}" alt="QR Code PIX" class="w-48 h-48 object-contain" />
                    @else
                        <div class="w-48 h-48 bg-secondary-background rounded-md flex items-center justify-center">
                            <x-icon icon="loading" class="w-8 h-8 text-secondary-text animate-spin" />
                        </div>
                    @endif

                    {{-- Código PIX --}}
                    @if($pixQrCodeText)
                        <div
                            x-data="{ copied: false }"
                            class="w-full"
                        >
                            <div class="w-full px-3 py-2 rounded-md border border-borders bg-secondary-background">
                                <p class="text-xs text-secondary-text font-text break-all select-all">{{ $pixQrCodeText }}</p>
                            </div>
                            <button
                                type="button"
                                @click="navigator.clipboard.writeText('{{ $pixQrCodeText }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2 rounded-md border border-borders text-sm font-text font-medium text-main-text hover:bg-secondary-background transition cursor-pointer"
                            >
                                <span x-show="!copied">Copiar código PIX</span>
                                <span x-show="copied" class="text-green-600">Copiado!</span>
                            </button>
                        </div>
                    @endif

                    <div class="flex items-center gap-2 mt-2">
                        <x-icon icon="loading" class="w-4 h-4 text-secondary-text animate-spin" />
                        <span class="text-sm text-secondary-text font-text">Verificando pagamento automaticamente...</span>
                    </div>
                </div>

                @if($pixExpiresAt)
                    <p class="text-xs text-secondary-text font-text text-center">
                        QR Code válido até {{ \Carbon\Carbon::parse($pixExpiresAt)->format('d/m/Y H:i') }}
                    </p>
                @endif

                <button type="button" wire:click="backToPayment" class="text-secondary-text font-text text-sm font-normal underline cursor-pointer transition hover:scale-105">
                    Quero usar outro método de pagamento
                </button>

            </div>

        @endif

    </div>
</section>
