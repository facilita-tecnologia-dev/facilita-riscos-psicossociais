@props([
    'name',
    'label',
    'placeholder' => null,
    'isRequired' => false,
    'tooltip' => null,
    'attachments' => [],
    'wireModel',
])

<div class="flex w-full flex-col-reverse items-start justify-end gap-1" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
    <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
        @error($name)
            <span class="text-danger font-text mr-auto text-left text-xs leading-4 font-normal">{{ $message }}</span>
        @enderror
    </footer>

    @if ($attachments)
        <ul class="flex max-h-[110px] w-full list-none flex-col gap-1 overflow-y-auto">
            @if (is_array($attachments))
                @foreach ($attachments as $file)
                    @if ($file instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                        <li class="bg-borders flex w-full items-center gap-2 rounded-sm p-3">
                            <x-file-icon type="{{ $file->getClientOriginalExtension() }}" />
                            <span class="font-text text-secondary-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $file->getClientOriginalName() }}">{{ $file->getClientOriginalName() }}</span>
                            <span class="font-text text-secondary-text truncate text-xs font-normal">{{ round($file->getSize() / 1024 / 1024, 2) }}MB</span>
                        </li>
                    @else
                        <li class="bg-borders flex w-full items-center gap-2 rounded-sm p-3">
                            <x-file-icon type="{{ $file['fileExtension'] }}" />
                            <span class="font-text text-secondary-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $file['fileName'] }}">{{ $file['fileName'] }}</span>
                            <span class="font-text text-secondary-text truncate text-xs font-normal">{{ round($file['fileSize'] / 1024 / 1024, 2) }}MB</span>
                        </li>
                    @endif
                @endforeach
            @else
                @if ($attachments instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                    <li class="bg-borders flex w-full items-center gap-2 rounded-sm p-3">
                        <x-file-icon type="{{ $attachments->getClientOriginalExtension() }}" />
                        <span class="font-text text-secondary-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $attachments->getClientOriginalName() }}">{{ $attachments->getClientOriginalName() }}</span>
                        <span class="font-text text-secondary-text truncate text-xs font-normal">{{ round($attachments->getSize() / 1024 / 1024, 2) }}MB</span>
                    </li>
                @else
                    <li class="bg-borders flex w-full items-center gap-2 rounded-sm p-3">
                        <x-file-icon type="{{ $attachments['fileExtension'] }}" />
                        <span class="font-text text-secondary-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $attachments['fileName'] }}">{{ $attachments['fileName'] }}</span>
                        <span class="font-text text-secondary-text truncate text-xs font-normal">{{ round($attachments['fileSize'] / 1024 / 1024, 2) }}MB</span>
                    </li>
                @endif
            @endif
        </ul>
    @endif

    <div class="h-2 w-full overflow-hidden rounded bg-gray-200" x-show="uploading">
        <div class="bg-primary-solid h-2 transition-all duration-300 ease-out" :style="{ width: progress + '%' }"></div>
    </div>

    <input type="file" name="{{ $name }}" id="{{ $name }}" wire:model.defer="{{ $wireModel }}" class="hidden" {{ $attributes }} />

    <label for="{{ $name }}" class="peer border-borders bg-secondary-background font-text text-secondary-text flex h-10 w-full cursor-pointer items-center justify-between rounded-sm border px-3 text-sm font-normal transition hover:brightness-95 md:h-[45px] md:text-base">
        {{ $placeholder }}
        <x-icon icon="upload" class="h-5 w-5" />
    </label>

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
