<x-livewire-tables::bs4.table.cell>
    {{ $row->kod }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->pengkhususan }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.pengkhususan.includes.actions', ['pengkhususan' => $row])
</x-livewire-tables::bs4.table.cell>
