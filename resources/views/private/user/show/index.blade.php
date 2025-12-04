<x-layouts.app>
    <livewire:private.user.user-show-component :user="$user" />
</x-layouts.app>

{{-- <x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />

        <x-structure.main-content-container>
            <x-structure.page-title :title="$user->name" :back="Gate::allows('user-index') ? route('user.index') : null" :breadcrumbs="[
                'Lista de colaboradores' => Gate::allows('user-index') ? route('user.index') : null,
                'Colaborador - Detalhe' => '',
            ]" />

            @if (session('message'))
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    {{ session('message') }}
                </x-structure.message>
            @endif

            <div class="w-full space-y-6 rounded-md bg-gray-100 p-4 shadow-md md:p-8">
                <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Nome:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->name ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">CPF:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->cpf ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">E-mail:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->email ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Idade:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->birth_date ? Carbon\Carbon::parse($user->birth_date)->age . ' anos' : 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Sexo:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->gender ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Estado Civil:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->marital_status ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Grau de Instrução:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->education_level ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Setor:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->department ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Função:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->occupation ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Turno:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->work_shift ?? 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Data de admissão:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->admission ? Carbon\Carbon::parse($user->admission)->format('d/m/Y') : 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Tempo de empresa:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->admission ? Carbon\Carbon::parse($user->admission)->diffForHumans() : 'Não cadastrado' }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Hierarquia:</p>
                        <p class="text-left text-sm sm:text-base">{{ $user->roles[0]->display_name }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Status:</p>
                        <p class="text-left text-sm sm:text-base">{{ App\Enums\UserStatus::labelFromValue($user->status()) }}</p>
                    </div>
                    <div class="">
                        <p class="text-left text-base font-semibold sm:text-lg">Último teste de Riscos Psicossociais realizado:</p>
                        <p class="text-left text-sm sm:text-base">{{ $latestPsychosocialCollectionDate ?? 'Nunca' }}</p>
                    </div>
                    
                        <div class="">
                        <p class="font-semibold text-base sm:text-lg text-left">Último teste de Clima Organizacional realizado:</p>
                        <p class="text-sm sm:text-base text-left">{{ $latestOrganizationalClimateCollectionDate ?? 'Nunca' }}</p>
                        </div>
                   
                </div>

                @if ($user->is_temp_password)
                    <div class="space-y-1 rounded-md bg-blue-200/50 p-4 md:col-span-2">
                        <p class="text-sm text-gray-800 sm:text-base">Este gestor ainda não definiu uma senha. No próximo acesso, deverá usar a senha provisória e será solicitado a criar uma nova.</p>
                        <button class="text-left text-sm break-all sm:text-base" onclick="navigator.clipboard.writeText('{{ $user->password }}')">
                            Clique no texto sublinhado para copiar a senha provisória:
                            <span class="text-blue-500 underline active:text-blue-700" data-tippy-content="Clique para copiar">
                                {{ $user->password }}
                            </span>
                        </button>
                    </div>
                @endif

                <div class="flex w-full flex-row flex-wrap justify-between gap-2">
                    <div class="flex items-center gap-2" data-position="left">
                        @can('user-delete')
                            <x-form action="{{ route('user.destroy', $user) }}" delete onsubmit="return confirm('Você deseja desvincular o colaborador?')">
                                <x-action tag="button" type="submit" variant="danger">Desvincular colaborador</x-action>
                            </x-form>
                        @endcan
                    </div>
                    <div class="flex items-center gap-2" data-position="right">
                        @if (session('auth:guard') === 'user' && $user->hasRole(App\Enums\RoleEnum::MANAGER->value))
                            <x-action tag="button" variant="secondary" data-role="reset-password-modal-trigger">Redefinir senha</x-action>
                        @endif

                        @can('user-permission-edit')
                            <x-action href="{{ route('user.permissions', $user) }}" variant="secondary">Gerenciar permissões</x-action>
                        @endcan

                        @can('user-department-scope-edit')
                            @if ($user->hasRole(App\Enums\RoleEnum::MANAGER->value))
                                <x-action href="{{ route('user.department-scope', $user) }}" variant="secondary">Gerenciar Visão de Setores</x-action>
                            @endif
                        @endcan

                        @can('user-edit')
                            <x-action href="{{ route('user.edit', $user) }}" variant="secondary">Editar</x-action>
                        @endcan
                    </div>
                </div>
            </div>

            @if ($user->is_temp_password)
                <x-modal.background data-role="password-warning-modal" class="!flex">
                    <x-modal.wrapper class="max-w-[450px]">
                        <x-modal.title>Aviso - Senha do gestor</x-modal.title>

                        <p class="rounded-md bg-blue-300/50 p-2 text-sm text-blue-700">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i>
                            Este gestor ainda não definiu uma senha. No próximo acesso, deverá usar a senha provisória e será solicitado a criar uma nova.
                        </p>

                        <div class="flex flex-col items-center gap-2 text-left text-sm break-all sm:text-base">
                            Clique na senha provisória para copiá-la:
                            <button class="text-blue-500 underline active:text-blue-700" data-tippy-content="Clique para copiar" onclick="navigator.clipboard.writeText('{{ $user->password }}')">
                                {{ $user->password }}
                            </button>
                        </div>

                        <x-action variant="danger" width="full" tag="button" type="button" onclick="hidePasswordWarningModal()">Fechar</x-action>
                    </x-modal.wrapper>
                </x-modal.background>
            @endif

            <x-modal.background data-role="reset-password-modal">
                <x-modal.wrapper class="max-w-[450px]">
                    <x-modal.title>Redefinir senha do usuário</x-modal.title>

                    <div class="flex w-full flex-col gap-2">
                        <x-form action="{{ route('user.reset-password-modal', $user) }}" put class="flex w-full flex-col gap-2">
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

    <script src="{{ asset('js/user/show.js') }}"></script>
</x-layouts.app> --}}
