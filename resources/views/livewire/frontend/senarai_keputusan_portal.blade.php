
<div>
<x-livewire-tables::bs4.table.cell>
    {{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{$row->mohonNoPerolehan->negeri['negeri']}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>

    @if($row->status_penilaian == "draf")
        <a href="viewdrafkeputusan/{{$row->mohon_no_perolehan_id}}" class="text-center btn btn-secondary-rounded-pill-list" style="margin-bottom:10px; color: white;">{{$row->mohonNoPerolehan->no_perolehan}}</a><br>
    @elseif($row->status_penilaian == "syor_tamat" )
        <a href="viewkeputusan/{{$row->mohon_no_perolehan_id}}" class="text-center btn btn-primary-rounded-pill-list disable" style="margin-bottom:10px; color: white;">{{$row->mohonNoPerolehan->no_perolehan}}</a><br>
    @elseif($row->tarikh_kemaskini_penilaian !== null && $row->status_kemaskini_penilaian > 0)
        <a href="viewpenilaian/{{$row->mohon_no_perolehan_id}}"class="text-center btn btn-outline-primary-rounded-pill-list" style="margin-bottom:10px; color: blue;">{{$row->mohonNoPerolehan->no_perolehan}}</a><br>
    @endif
    {{$row->mohonNoPerolehan->tajuk_perolehan}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{\Carbon\Carbon::parse($row->tarikh_waktu_tutup)->format('d/m/Y')}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if(!$row->keputusan_akhir)
        Belum Dikemaskini
    @else
        {{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if($row->status_penilaian == "syor_selesai")
        Tiada syarikat dipilih
    @elseif($row->status_penilaian == "syor_tamat" )
        @if($row->storage_memo_keputusan)
            <a target="/blank" href="/{{$row->storage_memo_keputusan}}"><i class="las la-download" style="font-size: 24px;"></i></a>
        @else
            <a target="/blank" href="/{{$row->storage_surat_keputusan}}"><i class="las la-download" style="font-size: 24px;"></i></a>
        @endif
    @else
        Tiada keputusan
    @endif
</x-livewire-tables::bs4.table.cell>

</div>