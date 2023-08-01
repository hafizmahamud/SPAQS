@extends('backend.layouts.app')

@section('title', __('Senarai Alamat'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Alamat') </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.alamat.create')"
                    :text="__('Tambah Alamat')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.alamat-table />
        </x-slot>
    </x-backend.card>
    <script>
        function padam(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam alamat ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/alamat/delete/" + id;
                }
            });
        }
    </script>
@endsection
