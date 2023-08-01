@extends('backend.layouts.app')

@section('title', __('Log Sistem'))

@section('content')
<style>
ul.dropdown-menu 
    {
       width:200px !important;
    }
</style>
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Log Sistem') </span>
        </x-slot>

        <x-slot name="body">
            <livewire:backend.log-table />
        </x-slot>
    </x-backend.card>
@endsection


