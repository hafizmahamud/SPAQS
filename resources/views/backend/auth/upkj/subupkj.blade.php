@extends('backend.layouts.app')

@section('title', __('UPKJ'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> {{$upkj -> tajuk}} : {{$upkj -> keterangan}} </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.subUpkj.create', $upkj)"
                    :text="__('Tambah Sub UPKJ')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            @livewire('backend.sub-upkj-table',['id' => $upkj -> id])
        </x-slot>
    </x-backend.card>
    <script>
        function padam(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Sub UPKJ ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/subUpkj/delete/" + id;
                }
            });
        }
    </script>
@endsection
