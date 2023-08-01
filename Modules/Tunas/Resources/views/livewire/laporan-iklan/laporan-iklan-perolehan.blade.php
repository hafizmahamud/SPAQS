@if ($loop->index == 0)
<button id="exportcsv" class="btn btn-success btn-sm" wire:click="export" style="float: right; padding: 1 3 1 3!important; margin-left: 4px; margin-bottom: 5px;" data-toggle="tooltip" data-placement="top" title="Muat Turun Laporan">
    <i  class="mdi mdi-file-excel" style="font-size: 25px; cursor: pointer; display: contents;"></i>
</button>
<button id="exportpdf" class="btn btn-danger btn-sm" wire:click="exportPDF" style="float: right; padding: 1 3 1 3!important; margin-right:10px;" data-toggle="tooltip" data-placement="top" title="Muat Turun Laporan">
    <i  class="mdi mdi-file-pdf" style="font-size: 25px; cursor: pointer; display: contents;"></i>
</button>
<div wire:loading>
    Loading...
</div>
@endif

<td>{{ $loop->index + 1}}</td>
<td>{{$row->mohonNoPerolehan->negeri['negeri']}}</td>
<td>
    <a style="color: blue">{{ $row->mohonNoPerolehan['no_perolehan'] }}</a>
    <br>    
    {{$row->mohonNoPerolehan['tajuk_perolehan']}}
</td>
<td>{{\Carbon\Carbon::parse($row-> tarikh_keluar_iklan)->format('d/m/Y')}}</td>
<td>{{\Carbon\Carbon::parse($row-> tarikh_waktu_tutup)->format('d/m/Y')}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->jenisIklan['nama']}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama']}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->jenisTender['nama']}}</td>
<td>{{$row->statusIklan['status']}}</td>
