@props([
    'name',
    'label',
    'wireModel',
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

    <div class="flex w-full gap-1.5">
        @foreach ($options as $key => $option)
            <div class="flex-1">
                <input type="radio" name="{{ $name }}" id="{{ $name . '_' . $key }}" wire:model.defer="{{ $wireModel }}" value="{{ $option['value'] }}" class="hidden peer" {{ old($name) == $option['value'] || $value == $option['value'] ? 'checked' : '' }}>
                <label 
                    for="{{ $name . '_' . $key }}" 
                    class="w-full flex items-center justify-between bg-secondary-background border border-borders p-3 rounded-sm peer-checked:border-primary-solid cursor-pointer hover:brightness-95 transition">
                    <span class="text-sm text-left text-main-text font-normal">{{ $option['label'] }}</span>
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
