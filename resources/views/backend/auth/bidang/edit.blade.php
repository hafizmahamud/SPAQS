@extends('backend.layouts.app')

@section('title', __('Kod Bidang'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> {{$bidang -> kod}} : {{$bidang -> bidang}} </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.subBidang.create', $bidang)"
                    :text="__('Tambah Sub Bidang')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            @livewire('backend.subidang-table',['id' => $bidang -> id])
        </x-slot>
    </x-backend.card>
    <script>
        function padam(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Sub Bidang ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/subBidang/delete/" + id;
                }
            });
        }
    </script>
@endsection
