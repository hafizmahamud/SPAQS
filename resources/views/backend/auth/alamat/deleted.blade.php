@extends('backend.layouts.app')

@section('title', __('Bahagian dihapuskan'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Alamat dihapuskan')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.alamat-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection
