<x-livewire-tables::bs4.table.cell>
    {{-- {{ $row->jenis_iklan_id }} --}}
    @include('backend.auth.iklan.includes.nama_iklan', ['row' => $row->jenis_iklan_id])
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- {{ $row->kategori_perolehan_id }} --}}
    @include('backend.auth.iklan.includes.nama_kategori', ['row' => $row->kategori_perolehan_id])
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- {{ $row->jenis_tender_id }} --}}
    @include('backend.auth.iklan.includes.nama_tender', ['row' => $row->jenis_tender_id])
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.iklan.includes.status_muatnaik', ['row' => $row->upload_iklan])
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.iklan.includes.actions_matrik_iklan', ['matrik' => $row])
</x-livewire-tables::bs4.table.cell>
