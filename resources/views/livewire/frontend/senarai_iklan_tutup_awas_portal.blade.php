
<div>
<x-livewire-tables::bs4.table.cell>
    {{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{$row->mohonNoPerolehan->negeri['negeri']}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>


    @if($row->status_kemaskini_penilaian == 0 && $row->tarikh_kemaskini_penilaian == null)
        <a href="awas/penilaian/{{$row->mohon_no_perolehan_id}}" class="text-center btn btn-outline-primary-rounded-pill-list" style="margin-bottom:10px; color: blue;">{{$row->mohonNoPerolehan->no_perolehan}}</a></br>
    @elseif($row->tarikh_kemaskini_penilaian !== null && $row->status_kemaskini_penilaian == 0)
        <a href="awas/editpenilaian/{{$row->mohon_no_perolehan_id}}" class="text-center btn btn-secondary-rounded-pill-list" style="margin-bottom:10px; color: white;">{{$row->mohonNoPerolehan->no_perolehan}}</a></br>
    @endif
    {{$row->mohonNoPerolehan->tajuk_perolehan}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{\Carbon\Carbon::parse($row->tarikh_waktu_tutup)->format('d/m/Y')}}
</x-livewire-tables::bs4.table.cell>



</div>