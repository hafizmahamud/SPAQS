<div>
    <x-livewire-tables::bs4.table.cell>
        {{ $loop->index + 1}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->mohonnoperolehan['negeri']['negeri']}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell style="width:45%">
        <a href="/tunas/viewiklanbelumtutup/{{$row->id}}">{{ $row->mohonnoperolehan['no_perolehan'] }}</a>
        <br>
        {{ $row->mohonnoperolehan['tajuk_perolehan']}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{\Carbon\Carbon::parse($row->tarikh_keluar_iklan)->format('d/m/Y')}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{\Carbon\Carbon::parse($row->tarikh_waktu_tutup)->format('d/m/Y')}}
    </x-livewire-tables::bs4.table.cell>
    <?php
    $tarikh_waktu_tutup = strtotime($row->tarikh_waktu_tutup);
    $difference = $tarikh_waktu_tutup - time();

    $hours = floor($difference / 3600);
    $minutes = floor(($difference / 60) % 60);
    ?>
    <x-livewire-tables::bs4.table.cell  style="text-align: right; padding-right:2%">
        @if (round($difference / 86400) != 0)
        {{ round($difference / 86400) }} Hari
        @elseif(round($difference / 60) > 60)
        {{ $hours }} Jam
        {{ $minutes }} Minit
        @else
        {{ round($difference / 60) }} Minit
        @endif
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->mohonnoperolehan['matrikIklan']['jenisIklan']['nama']}}
    </x-livewire-tables::bs4.table.cell>


    <x-livewire-tables::bs4.table.cell>
        @if ((Carbon\Carbon::parse($row->updated_at)->format('d/m/Y') >= Carbon\Carbon::parse($row->tarikh_keluar_iklan)->format('d/m/Y')))
            <a style="color: red">{{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}</a>
        @else
            <a style="color: black">{{\Carbon\Carbon::parse($row->updated_at)->format('d/m/Y')}}</a>
        @endif
    </x-livewire-tables::bs4.table.cell>
    </div>
