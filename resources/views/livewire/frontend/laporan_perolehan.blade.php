@if ($loop->index == 0)
<button id="exportcsv" class="btn btn-success btn-sm" wire:click="export" style="float: right; padding: 1 3 1 3!important; margin-left: 4px; margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Muat Turun Laporan">
    <i  class="mdi mdi-file-excel" style="font-size: 25px; cursor: pointer; display: contents;"></i>
</button>
<button id="exportpdf" class="btn btn-danger btn-sm" wire:click="exportPDF" style="float: right; padding: 1 3 1 3!important; margin-right:10px;" data-toggle="tooltip" data-placement="top" title="Muat Turun Laporan">
    <i  class="mdi mdi-file-pdf" style="font-size: 25px; cursor: pointer; display: contents;"></i>
</button>
{{-- <img src={{ url("spaqs/assets/img/excel2.png") }} alt="" style="width: 34px;cursor: pointer;">
<img src={{ url("spaqs/assets/img/pdf2.png") }} alt="" style="width: 25px;cursor: pointer;"> --}}
<div wire:loading>
    Loading....
</div>
@endif
<div>
<x-livewire-tables::bs4.table.cell>
    {{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if($row->section_id)
        {{$row->negeri['negeri']}}<br>
        {{$row->section['bahagian']}}
    @else
        {{$row->negeri['negeri']}}
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a style="color: blue">{{ $row->no_perolehan }}</a>
    <br>
    {{ $row->tajuk_perolehan }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ strtoupper($row->users['name']) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->matrikIklan['jenisIklan']['nama'] }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->matrikIklan['kategoriPerolehan']['nama'] }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->matrikIklan['jenisTender']['nama'] }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->tahun_perolehan }}<br>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ date('d/m/Y', strtotime($row->updated_at)); }}<br>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a style="text-transform: uppercase;">{{ $row->status }} </a>
    {{-- {{ $row->status }} --}}
</x-livewire-tables::bs4.table.cell>
</div>
