<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="report-channel" class="w-6 h-6 object-scale-down text-report-channel-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Canal de Denúncias</h1>
        </div>

        <x-new-components.structure.breadcrumbs 
            :links="[
                'Lista de usuários' => route('cms.report-channel.user.index'),
                'Perfil do usuário' => null
            ]" 
        />
    </div>

    <livewire:cms.private.report-channel.user.user-edit-component :user="$user" />

    <livewire:cms.private.report-channel.user.user-companies-component :user="$user" />
</section>
