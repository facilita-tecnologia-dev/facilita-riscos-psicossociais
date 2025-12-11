@props([
    'name',
    'wireModel',
    'value' => null,
    'temp' => null,
    'tooltip' => null,
    'format' => null,
])

<div class="relative w-fit">
    <div class="flex items-center gap-4">
        <label for="{{ $name }}" class="{{ $format ?? 'h-16 w-16 rounded-full' }} group relative flex cursor-pointer items-center justify-center overflow-hidden" data-tippy-content="{{ $tooltip }}">
            @if ($value instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                <img src="{{ $value->temporaryUrl() }}"
                    alt="Foto"
                    class="h-full w-full object-cover" />
            @elseif ($value)
                    <img src="{{ $value }}"
                    alt="Foto"
                    class="h-full w-full object-cover" />
            @else
                <div
                    class="bg-borders {{ $format ?? 'h-16 w-16 rounded-full' }} flex items-center justify-center">
                    <x-icon icon="camera"
                        class="text-secondary-text h-7 w-7 object-scale-down" />
                </div>
            @endif

            <div class="bg-main-text/70 absolute top-0 left-0 flex h-full w-full items-center justify-center opacity-0 transition group-hover:opacity-100">
                <x-icon icon="camera" class="text-main-background h-7 w-7 object-scale-down" />
            </div>
        </label>

        <input type="file" wire:model.defer="{{ $wireModel }}" name="{{ $name }}" id="{{ $name }}" class="hidden" />

        @if ($value && $value instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <span class="text-secondary-text font-text text-left text-sm font-normal">{{ $value->getClientOriginalName() }}</span>
        @endif
    </div>

    @error($name)
        <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
            <span class="text-danger font-text text-left text-xs leading-4 font-normal">{{ $message }}</span>
        </footer>
    @enderror
</div>
