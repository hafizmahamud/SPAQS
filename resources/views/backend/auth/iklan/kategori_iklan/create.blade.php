@php
$value = \Modules\Sisdant\Models\JenisIklan::select('nama', 'id')->get();
@endphp
@extends('backend.layouts.app')

@section('title', __('Tambah Kategori Perolehan'))

@section('content')
    <x-forms.post :action="route('admin.auth.iklan.simpan_kategori_iklan')">
        <x-backend.card>
            <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Tambah Kategori Perolehan') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.iklan.kategori_iklan')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Nama')</label>

                        <div class="col-md-10">
                            <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="nama" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('nama') }}" maxlength="100" required />
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Tambah')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
