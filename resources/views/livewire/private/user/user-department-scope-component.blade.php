<form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
    <header class="flex items-center justify-between">
        <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
            Visão de Setores
        </h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Abaixo, você pode definir quais setores este usuário pode visualizar. Assim, ao acessar os resultados das campanhas, ele verá apenas os dados dos colaboradores pertencentes a esses setores. Esta funcionalidade fica disponível somente enquanto o usuário tiver o perfil de gestor.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    <p class="text-sm sm:text-base text-main-text text-left font-normal">Abaixo, você pode definir quais setores este gestor pode visualizar. Assim, ao acessar os resultados das campanhas, ele verá apenas os dados dos colaboradores pertencentes a esses setores.</p>

    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($departmentScopes as $department => $permission)
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" wire:model.live="departmentScopes.{{ $department }}" @disabled($department === $user->department) class="peer hidden">

                <div class="bg-secondary-background border-borders peer-checked:border-primary-solid flex flex-col gap-1 w-full cursor-pointer items-start rounded-sm border p-3 transition hover:brightness-95">
                    <p class="font-medium text-sm md:text-base text-gray-800">{{ $department }}</p>
                </div>
            </label>
        @endforeach

    </div>

    <x-actions.button class="lg:col-span-2">
        <div wire:loading wire:target="submit">
            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
        </div>

        <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
    </x-actions.button>
</form>
