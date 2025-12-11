@props([
    'name',
    'label',
    'wireModel',
    'placeholder' => null,
    'value' => null,
    'tooltip' => null,
    'isRequired' => false,
    'isPassword' => false,
    'prefix' => null,
    'sufix' => null,
])

<div class="flex w-full flex-col-reverse items-start gap-1" x-data="{ textVisible: {{ $isPassword ? 'false' : 'true' }} }">
    @error($name)
        <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
            <span class="text-danger font-text text-left text-xs leading-4 font-normal">{{ $message }}</span>
        </footer>
    @enderror

    <div class="flex w-full gap-1.5">
        @if ($prefix)
            <div class="bg-secondary-background border-borders flex h-10 items-center rounded-sm border px-4 md:h-[45px]"><span>{{ $prefix }}</span></div>
        @endif

        <input :type="textVisible ? 'text' : '{{ $isPassword ? 'password' : 'text' }}'" name="{{ $name }}" id="{{ $name }}" wire:model.defer="{{ $wireModel }}" placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $attributes->merge(['class' => 'peer bg-secondary-background border-borders text-main-text font-text placeholder:text-secondary-text focus:shadow-primary-solid/50 h-10 md:h-[45px] w-full rounded-sm border px-3 text-sm md:text-base font-normal transition focus:shadow-sm focus:outline-none']) }} />

        @if ($sufix)
            <div class="bg-secondary-background border-borders flex h-10 items-center rounded-sm border px-4 md:h-[45px]"><span>{{ $sufix }}</span></div>
        @endif

        @if ($isPassword)
            <button type="button" class="bg-secondary-text flex h-10 w-10 cursor-pointer items-center justify-center rounded-md md:h-[45px] md:w-[45px]" @click="textVisible = !textVisible">
                <x-icon x-show="textVisible" icon="eye-open" class="text-main-background h-6 w-6 object-scale-down" />
                <x-icon x-show="!textVisible" icon="eye-close" class="text-main-background h-6 w-6 object-scale-down" />
            </button>
        @endif
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
