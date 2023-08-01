<x-livewire-tables::bs4.table.cell>
    @if ($row->type === \App\Domains\Auth\Models\User::TYPE_ADMIN)
        {{ __('Administrator') }}
    @elseif ($row->type === \App\Domains\Auth\Models\User::TYPE_USER)
        {{ __('User') }}
    @else
        N/A
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->users_count != 0)
    <x-utils.link :href="route('admin.auth.role.view', $row)" class="btn btn-info btn-sm" icon="fas fa-search" :text="__('Lihat '.$row->users_count.' Pengguna' )" />
    @else
    <p style="margin-left:4%">Tiada Pengguna</p>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.role.includes.actions', ['model' => $row])
</x-livewire-tables::bs4.table.cell>
