@extends('backend.layouts.app')

@section('title', __('Role Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Role Management') </span>
        </x-slot>

        <x-slot name="body">
            <livewire:backend.roles-table />
        </x-slot>
    </x-backend.card>
@endsection
