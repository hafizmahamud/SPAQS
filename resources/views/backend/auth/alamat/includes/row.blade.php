<x-livewire-tables::bs4.table.cell>
    {!! $row->jenis_alamat !!}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->alamat }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.alamat.includes.actions', ['model' => $row])
</x-livewire-tables::bs4.table.cell>
