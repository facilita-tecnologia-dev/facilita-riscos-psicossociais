<div class="bg-secondary-background border-borders flex flex-col gap-2 rounded-lg border px-6 py-4 shadow-sm">
    <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
        <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Plano de assinatura</h2>
        <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Acompanhe e gerencie as informações sobre seu plano de assinatura.</span>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div class="bg-transparent border border-borders rounded-lg p-3 space-y-3">
            <h3 class="text-base text-left text-main-text font-semibold">
                Principais informações
            </h3>
            <ul class="flex flex-col gap-1.5">
                <li class="flex items-center justify-between">
                    <span class="text-base text-main-text text-left font-normal">
                        Status:
                    </span>
                    <span class="text-base text-main-text text-right font-semibold">
                        {{ $subscription->status->label() }}
                    </span>
                </li>
                
                @if(!$subscription->isTrial())
                    <li class="flex items-center justify-between">
                        <span class="text-base text-main-text text-left font-normal">
                            Faixa de funcionários:
                        </span>
                        <span class="text-base text-main-text text-right font-semibold">
                            {{ App\Services\Subscription\SubscriptionPricingService::employeeRange($subscription->employees_count) }}
                        </span>
                    </li>

                    <li class="flex items-center justify-between">
                        <span class="text-base text-main-text text-left font-normal">
                            Tipo de pagamento:
                        </span>
                        <span class="text-base text-main-text text-right font-semibold">
                            {{ $subscription->type->label() }}
                        </span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="text-base text-main-text text-left font-normal">
                            Preço:
                        </span>
                        <span class="text-base text-main-text text-right font-semibold">
                            {{  new NumberFormatter('pt_BR', NumberFormatter::CURRENCY)->formatCurrency($subscription->amount  / 100, 'BRL') }}
                        </span>
                    </li>
                @endif

                @if($subscription->isActive())
                    <li class="flex items-center justify-between">
                        <span class="text-base text-main-text text-left font-normal">
                            Próxima cobrança em:
                        </span>
                        <span class="text-base text-main-text text-right font-semibold">
                            {{  $subscription->next_billing_at->format('d/m/Y')  }}
                        </span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="bg-transparent border border-borders rounded-lg p-3 space-y-3">
            <h3 class="text-base text-left text-main-text font-semibold">
                Histórico de pagamentos
            </h3>
            <ul class="flex flex-col gap-1.5">
                @forelse ($subscription->payments as $payment)
                    <livewire:subscription.payment-component :payment="$payment" />
                @empty
                    <div class="flex justify-center">
                        <span class="text-secondary-text text-center text-base">Nenhuma pagamento agendado ou realizado</span>
                    </div>
                @endforelse

            </ul>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2">
        @if($subscription->isTrial())
            <x-actions.button href="{{ route('company.subscription.index') }}" class="col-span-2">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Assinar agora</span>
            </x-actions.button>
        @endif

        @if($subscription->canBeCanceled())
            <x-actions.button wire:click='cancel' type="button" class="!bg-danger" data-tippy-content="Sua assinatura permanecerá ativa até o fim do período atual ({{ $subscription->current_period_end->format('d/m/Y') }}).">
                <div wire:loading wire:target="cancel">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="cancel" class="font-heading text-main-background text-center text-sm font-semibold">Cancelar assinatura</span>
            </x-actions.button>

            <livewire:subscription.sign-edit-component :subscription="$subscription" />
        @endif

        @if($subscription->canBeReactivated())
            <x-actions.button wire:click='reactivate' type="button">
                <div wire:loading wire:target="reactivate">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="reactivate" class="font-heading text-main-background text-center text-sm font-semibold">Reativar assinatura</span>
            </x-actions.button>
        @endif
    </div>
</div>
