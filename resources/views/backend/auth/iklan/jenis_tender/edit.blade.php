@inject('model', '\Modules\Sisdant\Models\JenisIklan')
@inject('model', '\Modules\Sisdant\Models\KategoriPerolehan')

@extends('backend.layouts.app')

@section('title', __('Kemaskini Jenis Perolehan'))

@section('content')
    <x-forms.patch :action="route('admin.auth.iklan.update_jenis_tender', $jenisTender)">
        <x-backend.card>
            <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Kemaskini Jenis Perolehan') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.iklan.jenis_tender')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Nama')</label>

                        <div class="col-md-10">
                        <input onkeyup="this.value = this.value.toUpperCase();" type="text"  name="nama" class="form-control" placeholder="{{ __('Nama') }}" value="{{ old('nama') ?? $jenisTender->nama }}" maxlength="100" required />
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
