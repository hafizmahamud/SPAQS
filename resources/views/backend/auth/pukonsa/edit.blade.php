@extends('backend.layouts.app')

@section('title', __('Sub Kelas Pukonsa'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> {{$kelasPukonsa -> tajuk}} : {{$kelasPukonsa -> keterangan}} </span>
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.subKelasPukonsa.create', $kelasPukonsa)"
                    :text="__('Tambah Sub Kelas Pukonsa')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            @livewire('backend.sub-kelas-pukonsa-table',['id' => $kelasPukonsa -> id])
        </x-slot>
    </x-backend.card>
    <script>
        function padam(id) {
            Swal.fire({
                title: 'Adakah anda pasti untuk padam Sub Kelas Pukonsa ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/admin/auth/subKelasPukonsa/delete/" + id;
                }
            });
        }
    </script>
@endsection
