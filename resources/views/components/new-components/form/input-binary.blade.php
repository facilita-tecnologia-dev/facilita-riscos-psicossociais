@props([
    'name',
    'label',
    'wireModel',
    'wireModelType' => 'defer',
    'value' => null,
    'tooltip' => null,
    'options' => [],
    'isRequired' => false,
])

<div class="flex w-full flex-col-reverse items-start gap-1">
    @error($name)
        <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
            <span class="text-danger font-text text-left text-xs leading-4 font-normal">{{ $message }}</span>
        </footer>
    @enderror

    <div class="w-full grid grid-cols-2 gap-1.5">
        @foreach ($options as $key => $option)
            <div class="w-full">
                <input type="radio" name="{{ $name }}" id="{{ $name . '_' . $key }}" @if($wireModelType === 'defer') wire:model.defer="{{ $wireModel }}" @endif @if($wireModelType === 'live') wire:model.live="{{ $wireModel }}" @endif value="{{ $option['value'] }}" class="peer hidden" {{ old($name) == $option['value'] || $value == $option['value'] ? 'checked' : '' }} />
                <label for="{{ $name . '_' . $key }}" class="bg-secondary-background border-borders peer-checked:border-primary-solid flex w-full cursor-pointer items-center justify-between rounded-sm border p-3 transition hover:brightness-95">
                    <span class="text-main-text text-left text-sm font-normal">{{ $option['label'] }}</span>
                </label>
            </div>
        @endforeach
    </div>

    @if (isset($label))
        <header class="text-secondary-text peer-focus:text-main-text flex w-full items-center justify-between gap-3 pl-0.5 transition">
            <label for="{{ $name }}" class="font-heading text-left text-sm font-semibold peer-focus:text-lg md:text-base">
                {{ $label }}
                @if ($isRequired)
                    <span class="text-danger">*</span>
                @else
                    <span class="font-text text-secondary-text text-left text-xs font-normal">(opcional)</span>
                @endif
            </label>
            @if ($tooltip)
                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="{{ $tooltip }}">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-4 w-4 object-contain" />
                </div>
            @endif
        </header>
    @endif
</div>
