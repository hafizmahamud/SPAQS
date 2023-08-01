<x-livewire-tables::bs4.table.cell>
    {{ $row->kod }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->kelas }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.kelas.includes.actions', ['kelas' => $row])
</x-livewire-tables::bs4.table.cell>
