<td>{{ $loop->index + 1}}</td>
<td>{{$row->mohonNoPerolehan->negeri['negeri']}}</td>
@if($row->jadual_harga_status == 'TINDAKAN')
<td><a class="btn btn-outline-primary-rounded-pill-list" onclick="butiran('{{$row->id}}')" role="button" style="margin-bottom:10px">
    {{$row->mohonNoPerolehan['no_perolehan']}}</a><br>
    {{$row->mohonNoPerolehan['tajuk_perolehan']}}
</td>
@elseif($row->jadual_harga_status == 'DRAF')
<td><a class="btn btn-secondary-rounded-pill-list" onclick="butiran('{{$row->id}}')" role="button" style="margin-bottom:10px">
    {{$row->mohonNoPerolehan['no_perolehan']}}</a><br>
    {{$row->mohonNoPerolehan['tajuk_perolehan']}}
</td>
@elseif($row->jadual_harga_status == 'SELESAI')
<td><a class="btn btn-primary-rounded-pill-list" onclick="butiran('{{$row->id}}')" role="button" style="margin-bottom:10px">
    {{$row->mohonNoPerolehan['no_perolehan']}}</a><br>
    {{$row->mohonNoPerolehan['tajuk_perolehan']}}
</td>
@endif
<td>{{\Carbon\Carbon::parse($row-> tarikh_keluar_iklan)->format('d/m/Y')}}</td>
<td>{{\Carbon\Carbon::parse($row-> tarikh_waktu_tutup)->format('d/m/Y')}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->jenisIklan['nama']}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama']}}</td>
<td>{{\Carbon\Carbon::parse($row-> updated_at)->format('d/m/Y')}}</td>
