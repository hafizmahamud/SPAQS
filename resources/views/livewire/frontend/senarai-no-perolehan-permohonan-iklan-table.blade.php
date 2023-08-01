
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
        <a href="#"  style="cursor: default;">{{ $row->no_perolehan }}</a><br>
        {{ $row->tajuk_perolehan }}

    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->matrikIklan['jenisIklan']['nama'] }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @if ($row->iklanPerolehan['status_iklan_id'] == 2)
            <a href="#" class="text-center btn btn-outline-primary-rounded-pill-list disable" style="width:180px;">{{ strtoupper("menunggu iklan") }}</a>
        @elseif ($row->iklanPerolehan['status_iklan_id'] == 3)
            <a href="#" class="text-center btn btn-secondary-rounded-pill-list disable" style="width:180px;">{{ strtoupper("draf iklan") }}</a>
        @elseif ($row->iklanPerolehan['status_iklan_id'] == 4)
            <a href="sisdant/viewiklansah/{{$row->id_perolehan}}" class="text-center btn btn-primary-rounded-pill-list" style="width:180px;">{{ strtoupper("iklan") }}</a>
        @elseif ($row->iklanPerolehan['status_iklan_id'] == 5)
            <a href="#" class="text-center btn btn-outline-primary-rounded-pill-list disable" style="width:180px;">{{ strtoupper("tutup") }}</a>
        @elseif ($row->iklanPerolehan['status_iklan_id'] == 6)
<a href="sisdant/iklan-batal/{{$row->iklanPerolehan['id']}}" class="text-center btn btn-secondary-rounded-pill-list" style="width:180px;">{{ strtoupper("batal") }}</a>
        @elseif ($row->iklanPerolehan['status_iklan_id'] == 7)
            <a href="#" class="text-center btn btn-outline-primary-rounded-pill-list disable" style="width:180px;">{{ strtoupper("selesai") }}</a>
        @endif
    </x-livewire-tables::bs4.table.cell>
    </div>

    <style>
        .disable{
        pointer-events: none;
        cursor: not-allowed;
        opacity: 0.85;
        filter: alpha(opacity=6?5);
        -webkit-box-shadow: none;
        box-shadow: none
    </style>
