<div class="contents">
    <x-structure.page-header icon="users" label="Lista de Funcionários" :breadcrumbs="['Página da Empresa' => route('company.show', session('auth:company')), 'Lista de Funcionários' => null]" />

    <div class="w-full flex lg:hidden gap-2 justify-end">
        <x-actions.button :href="route('user.import')" slim fitSize>
            <span class="hidden sm:block text-main-background text-center text-sm font-semibold">Importar arquivo de funcionários</span>
            <x-icon icon="upload" class="block sm:hidden text-main-background h-4 w-4 object-scale-down" />
        </x-actions.button>
        <x-actions.button :href="route('user.create')" slim fitSize>
            <span class="hidden sm:block text-main-background text-center text-sm font-semibold">Cadastrar funcionário manualmente</span>
            <x-icon icon="plus" class="block sm:hidden text-main-background h-4 w-4 object-scale-down" />
        </x-actions.button>

        @include('private.user.index.side-actions.user-filter-mobile')
    </div>

    <main class="flex min-h-0 w-full flex-1 flex-col-reverse items-start justify-end gap-4 lg:flex-row lg:justify-start lg:overflow-hidden">
        <section class="flex min-h-0 w-full flex-1 flex-col gap-4 overflow-auto pb-4 lg:h-full lg:w-fit">
            <livewire:private.user.user-list-component :users="$users" />
        </section>

        <aside class="flex h-fit w-full flex-col gap-4 overflow-x-hidden overflow-y-auto pb-0 lg:h-full lg:w-[400px] lg:pb-4 xl:w-[460px]">
            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('create', [\App\Models\User::class]))
                <div class="bg-secondary-background border-borders hidden w-full flex-col items-center gap-8 rounded-2xl border px-6 py-8 shadow-sm lg:flex">
                    <h2 class="text-main-text text-center text-xl font-semibold">Ações</h2>
                    <div class="w-full flex flex-col gap-3">
        
                        <x-actions.button :href="route('user.import')">
                            <span class="text-main-background text-center text-sm font-semibold">Importar arquivo de funcionários</span>
                        </x-actions.button>
                        <x-actions.button :href="route('user.create')">
                            <span class="text-main-background text-center text-sm font-semibold">Cadastrar funcionário manualmente</span>
                        </x-actions.button>
                    </div>
                </div>
            @endif
            
            <div class="bg-secondary-background border-borders hidden lg:flex w-full flex-col items-center gap-8 rounded-2xl shadow-sm border px-6 py-8">
                <h2 class="text-main-text text-center text-xl font-semibold">Filtros</h2>
                <livewire:private.user.user-filter-component />
            </div>
        </aside>
    </main>
</div>