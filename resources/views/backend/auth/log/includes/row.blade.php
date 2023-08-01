<style>
.ml-0 .ml-md-2 .mb-3 .mb-md-0
    {
       width:500px !important;
    }
</style>
<x-livewire-tables::bs4.table.cell>
    {!! $row->name !!}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->log_name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->description }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
{{\Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i')}}
</x-livewire-tables::bs4.table.cell>

