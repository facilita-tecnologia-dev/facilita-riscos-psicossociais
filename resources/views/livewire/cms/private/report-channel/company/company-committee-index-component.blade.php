<div class="w-full space-y-6">
    <h2 class="text-xl text-left text-main-text font-semibold">Comitê</h2>
    
    <x-actions.button href="{{ route('cms.report-channel.user.create', ['company' => $company['id']]) }}" class="!bg-report-channel-primary-solid" data-tippy-content="Essa opção redirecionará você para a página de criação de usuário, com a opção de vincular à essa empresa já selecionada.">
        <span class="font-heading text-main-background text-center text-sm font-semibold">Criar e Vincular</span>
    </x-actions.button>

    <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @if (isset($committee) && count($committee) > 0)
            @foreach ($committee as $user)
                <livewire:cms.private.report-channel.company.company-committee-user-component wire:key="committee-user-{{ $user['id'] }}" :company="$company" :user="$user">
            @endforeach
        @else
            <div class="flex w-full items-center justify-center sm:col-span-2 lg:col-span-3">
                <p class="text-secondary-text font-text text-left text-sm font-normal md:text-base">A empresa não tem nenhum membro ativo no comitê</p>
            </div>
        @endif
    </div>
</div>
