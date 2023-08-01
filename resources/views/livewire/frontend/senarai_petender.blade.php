
<div>
    <x-livewire-tables::bs4.table.cell>
        {{ $loop->index + 1}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        <a href="/tunas/viewpetender/{{$row->iklan_perolehan_id}}/{{$row->id}}">{{ strtoupper($row->nama_syarikat)}}</a>
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{\Carbon\Carbon::parse($row->tarikh_tamat_spkk)->format('d/m/Y')}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->emel_rasmi}}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @if (strtoupper($row->status_petender) == "GAGAL")
            <i class="mdi mdi-account-remove" style="font-size: 25px; color: #f61818;" ></i><span class="tooltip-text-livewire" style="font-weight: bold; background:#E1F4FC !important; ">Gagal</span>
        @elseif (strtoupper($row->status_petender) == "BERJAYA")
            <i class="mdi mdi-account-check" style="font-size: 25px; color: #5e9efd;" ></i><span class="tooltip-text-livewire" style="font-weight: bold; background:#E1F4FC !important; ">Berjaya</span>
        @elseif (strtoupper($row->status_petender) == "DALAM PROSES")
            <i class="mdi mdi-account-alert" style="font-size: 25px; color: #9aa1a9;" ></i><span class="tooltip-text-livewire" style="font-weight: bold; background:#E1F4FC !important; ">Dalam proses</span>
        @endif
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @if (!strtoupper($row->status_resit))
            -
        @elseif (strtoupper($row->status_resit) == "BARU")
            <a href="/tunas/verifyresit/{{$row->id}}" class="text-center btn btn-outline-primary-rounded-pill-list" style="text-align:left; ">LIHAT</a>
        @elseif (strtoupper($row->status_resit) == "GAGAL")
          TAK SAH
        @elseif (strtoupper($row->status_resit) == "SAH")
            SAH
        @endif
    </x-livewire-tables::bs4.table.cell>

</div>
