<div>
    <div
        x-show="$wire.open"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4"
    >
        @if($open && $payment)
        <div class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-2xl rounded-lg border p-6 shadow-sm">

            {{-- ========================= STEP: PAYMENT ========================= --}}
            @if($step === 'payment')

                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">
                        {{ match($payment->kind) {
                            \App\Enums\Subscription\PaymentKind::INITIAL    => 'Assinatura inicial',
                            \App\Enums\Subscription\PaymentKind::RENEWAL    => 'Renovação de assinatura',
                            \App\Enums\Subscription\PaymentKind::PLAN_CHANGE => 'Alteração de plano',
                        } }}
                    </h2>
                    <button type="button" wire:click="close" class="text-secondary-text transition hover:scale-105 cursor-pointer">
                        <x-icon icon="x-mark" class="w-5 h-5" />
                    </button>
                </header>

                <span class="text-sm font-text font-semibold text-main-text">
                    R$ {{ number_format($payment->amount / 100, 2, ',', '.') }}
                    -
                    Vence em {{ $payment->due_date->format('d/m/Y') }}
                </span>

                <div
                    x-data="{
                        holder: '', number: '', expiry: '', cvv: '', loading: false,
                        get expMonth() { return this.expiry.split('/')[0] ?? ''; },
                        get expYear() { const y = this.expiry.split('/')[1] ?? ''; return y.length === 2 ? '20' + y : y; },
                        async pay() {
                            this.loading = true;
                            if (typeof PagSeguro === 'undefined') {
                                $wire.set('cardError', 'Módulo de pagamento não carregado. Recarregue a página e tente novamente.');
                                this.loading = false; return;
                            }
                            const result = PagSeguro.encryptCard({
                                publicKey: $wire.publicKey,
                                holder: this.holder,
                                number: this.number.replace(/\s/g, ''),
                                expMonth: this.expMonth,
                                expYear: this.expYear,
                                securityCode: this.cvv,
                            });
                            if (result.hasErrors) {
                                $wire.set('cardError', 'Dados do cartão inválidos. Verifique e tente novamente.');
                                this.loading = false; return;
                            }
                            if (!result.encryptedCard) {
                                $wire.set('cardError', 'Não foi possível processar o cartão. Tente novamente.');
                                this.loading = false; return;
                            }
                            await $wire.submitCard(result.encryptedCard);
                            this.loading = false;
                        }
                    }"
                    class="w-full space-y-4"
                >
                    {{-- Tabs --}}
                    <div class="flex gap-2">
                        <button type="button" wire:click="setPaymentMethod('credit_card')"
                            class="px-4 py-2 rounded-md border text-sm font-text font-medium transition cursor-pointer
                                {{ $paymentMethod === 'credit_card' ? 'border-primary-solid bg-primary-solid text-main-background' : 'border-borders text-main-text hover:bg-secondary-background' }}">
                            Cartão de crédito
                        </button>
                        <button type="button" wire:click="setPaymentMethod('pix')"
                            class="px-4 py-2 rounded-md border text-sm font-text font-medium transition cursor-pointer
                                {{ $paymentMethod === 'pix' ? 'border-primary-solid bg-primary-solid text-main-background' : 'border-borders text-main-text hover:bg-secondary-background' }}">
                            PIX
                        </button>
                    </div>

                    {{-- Formulário cartão --}}
                    <div x-show="$wire.paymentMethod === 'credit_card'" class="w-full space-y-3">
                        <div class="grid sm:grid-cols-2 gap-3">
                            <div class="flex flex-col gap-1 sm:col-span-2">
                                <label class="text-sm text-main-text font-text font-medium">Nome no cartão</label>
                                <input type="text" x-model="holder" placeholder="Como está impresso no cartão"
                                    class="w-full px-3 py-2 rounded-md border border-borders text-sm font-text text-main-text bg-main-background focus:outline-none focus:border-primary-solid" />
                            </div>
                            <div class="flex flex-col gap-1 sm:col-span-2">
                                <label class="text-sm text-main-text font-text font-medium">Número do cartão</label>
                                <input type="text" x-model="number" placeholder="0000 0000 0000 0000" maxlength="19"
                                    @input="number = number.replace(/\D/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').trim()"
                                    class="w-full px-3 py-2 rounded-md border border-borders text-sm font-text text-main-text bg-main-background focus:outline-none focus:border-primary-solid" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-main-text font-text font-medium">Validade</label>
                                <input type="text" x-model="expiry" placeholder="MM/AA" maxlength="5"
                                    @input="expiry = expiry.replace(/\D/g, '').replace(/(\d{2})(\d)/, '$1/$2')"
                                    class="w-full px-3 py-2 rounded-md border border-borders text-sm font-text text-main-text bg-main-background focus:outline-none focus:border-primary-solid" />
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="text-sm text-main-text font-text font-medium">CVV</label>
                                <input type="text" x-model="cvv" placeholder="000" maxlength="4"
                                    class="w-full px-3 py-2 rounded-md border border-borders text-sm font-text text-main-text bg-main-background focus:outline-none focus:border-primary-solid" />
                            </div>
                        </div>

                        @if($cardError)
                            <p class="text-sm text-danger font-text">{{ $cardError }}</p>
                        @endif

                        <button type="button" @click="pay()" x-bind:disabled="loading"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-md bg-primary-solid text-main-background text-sm font-heading font-semibold cursor-pointer hover:opacity-90 transition disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-show="loading"><x-icon icon="loading" class="w-4 h-4 text-main-background animate-spin" /></span>
                            <span x-show="!loading">Pagar R$ {{ number_format($payment->amount / 100, 2, ',', '.') }}</span>
                        </button>
                    </div>

                    {{-- Formulário PIX --}}
                    <div x-show="$wire.paymentMethod === 'pix'" class="w-full space-y-3">
                        <p class="text-sm text-secondary-text font-text">Clique em "Gerar QR Code" para criar um código PIX de <strong class="text-main-text">R$ {{ number_format($payment->amount / 100, 2, ',', '.') }}</strong>.</p>
                        <button type="button" wire:click="submitPix"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-md bg-primary-solid text-main-background text-sm font-heading font-semibold cursor-pointer hover:opacity-90 transition">
                            <div wire:loading wire:target="submitPix">
                                <x-icon icon="loading" class="w-4 h-4 text-main-background animate-spin" />
                            </div>
                            <span wire:loading.remove wire:target="submitPix">Gerar QR Code PIX</span>
                        </button>
                    </div>

                    <span class="text-xs text-secondary-text text-center font-text flex items-center justify-center gap-1.5">
                        <x-icon icon="locker" class="w-4 h-4 object-scale-down text-primary-solid" />
                        Pagamento processado com segurança pelo PagBank
                    </span>
                </div>

            {{-- ========================= STEP: PIX WAITING ========================= --}}
            @elseif($step === 'pix_waiting')

                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Aguardando pagamento PIX</h2>
                    <button type="button" wire:click="backToPayment" class="text-sm text-secondary-text underline cursor-pointer transition hover:scale-105">Trocar método</button>
                </header>

                <div wire:poll.3000ms="checkPixPayment" class="flex flex-col items-center gap-4">
                    <p class="text-sm text-secondary-text font-text text-center">
                        Escaneie o QR Code ou copie o código PIX para pagar <strong class="text-main-text">R$ {{ number_format($payment->amount / 100, 2, ',', '.') }}</strong>.
                    </p>

                    @if($pixQrCodeImage)
                        <img src="{{ $pixQrCodeImage }}" alt="QR Code PIX" class="w-48 h-48 object-contain" />
                    @else
                        <div class="w-48 h-48 bg-secondary-background rounded-md flex items-center justify-center">
                            <x-icon icon="loading" class="w-8 h-8 text-secondary-text animate-spin" />
                        </div>
                    @endif

                    @if($pixQrCodeText)
                        <div x-data="{ copied: false }" class="w-full space-y-2">
                            <div class="w-full px-3 py-2 rounded-md border border-borders bg-main-background">
                                <p class="text-xs text-secondary-text font-text break-all select-all">{{ $pixQrCodeText }}</p>
                            </div>
                            <button type="button"
                                @click="navigator.clipboard.writeText('{{ $pixQrCodeText }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-md border border-borders text-sm font-text font-medium text-main-text hover:bg-secondary-background transition cursor-pointer">
                                <span x-show="!copied">Copiar código PIX</span>
                                <span x-show="copied" class="text-green-600">Copiado!</span>
                            </button>
                        </div>
                    @endif

                    @if($pixExpiresAt)
                        <p class="text-xs text-secondary-text font-text text-center">
                            QR Code válido até {{ \Carbon\Carbon::parse($pixExpiresAt)->format('d/m/Y H:i') }}
                        </p>
                    @endif

                    <div class="flex items-center gap-2">
                        <x-icon icon="loading" class="w-4 h-4 text-secondary-text animate-spin" />
                        <span class="text-sm text-secondary-text font-text">Verificando pagamento automaticamente...</span>
                    </div>
                </div>

            @endif

        </div>
        @endif
    </div>
</div>
