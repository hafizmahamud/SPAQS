
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
        {{ $row->tajuk_perolehan }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->matrikIklan['jenisIklan']['nama'] }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
            <a href="{{ url('/sisdant/editpermohonandraf',['id'=>$row->id_perolehan]) }}" class="btn btn-primary-rounded-pill-list" style="width:180px;">{{ strtoupper("DRAF") }}</a>
    </x-livewire-tables::bs4.table.cell>
    </div>
