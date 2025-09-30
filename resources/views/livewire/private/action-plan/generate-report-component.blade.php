<div x-data="{ reportModalOpen: false }">
    <x-action tag="button" @click="reportModalOpen = true" width="fit">
        Exportar Inventário de Riscos
    </x-action>

    {{-- Fundo do modal --}}
    <div class="flex z-50 left-0 top-0 fixed w-screen h-screen bg-gray-800/30 px-4 py-8 items-center justify-center" x-show="reportModalOpen" x-cloak @click.self="reportModalOpen = false">
        <x-modal.wrapper class="max-w-[450px] bg-white p-4 rounded shadow">
            <x-modal.title>Exportar Inventário de Riscos</x-modal.title>

            <form class="w-full space-y-4" wire:submit.prevent="submit">
                <div class="w-full flex flex-col gap-3 items-center">
                    <h3 class="text-sm text-center font-semibold text-main-text">Tipo</h3>
                    <div class="w-full grid grid-cols-2 gap-2">
                        @foreach (App\Enums\PsychosocialReportTypes::cases() as $type)
                            <label class="py-2 border border-borders rounded-md flex justify-center items-center has-checked:bg-primary-solid cursor-pointer hover:bg-secondary-background transition">
                                <input type="radio" wire:model="type" id="department" value="{{ $type->value }}" class="hidden peer">
                                <span class="text-sm text-center text-main-text font-normal peer-checked:text-main-background transition">{{ $type->label() }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col gap-3 items-center">
                    <h3 class="text-sm text-center font-semibold text-main-text">Formato</h3>
                    <div class="w-full grid grid-cols-2 gap-2">
                        @foreach (App\Enums\PsychosocialReportFormatTypes::cases() as $format)
                            <label class="py-2 border border-borders rounded-md has-checked:bg-primary-solid flex justify-center items-center cursor-pointer hover:bg-secondary-background transition">
                                <input type="radio" wire:model="format" id="pdf" value="{{ $format->value }}" class="hidden peer">
                                <span class="text-sm text-center text-main-text font-normal peer-checked:text-main-background transition">{{ $format->label() }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <button>
                    
                <button type="submit" class="w-full py-2 px-4 bg-primary-solid rounded-md border border-borders cursor-pointer">
                    <div wire:loading wire:target="submit">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="submit" class="text-main-background text-center text-sm font-normal">Exportar</span>
                </button>
            </form>
        </x-modal.wrapper>
    </div>
</div>