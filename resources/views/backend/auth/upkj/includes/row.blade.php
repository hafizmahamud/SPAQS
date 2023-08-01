<x-livewire-tables::bs4.table.cell>
    {{ $row->tajuk }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->keterangan }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.upkj.includes.actions', ['upkj' => $row])
</x-livewire-tables::bs4.table.cell>
