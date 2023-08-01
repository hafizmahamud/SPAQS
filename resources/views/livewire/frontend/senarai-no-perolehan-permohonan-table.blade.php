
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
        @if ($row->status == "sah" || $row->status == "draf-iklan")
            <a href="#"  style="cursor: default;">{{ $row->no_perolehan }}</a><br>
        @endif
        {{ $row->tajuk_perolehan }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->matrikIklan['jenisIklan']['nama'] }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @if ($row->status == "sah")
            <a href="{{ url('/sisdant/editpermohonansah',['id'=>$row->id_perolehan]) }}" class="btn btn-outline-primary-rounded-pill-list" style="width:180px;">{{ strtoupper("kemaskini") }}</a>
        @elseif ($row->status == "batal")
            {{-- <a onclick="deletelist({{ $row->id_perolehan }})" class="btn btn-secondary-rounded-pill-list" style="width:180px;">{{ strtoupper($row->status) }}</a> --}}
            <a href="{{ url('/sisdant/viewpermohonanstatusbatal',['id'=>$row->id_perolehan]) }}" class="btn btn-secondary-rounded-pill-list" style="width:180px;">{{ strtoupper($row->status) }}</a>
        @elseif ($row->status == "belum sah")
            <a href="{{ url('/sisdant/editpermohonanbelumsah',['id'=>$row->id_perolehan]) }}" class="btn btn-outline-primary-rounded-pill-list" style="width:180px;">{{ strtoupper('dalam proses') }}</a>

        @elseif ($row->status == "draf-iklan")
            <a href="sisdant/viewiklan/{{$row->id_perolehan}}" class="btn btn-outline-primary-rounded-pill-list" style="width:180px;">{{ strtoupper('kemaskini') }}</a>
        @elseif ($row->status == "selesai")
            <a href="#" class="btn btn-primary-rounded-pill-list" style="width:180px;">{{ strtoupper("selesai") }}</a>
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
