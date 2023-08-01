<x-livewire-tables::bs4.table.cell>
    {!! $row->bahagian !!}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->singkatan }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.bahagian.includes.actions', ['model' => $row])
</x-livewire-tables::bs4.table.cell>
