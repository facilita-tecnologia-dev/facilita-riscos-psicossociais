@props([
    'name',
    'label',
    'placeholder' => null,
    'isRequired' => false,
    'tooltip' => null,
    'showCharCount' => false,
    'maxLength' => 255,
    'wireModel',
])

<div class="flex w-full flex-col-reverse items-start gap-1" x-data="{ charCount: 0 }">
    <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
        @if ((session('errors') && session('errors')->has($name)) || $showCharCount)
            @error($name)
                <span class="text-danger font-text mr-auto text-left text-xs leading-4 font-normal">{{ $message }}</span>
            @enderror

            @if ($showCharCount)
                <p class="font-text text-secondary-text ml-auto text-xs leading-4 font-normal" x-text="charCount + '/{{ $maxLength }}'"></p>
            @endif
        @endif
    </footer>

    <textarea name="{{ $name }}" id="{{ $name }}" wire:model.defer="{{ $wireModel }}" x-on:input="charCount = $event.target.value.length" placeholder="{{ $placeholder }}" maxlength="{{ $maxLength }}" {{ $attributes->merge(['class' => 'peer bg-secondary-background border-borders text-main-text font-text placeholder:text-secondary-text focus:shadow-primary-solid/50 h-[160px] w-full resize-none rounded-sm border p-3 text-sm font-normal transition focus:shadow-sm focus:outline-none md:text-base']) }}></textarea>

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
</div>
