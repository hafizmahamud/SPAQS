<x-livewire-tables::bs4.table.cell>
    {{ $row->tajuk_kecil }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->keterangan }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.subKelasPukonsa.includes.actions', ['subKelasPukonsa' => $row])
</x-livewire-tables::bs4.table.cell>
