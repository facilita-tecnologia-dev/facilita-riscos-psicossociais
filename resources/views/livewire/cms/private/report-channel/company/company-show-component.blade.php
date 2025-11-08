<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="report-channel" class="w-6 h-6 object-scale-down text-report-channel-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Canal de Denúncias</h1>
        </div>

        <x-new-components.structure.breadcrumbs 
            :links="[
                'Lista de empresas' => route('cms.report-channel.company.index'),
                $company['register_name'] => null
            ]" 
        />
    </div>

    <livewire:cms.private.report-channel.company.company-edit-component :company="$company" />

    <div class="w-full space-y-4 lg:col-span-3">
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Portal de Denúncias</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Visite o portal de denúncias da empresa.</span>
            </div>
            
            <x-new-components.actions.button class="!bg-report-channel-primary-solid" :href="env('REPORT_CHANNEL_URL') . '/' . $company['slug']" fitSize>
                <span class="text-main-background font-heading text-center text-sm font-semibold">Visitar</span>
            </x-new-components.actions.button>
        </div>

        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Acesso ao sistema</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Selecione se a empresa pode ou não ter acesso às funcionalidades do sistema.</span>
            </div>

            <livewire:cms.private.report-channel.company.company-access-config-component :company="$company" />
        </div>
    </div>

    <livewire:cms.private.report-channel.company.company-committee-index-component :company="$company" />

    <livewire:cms.private.report-channel.company.company-departments-component :company="$company" />

</section>
