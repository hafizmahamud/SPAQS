@inject('model', '\Modules\Sisdant\Models\KelasUpkj')

@extends('backend.layouts.app')

@section('title', __('Tambah Upkj'))

@section('content')
    <x-forms.post :action="route('admin.auth.upkj.store')">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Tambah Upkj') </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.upkj.index')" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>

                    <div class="form-group row">
                        <label for="tajuk" class="col-md-2 col-form-label">@lang('Tajuk')</label>

                        <div class="col-md-10">
                            <input type="text" name="tajuk" class="form-control" placeholder="{{ __('TAJUK') }}" value="{{ old('tajuk') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="keterangan" class="col-md-2 col-form-label">@lang('Keterangan')</label>

                        <div class="col-md-10">
                            <input type="text" name="keterangan" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('KETERANGAN') }}" value="{{ old('keterangan') }}" maxlength="255" required />
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
