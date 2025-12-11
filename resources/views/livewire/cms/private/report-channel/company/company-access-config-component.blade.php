<div class="contents">
    @if($company['subscription_type'] !== App\Enums\ReportChannel\ReportChannelCompanySubscriptionTypes::SUBSCRIBED->value)
        <x-actions.button wire:click='turnAccessOn' class="!bg-report-channel-primary-solid" fitSize>
            <div wire:loading wire:target="turnAccessOn">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="turnAccessOn" class="font-heading text-main-background text-center text-sm font-semibold">Liberar acesso</span>
        </x-actions.button>
    @endif

    @if($company['subscription_type'] === App\Enums\ReportChannel\ReportChannelCompanySubscriptionTypes::SUBSCRIBED->value)
        <x-actions.button wire:click='turnAccessOff' class="!bg-danger" fitSize>
            <div wire:loading wire:target="turnAccessOff">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="turnAccessOff" class="font-heading text-main-background text-center text-sm font-semibold">Bloquear acesso</span>
        </x-actions.button>
    @endif
</div>
