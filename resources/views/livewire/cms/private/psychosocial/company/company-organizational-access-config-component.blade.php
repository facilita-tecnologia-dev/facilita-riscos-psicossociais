
    <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
        <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
            <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Pesquisa de Clima Organizacional</h2>
            <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Defina no campo ao lado se a empresa terá acesso à Pesquisa de Clima Organizacional.</span>
        </div>

        <div class="w-80">
            <x-form.input-binary wireModelType="live"  wireModel="can_access_organizational" name="can_access_organizational" :options="$options" isRequired />
        </div>
    </div>
