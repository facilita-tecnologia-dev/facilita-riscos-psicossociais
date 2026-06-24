{{-- <li class="flex items-center justify-between p-2 border border-borders rounded-lg">
    <span class="text-base text-main-text text-left font-normal">
        {{ $payment->created_at->format('d/m/Y') }}
    </span>

    @if($payment->canBePaid())
        <div style="background-color: {{ $payment->status->color() }}" class="w-fit py-0.5 px-1.5 rounded-md">
            <span class="text-xs text-main-background font-normal">
                {{ $payment->status->label() }}
            </span>
        </div>

        <button>Pagar</button>
    @else
        <div style="background-color: {{ $payment->status->color() }}" class="w-fit py-0.5 px-1.5 rounded-md">
            <span class="text-xs text-main-background font-normal">
                {{ $payment->status->label() }}
            </span>
        </div>
    @endif
</li> --}}

<li class="group flex items-center justify-between p-2 border border-borders rounded-lg">
    <span class="text-base text-main-text text-left font-normal">
        {{ $payment->created_at->format('d/m/Y') }}
    </span>

    @if($payment->canBePaid())
        <div class="flex items-center">
            @dump(now()->startOfDay()->diffInDays($payment->due_date->copy()->startOfDay(), false))
            {{-- Badge --}}
            <div class="group-hover:hidden w-fit h-[34px] flex items-center px-3 rounded-md" style="background-color: {{ $payment->status->color() }}">
                <span class="text-xs text-main-background font-normal text-center">
                    {{ $payment->status->label() }}
                </span>
            </div>

            {{-- Botão --}}
            <x-actions.button wire:click='pay' class="hidden group-hover:block" slim>
                <div wire:loading wire:target="pay">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="pay" class="font-heading text-main-background text-center text-xs font-semibold">Pagar agora</span>
            </x-actions.button>
        </div>
    @else
        <div class="w-fit h-[34px] flex items-center px-3 rounded-md" style="background-color: {{ $payment->status->color() }}">
            <span class="text-xs text-main-background font-normal">
                {{ $payment->status->label() }}
            </span>
        </div>
    @endif
</li>