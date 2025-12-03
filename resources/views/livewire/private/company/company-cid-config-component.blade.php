<div class="contents">
   <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
        <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
            <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Afastamentos e CID</h2>
            <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Defina no campo ao lado se você tem informações sobre afastamentos nos últimos 24 meses na sua empresa.</span>
        </div>

        <div class="w-80">
            <x-new-components.form.input-binary wireModelType="live"  wireModel="cid_config" name="cid_config" :options="$cid_options" isRequired />
        </div>
    </div>
</div>