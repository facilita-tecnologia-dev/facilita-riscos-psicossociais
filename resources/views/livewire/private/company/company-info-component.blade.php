<form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
    @if($logo)
        <div class="w-fit min-w-14 h-14 rounded-md">
            <img src="" alt="">
        </div>
    @else
        <div
            class="bg-borders w-fit min-w-14 h-14 rounded-md flex items-center justify-center">
            <x-icon icon="camera"
                class="text-secondary-text h-7 w-7 object-scale-down" />
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
        <x-info-item label="Nome" value="{{ $company->name }}" truncate />
        <x-info-item label="CPF" value="{{ $company->cnpj }}" truncate />
        <x-info-item label="E-mail" value="{{ $company->email }}" truncate />
    </div>
</form>