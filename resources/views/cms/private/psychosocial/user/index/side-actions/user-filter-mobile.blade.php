<div x-data="{ isFilterOpen: false }" class="block lg:hidden">
    <x-actions.button @click="isFilterOpen = true" slim fitSize>
        <x-icon icon="filter" class="text-main-background h-4 w-4 object-contain" />
    </x-actions.button>

    <div class="bg-main-text/20 fixed top-0 right-0 z-4 flex h-screen w-screen justify-end" x-show="isFilterOpen" x-transition.opacity.duration.300ms>
        <aside class="bg-main-background flex h-screen w-full max-w-[280px] flex-col items-center gap-12 px-4 py-12 md:max-w-[360px] lg:max-w-[400px]" @click.outside="isFilterOpen = false">
            <h2 class="font-heading text-main-text text-center text-xl font-semibold">Filtros</h2>

            <livewire:cms.private.psychosocial.user.user-filter-component />
        </aside>
    </div>
</div>