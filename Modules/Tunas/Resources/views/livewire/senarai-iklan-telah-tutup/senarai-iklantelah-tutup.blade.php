<td>{{ $loop->index + 1}}</td>
<td>{{$row->mohonNoPerolehan->negeri['negeri']}}</td>
<td><a class="btn btn-primary-rounded-pill-list" href="#"  onclick="jadualharga('{{$row->id}}')" role="button" style="margin-bottom:10px">
    {{$row->mohonNoPerolehan['no_perolehan']}}</a><br>
    {{$row->mohonNoPerolehan['tajuk_perolehan']}}
</td>
<td>{{\Carbon\Carbon::parse($row-> tarikh_keluar_iklan)->format('d/m/Y')}}</td>
<td>{{\Carbon\Carbon::parse($row-> tarikh_waktu_tutup)->format('d/m/Y')}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->jenisIklan['nama']}}</td>
<td>{{$row->mohonNoPerolehan->matrikIklan->kategoriPerolehan['nama']}}</td>
<td>{{\Carbon\Carbon::parse($row-> updated_at)->format('d/m/Y')}}</td>