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
<td>{{$row['name']}}</td>
<td>{{$row['email']}}</td>
@if ($row['section_id'] != null)
<td>{{$row->section['bahagian']}}</td>
@else
<td> </td>
@endif
<td>{{$row->negeri['negeri']}}</td>
<td style="width: 90px;text-align: center;">{{$row->Penilai1->count()}}</td>
<td style="width: 90px;text-align: center;">{{$row->Penilai2->count()}}</td>


