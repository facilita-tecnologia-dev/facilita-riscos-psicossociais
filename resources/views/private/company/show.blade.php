<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />

        <x-structure.main-content-container>
            <x-structure.page-title title="Empresa" :breadcrumbs="[
                'Empresa' => '',
            ]" />

            @if (session('message'))
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    {{ session('message') }}
                </x-structure.message>
            @endif

            <div class="w-full space-y-6 rounded-md bg-gray-100 p-4 shadow-md md:p-8">
                <div class="gri-cols-1 grid w-full gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="space-y-1">
                        <p class="text-left text-base font-semibold sm:text-lg">Logo da empresa</p>

                        @if ($company->logo)
                            <img src="{{ asset($company->logo) }}" alt="" class="h-11" />
                        @else
                            <p class="text-left text-sm sm:text-base">Não cadastrado</p>
                        @endif
                    </div>
                    <div class="space-y-1">
                        <p class="text-left text-base font-semibold sm:text-lg">Razão social</p>
                        <p class="text-left text-sm sm:text-base">{{ $company->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-left text-base font-semibold sm:text-lg">CNPJ</p>
                        <p class="text-left text-sm sm:text-base">{{ $company->cnpj }}</p>
                    </div>
                </div>

                @can('company-edit')
                    <div class="flex w-full flex-row justify-between gap-2">
                        <div class="flex items-center gap-2" data-position="left">
                            <x-action tag="button" variant="danger" data-role="delete-company-modal-trigger">Excluir conta</x-action>
                        </div>
                        <div class="flex items-center gap-2" data-position="right">
                            <x-action tag="button" variant="secondary" data-role="reset-password-modal-trigger">Redefinir senha</x-action>
                            <x-action href="{{ route('company.edit', session('auth:company')) }}" variant="secondary">Editar</x-action>
                        </div>
                    </div>
                @endcan
            </div>

            <x-modal.background data-role="delete-company-modal">
                <x-modal.wrapper class="max-w-[450px]">
                    <x-modal.title>Excluir conta</x-modal.title>

                    <p class="rounded-md bg-red-300/50 p-2 text-sm text-red-700">
                        <i class="fa-solid fa-circle-exclamation mr-1"></i>
                        Esta ação não pode ser desfeita e excluirá permanentemente a conta da empresa e todos os dados vinculados.
                    </p>
                    <div class="flex w-full flex-col gap-2">
                        <p class="text-center">Digite a senha da empresa para excluir a conta:</p>
                        <x-form action="{{ route('company.destroy', session('auth:company')) }}" delete class="flex w-full flex-col gap-2">
                            <x-form.input-text type="password" name="password" placeholder="Senha" />
                            <x-action variant="danger" tag="button" width="full">Excluir conta</x-action>
                        </x-form>
                    </div>
                </x-modal.wrapper>
            </x-modal.background>

            <x-modal.background data-role="reset-password-modal">
                <x-modal.wrapper class="max-w-[450px]">
                    <x-modal.title>Redefinir senha</x-modal.title>

                    <div class="flex w-full flex-col gap-2">
                        <x-form action="{{ route('company.reset-password-modal', session('auth:company')) }}" put class="flex w-full flex-col gap-2">
                            <p class="text-center">Digite a senha atual:</p>
                            <x-form.input-text type="password" name="current_password" placeholder="Senha atual" />
                            <p class="text-center">Digite e confirme a nova senha:</p>
                            <x-form.input-text type="password" name="new_password" placeholder="Nova senha" oninput="checkPasswordSteps(event)" />
                            <x-password-requirements />
                            <x-form.input-text type="password" name="new_password_confirmation" placeholder="Confirme sua nova senha" />
                            <x-action variant="secondary" tag="button" width="full">Redefinir senha</x-action>
                        </x-form>
                    </div>
                </x-modal.wrapper>
            </x-modal.background>
        </x-structure.main-content-container>
    </x-structure.page-container>

    <script src="{{ asset('js/company/show.js') }}"></script>
    <script src="{{ asset('js/') }}"></script>
</x-layouts.app>
