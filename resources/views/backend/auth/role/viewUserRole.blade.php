@extends('backend.layouts.app')

@section('title', __('Pengurusan Peranan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Senarai Pengguna '.ucwords(strtolower($roleName->name))) </span>
        </x-slot>
        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.auth.role.index')" :text="__('Kembali')" />
        </x-slot>
        <x-slot name="body">
            @livewire('backend.user-roles-table',['id' => $user])
        </x-slot>
    </x-backend.card>
@endsection
