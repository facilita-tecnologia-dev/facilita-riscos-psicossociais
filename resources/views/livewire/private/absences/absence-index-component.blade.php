<div class="contents">
    @if($absences->isNotEmpty())
        <x-table class="flex flex-col gap-1">
            <x-table.head class="flex items-center gap-3">
                <x-table.head.th class="hidden lg:block w-40">
                    Data de Registro
                </x-table.head.th>
                <x-table.head.th class="flex-1 sm:w-36">
                    Código CID
                </x-table.head.th>
                <x-table.head.th class="hidden md:block flex-1">
                    Setor
                </x-table.head.th>
                <x-table.head.th class="hidden sm:block flex-1">
                    Função
                </x-table.head.th>
                <x-table.head.th class="flex-1 sm:w-28">
                    Duração
                </x-table.head.th>
                <x-table.head.th class="w-12"></x-table.head.th>
                <x-table.head.th class="w-12"></x-table.head.th>
            </x-table.head>
            <x-table.body>
                @foreach ($absences as $absence)
                    <x-table.body.tr class="flex items-center gap-3" wire:key="absence-row-{{ $absence->id }}">
                        <x-table.body.td class="hidden lg:block w-40 truncate">{{ $absence->created_at->format('d/m/Y') }}</x-table.body.td>
                        <x-table.body.td class="flex-1 sm:w-36 truncate">{{ $absence->cid->type }}</x-table.body.td>
                        <x-table.body.td class="hidden md:block flex-1 truncate">{{ $absence->department }}</x-table.body.td>
                        <x-table.body.td class="hidden sm:block flex-1 truncate">{{ $absence->occupation }}</x-table.body.td>
                        <x-table.body.td class="flex-1 sm:w-28">{{ $absence->duration }} dias</x-table.body.td>
                        <x-table.body.td class="w-12">
                            <livewire:private.absences.absence-edit-component wire:key="edit-{{ $absence->id }}" :absence="$absence">
                        </x-table.body.td>
                        <x-table.body.td class="w-12">
                            <livewire:private.absences.absence-delete-component wire:key="delete-{{ $absence->id }}" :absence="$absence">
                        </x-table.body.td>
                    </x-table.body.tr>
                @endforeach
            </x-table.body>
        </x-table>

        {{ $absences->links('vendor.pagination.tailwind') }}
    @else
        <div class="w-full flex flex-col items-center gap-2">
            <img src="{{ asset('assets/registers-not-found.svg') }}" alt="" class="max-w-72">
            <p class="text-base text-center">Você ainda não registrou afastamentos.</p>
        </div>         
    @endif
</div>