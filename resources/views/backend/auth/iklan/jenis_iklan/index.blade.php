@extends('backend.layouts.app')

@section('title', __('Jenis Iklan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Jenis Iklan') </span>
        </x-slot>

        <x-slot name="headerActions">
            {{-- <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.iklan.create_jenis_iklan')"
                :text="__('Tambah Jenis Iklan')"
            /> --}}
        </x-slot>

        <x-slot name="body">
            <livewire:backend.jenis-iklan-table />
        </x-slot>
    </x-backend.card>

    <script>
        function ya(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Jenis Iklan ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/iklan/jenis_iklan/delete/"+ id ;
                }
            });
        }
    </script>
@endsection