@extends('backend.layouts.app')

@section('title', __('Senarai Bahagian'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;">{{$negeri->singkatan}} : {{$negeri->negeri}}</span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.bahagian.create', $negeri)"
                    :text="__('Tambah bahagian')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.bahagian-table :id="$negeri->id" />
        </x-slot>
    </x-backend.card>
    <script>
        function padam(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam bahagian ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/bahagian/delete/" + id;
                }
            });
        }
    </script>
@endsection
