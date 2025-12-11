<div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4">
    <x-form.input-binary wireModel="visualization_type" name="visualization_type" wireModelType="live" label="Tipo de Visualização" tooltip="Escolha o tipo de visualização" :options="$visualization_types" isRequired />
</div>