@extends('backend.layouts.app')

@section('title', __('Kategori Perolehan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Kategori Perolehan') </span>
        </x-slot>
        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.iklan.create_kategori_perolehan')"
                :text="__('Tambah Kategori Perolehan')"
            />
        </x-slot>
        <x-slot name="body">
            <livewire:backend.kategori-perolehan-table />
        </x-slot>
    </x-backend.card>
    <script>
        function ya(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Kategori Perolehan ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/iklan/kategori_perolehan/padam_kategori_perolehan/"+ id ;
                }
            });
        }
    </script>
@endsection
