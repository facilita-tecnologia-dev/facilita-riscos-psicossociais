<a 
    {{-- @if($href) href="{{ $href }}" @endif  --}}
    class="hover:bg-borders border-borders opacity-100 bg-secondary-background flex flex-col gap-4 rounded-2xl border p-6 transition">
    <div class="space-y-2">
        <x-new-components.info-item label="Nome" value="{!! $user['full_name'] !!}" truncate />
        <x-new-components.info-item label="Setor" value="{!! $user['department_name'] !!}" truncate />
    </div>

    <x-new-components.actions.button wire:click='detachUser' class="!bg-danger">
        <div wire:loading wire:target="detachUser">
            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
        </div>

        <span wire:loading.remove wire:target="detachUser" class="font-heading text-main-background text-center text-sm font-semibold">Desvincular</span>
    </x-new-components.actions.button>
</a>
