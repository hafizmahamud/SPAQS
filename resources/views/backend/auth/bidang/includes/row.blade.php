<x-livewire-tables::bs4.table.cell>
    {{ $row->kod }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->bidang }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.bidang.includes.actions', ['bidang' => $row])
</x-livewire-tables::bs4.table.cell>
