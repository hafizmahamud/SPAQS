@extends('backend.layouts.app')

@section('title', __('Kemaskini Bayaran Kepada'))

@section('content')
    <x-forms.patch :action="route('admin.auth.bayaran.update', $bayarKepada)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Kemaskini Bayaran Kepada') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.bayaran.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Bayaran Kepada')</label>

                        <div class="col-md-10">
                            <input type="text" name="nama" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('BAYARAN KEPADA') }}" value="{{ old('nama') ?? $bayarKepada->nama }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection