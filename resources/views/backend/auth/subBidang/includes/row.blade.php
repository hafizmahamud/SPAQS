<x-livewire-tables::bs4.table.cell>
    {{ $row->kod }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->sub_bidang }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.subBidang.includes.actions', ['subBidang' => $row])
</x-livewire-tables::bs4.table.cell>
