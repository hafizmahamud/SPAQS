
<div>
<x-livewire-tables::bs4.table.cell>
    {{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- {{ $row }} <br> --}}
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
    {{ $row->tahun_perolehan }}<br>
    {{-- {{ $row->iklanPerolehan['tarikh_keluar_iklan'] }}<br>
    {{ $row->iklanPerolehan['tarikh_waktu_tutup'] }}<br> --}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if($row->iklanPerolehan)
        @if($row->iklanPerolehan['status_iklan_id'] == 6)
            <a style="width:180px; color: black; font-weight: bold;">{{ strtoupper("BATAL") }}</a>

        @elseif((\Carbon\Carbon::parse($row->iklanPerolehan['tarikh_keluar_iklan'])->format('d/m/Y')) > (\Carbon\Carbon::now()->format('d/m/Y'))
                && (($row->iklanPerolehan['status_iklan_id'] == 3) ||($row->iklanPerolehan['status_iklan_id'] == 4)))
            <a style="font-weight: bold; width:180px; color:#2684FF">{{ strtoupper( "MENUNGGU IKLAN") }}</a>
        @elseif($row->iklanPerolehan['status_iklan_id'] == 2)
            <a style="font-weight: bold; width:180px; color:#2684FF">{{ strtoupper( "MENUNGGU IKLAN") }}</a>
        @elseif((\Carbon\Carbon::parse($row->iklanPerolehan['tarikh_keluar_iklan'])->format('d/m/Y')) <= (\Carbon\Carbon::now()->format('d/m/Y'))
                && (\Carbon\Carbon::parse($row->iklanPerolehan['tarikh_waktu_tutup'])->format('d/m/Y')) >= (\Carbon\Carbon::now()->format('d/m/Y'))
                && $row->iklanPerolehan['status_iklan_id'] == 4 )
            <a style="font-weight: bold; width:180px; color:#2684F">{{ strtoupper('IKLAN DIBUKA') }}</a>
        @endif
    @endif
</x-livewire-tables::bs4.table.cell>
</div>
