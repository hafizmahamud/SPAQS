<x-livewire-tables::bs4.table.cell>
    {{ $row->nama }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.iklan.includes.actions_kategori_perolehan', ['kategoriPerolehan' => $row])
</x-livewire-tables::bs4.table.cell>
