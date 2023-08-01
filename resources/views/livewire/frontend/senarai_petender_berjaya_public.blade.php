<div>
<x-livewire-tables::bs4.table.cell>
{{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{$row->iklanPerolehan->mohonNoPerolehan->negeri['negeri']}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
@if(!($row->iklanPerolehan->dokumenKontrak)->isEmpty())
    @if($row->iklanPerolehan->dokumenKontrak[0]['tarikh_sign_sst'] == null)
    <a href="#" class="text-center btn btn-outline-primary-rounded-pill-list" onclick="butiran('{{$row->id}}')" style="margin-bottom:10px; color: blue;">{{$row->iklanPerolehan->mohonNoPerolehan->no_perolehan}}</a></br>
    @else
    <a href="#" class="text-center btn btn-primary-rounded-pill-list" onclick="butiran('{{$row->id}}')" style="margin-bottom:10px; color: white;">{{$row->iklanPerolehan->mohonNoPerolehan->no_perolehan}}</a><br>
    @endif
@else
<a href="#" class="text-center btn btn-outline-primary-rounded-pill-list" onclick="butiran('{{$row->id}}')" style="margin-bottom:10px; color: blue;">{{$row->iklanPerolehan->mohonNoPerolehan->no_perolehan}}</a></br>
@endif
{{$row->iklanPerolehan->mohonNoPerolehan->tajuk_perolehan}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
{{\Carbon\Carbon::parse($row->iklanPerolehan->tarikh_kemaskini_penilaian)->format('d/m/Y')}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
{{\Carbon\Carbon::parse($row->tarikh_sah_laku)->format('d/m/Y')}}
</x-livewire-tables::bs4.table.cell>
</div>
