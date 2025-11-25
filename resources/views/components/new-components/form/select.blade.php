@props([
    'name',
    'label' => null,
    'placeholder' => null,
    'isRequired' => false,
    'tooltip' => null,
    'options' => [],
    'wireModel',
    'wireModelType' => 'defer',
])

<div class="flex w-full flex-col-reverse items-start gap-1">
    @error($name)
        <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
            <span class="text-danger font-text text-left text-xs leading-4 font-normal">{{ $message }}</span>
        </footer>
    @enderror

    <select name="{{ $name }}" id="{{ $name }}" @if($wireModelType === 'defer') wire:model.defer="{{ $wireModel }}" @endif @if($wireModelType === 'live') wire:model.live="{{ $wireModel }}" @endif class="peer bg-secondary-background border-borders text-main-text font-text placeholder:text-secondary-text focus:shadow-primary-solid/50 h-10 w-full appearance-none rounded-sm border px-3 text-sm font-normal transition focus:shadow-sm focus:outline-none md:h-[45px] md:text-base">
        <option value="" disabled>{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>

    @if ($label)
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
