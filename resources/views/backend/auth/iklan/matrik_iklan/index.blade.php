@extends('backend.layouts.app')

@section('title', __('Matrik Iklan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Matrik Iklan') </span>
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.iklan.create_matrik')"
                :text="__('Tambah Matrik Iklan')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.iklan-table />
        </x-slot>
    </x-backend.card>
    <script>
        function ya(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Matrik Iklan ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/iklan/matrik_iklan/padam_matrik_iklan/"+ id ;
                }
            });
        }
    </script>
@endsection