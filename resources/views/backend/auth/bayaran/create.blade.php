@inject('model', '\Modules\Sisdant\Models\Bidang')

@extends('backend.layouts.app')

@section('title', __('Tambah Bayaran Kepada'))

@section('content')
    <x-forms.post :action="route('admin.auth.bayaran.store')">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Tambah Bayaran Kepada') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.bayaran.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>
                    <div class="form-group row">
                        <label for="bidang" class="col-md-2 col-form-label">@lang('Bayaran Kepada')</label>

                        <div class="col-md-10">
                            <input type="text" name="nama" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('BAYARAN KEPADA') }}" value="{{ old('nama') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Tambah')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
