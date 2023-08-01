@extends('backend.layouts.app')

@section('title', __('Senarai Bayaran Kepada'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Bayaran Kepada') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.bayaran.create')"
                    :text="__('Tambah Bayaran Kepada')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.bayaran-table />
        </x-slot>
    </x-backend.card>

    <script>
        function padam(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Bayaran Kepada ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/bayaran/delete/" + id;
                }
            });
        }
    </script>
@endsection
