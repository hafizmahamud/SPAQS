<x-livewire-tables::bs4.table.cell>
    {{ $row->nama }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.bayaran.includes.actions', ['bayarKepada' => $row])
</x-livewire-tables::bs4.table.cell>
