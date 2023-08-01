<x-livewire-tables::bs4.table.cell>
    {{ $row->tajuk_kecil }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->keterangan }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.subUpkj.includes.actions', ['subUpkj' => $row])
</x-livewire-tables::bs4.table.cell>
