
<div>
<x-livewire-tables::bs4.table.cell>
    {{ $loop->index + 1}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{-- <a class="text-center">{{\Carbon\Carbon::parse($row->mohonnoperolehan['updated_at'])->format('d/m/Y')}}</a> --}}
    <a class="text-center">{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell style="width:55%">
    @if ($row->status_iklan_id == 2)
        <a href="tunas/viewiklan/{{$row->id}}" class="text-center btn btn-outline-primary-rounded-pill-list" style="margin-bottom:10px">{{ $row->mohonnoperolehan['no_perolehan'] }}</a>
    @elseif ($row->status_iklan_id == 3)
        <a href="tunas/viewiklan/{{$row->id}}" class="text-center btn btn-secondary-rounded-pill-list" style="margin-bottom:10px">{{ $row->mohonnoperolehan['no_perolehan'] }}</a>
        @elseif ($row->status_iklan_id == 4)
        <a href="tunas/viewiklan/{{$row->id}}" class="text-center btn btn-primary-rounded-pill-list" style="margin-bottom:10px">{{ $row->mohonnoperolehan['no_perolehan'] }}</a>
    @endif
    <br>
    <a class="text-center">{{ $row->mohonnoperolehan['tajuk_perolehan'] }}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-center">{{ strtoupper($row->user['name']) }}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-center">{{ $row->mohonnoperolehan['matrikIklan']['jenisIklan']['nama'] }}</a>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-center">{{\Carbon\Carbon::parse($row->tarikh_keluar_iklan)->format('d/m/Y')}}</a>
</x-livewire-tables::bs4.table.cell>
</div>
