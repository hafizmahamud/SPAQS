
<div>
<x-livewire-tables::bs4.table.cell>
    {{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- <a class="text-center">{{\Carbon\Carbon::parse($row->mohonnoperolehan['updated_at'])->format('d/m/Y')}}</a> --}}
    <a class="text-center">{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell style="width:35%">
    <a style="color: blue; cursor: default;">{{ $row->mohonnoperolehan['no_perolehan'] }}</a>
    <br>
    <a class="text-center">{{ $row->mohonnoperolehan['tajuk_perolehan'] }}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-center">{{ strtoupper($row->user['name']) }}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-center">{{ $row->mohonnoperolehan['matrikIklan']['jenisIklan']['nama'] }}</a>
</x-livewire-tables::bs4.table.cell>



<x-livewire-tables::bs4.table.cell>
    @if ($row->pegawaiBatal)
        <a class="text-center">{{ strtoupper($row->pegawaiBatal['name']) }}</a>
    @else
        <a class="text-center">{{ strtoupper('SISTEM / AUTO') }}</a>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-center">{{\Carbon\Carbon::parse($row->tarikh_batal)->format('d/m/Y')}}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a onclick="lihatJustifikasi({{ $row->id }})" class="text-center btn btn-secondary-rounded-pill-list" style="width:100px;">{{ strtoupper("lihat") }}</a>
</x-livewire-tables::bs4.table.cell>
</div>
