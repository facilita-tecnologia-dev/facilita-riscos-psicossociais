<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="psychosocial" class="w-6 h-6 object-scale-down text-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Riscos Psicossociais</h1>
        </div>

        <x-structure.breadcrumbs 
            :links="[
                'Lista de empresas' => route('cms.psychosocial.company.index'),
                $company->name => route('cms.psychosocial.company.show', $company),
                'Lista de funcionários' => null
            ]" 
        />
    </div>

    <div class="w-full flex lg:hidden gap-2 justify-end">
        <x-actions.button href="{{ route('cms.psychosocial.user.import', $company) }}" slim fitSize>
            <span class="hidden sm:block text-main-background text-center text-sm font-semibold">Importar arquivo de funcionários</span>
            <x-icon icon="upload" class="block sm:hidden text-main-background h-4 w-4 object-scale-down" />
        </x-actions.button>
        <x-actions.button href="{{ route('cms.psychosocial.user.create', $company) }}" slim fitSize>
            <span class="hidden sm:block text-main-background text-center text-sm font-semibold">Cadastrar funcionário manualmente</span>
            <x-icon icon="plus" class="block sm:hidden text-main-background h-4 w-4 object-scale-down" />
        </x-actions.button>

        @include('cms.private.psychosocial.user.index.side-actions.user-filter-mobile')
    </div>

    <main class="flex min-h-0 w-full flex-1 flex-col-reverse items-start justify-end gap-4 lg:flex-row lg:justify-start lg:overflow-hidden">
        <section class="flex min-h-0 w-full flex-1 flex-col gap-4 overflow-auto pb-4 lg:h-full lg:w-fit">
            <livewire:cms.private.psychosocial.user.user-list-component :company="$company" :users="$users->items()" />

            @if (isset($users) && count($users) > 0)
                <div class="py-2">
                    {{ $users->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </section>

        <aside class="flex h-fit w-full flex-col gap-4 overflow-x-hidden overflow-y-auto pb-0 lg:h-full lg:w-[400px] lg:pb-4 xl:w-[460px]">
            <div class="bg-secondary-background border-borders hidden w-full flex-col items-center gap-8 rounded-2xl border px-6 py-8 shadow-sm lg:flex">
                <h2 class="text-main-text text-center text-xl font-semibold">Ações</h2>
                <div class="w-full flex flex-col gap-3">
                    <x-actions.button href="{{ route('cms.psychosocial.user.import', $company) }}">
                        <span class="text-main-background text-center text-sm font-semibold">Importar arquivo de funcionários</span>
                    </x-actions.button>
                    <x-actions.button href="{{ route('cms.psychosocial.user.create', $company) }}">
                        <span class="text-main-background text-center text-sm font-semibold">Cadastrar funcionário manualmente</span>
                    </x-actions.button>
                </div>
            </div>
            
            <div class="bg-secondary-background border-borders hidden lg:flex w-full flex-col items-center gap-8 rounded-2xl shadow-sm border px-6 py-8">
                <h2 class="text-main-text text-center text-xl font-semibold">Filtros</h2>
                <livewire:cms.private.psychosocial.user.user-filter-component :company="$company" />
            </div>
        </aside>
    </main>
</section>

