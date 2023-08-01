<x-livewire-tables::bs4.table.cell>
    {{ $row->message }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
@if ($row->enabled == 't' )
    <span class="badge badge-success">@lang('Yes')</span>
@else
    <span class="badge badge-danger">@lang('No')</span>
@endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if($row->starts_at)
        {{\Carbon\Carbon::parse($row->starts_at)->format('d/m/Y')}}
    @else
         -
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if($row->ends_at)
        {{\Carbon\Carbon::parse($row->ends_at)->format('d/m/Y')}}
    @else
        -
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.announcement.includes.actions', ['announcement' => $row])
</x-livewire-tables::bs4.table.cell>