@inject('model', '\Modules\Sisdant\Models\JenisIklan')

@extends('backend.layouts.app')

@section('title', __('Kemaskini Jenis Iklan'))

@section('content')
    <x-forms.patch :action="route('admin.auth.iklan.update', $jenisIklan)">
        <x-backend.card>
            <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Kemaskini Jenis Iklan') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.iklan.jenis_iklan')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Nama')</label>

                        <div class="col-md-10">
                        <input onkeyup="this.value = this.value.toUpperCase();" type="text"  name="nama" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('nama') ?? $jenisIklan->nama }}" maxlength="100" required />
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
