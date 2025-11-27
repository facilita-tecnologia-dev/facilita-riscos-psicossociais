<div class="border-borders bg-main-background flex flex-col gap-6 rounded-lg border p-4">
    <header class="flex items-center justify-between">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Participação</h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode visualizar a adesão da sua campanha de testes, dividida por setor ou por função.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    <div id="percentage" class="space-y-1.5">
        <header class="flex items-center justify-between">
            <span class="text-danger font-heading text-left text-sm font-semibold">Legenda</span>
            <span class="text-danger font-heading text-right text-sm font-semibold">40%</span>
        </header>

        <div class="bg-borders h-1 w-full rounded-full">
            <div class="bg-danger h-full rounded-full" style="width: 40%"></div>
        </div>
    </div>

    <div id="departments" class="flex flex-col gap-2">
        <div class="flex items-center justify-between">
            <span class="text-main-text font-heading text-left text-sm font-normal">Setor 1</span>
            <span class="text-primary-solid font-heading text-left text-sm font-semibold">80%</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-main-text font-heading text-left text-sm font-normal">Setor 2</span>
            <span class="text-primary-solid font-heading text-left text-sm font-semibold">72%</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-main-text font-heading text-left text-sm font-normal">Setor 3</span>
            <span class="text-primary-solid font-heading text-left text-sm font-semibold">64%</span>
        </div>

        <div class="bg-borders h-[2px] w-full"></div>

        <div class="flex items-center justify-between">
            <span class="text-main-text font-heading text-left text-sm font-normal">Setor 4</span>
            <span class="text-danger font-heading text-left text-sm font-semibold">45%</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-main-text font-heading text-left text-sm font-normal">Setor 5</span>
            <span class="text-danger font-heading text-left text-sm font-semibold">32%</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-main-text font-heading text-left text-sm font-normal">Setor 6</span>
            <span class="text-danger font-heading text-left text-sm font-semibold">22%</span>
        </div>
    </div>
</div>
