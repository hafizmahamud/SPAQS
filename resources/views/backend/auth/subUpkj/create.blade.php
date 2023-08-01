@inject('model', '\Modules\Sisdant\Models\SubKelasUpkj')

@extends('backend.layouts.app')

@section('title', __('Tambah Sub UPKJ'))

@section('content')
    <x-forms.post :action="route('admin.auth.subUpkj.store')">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> {{$upkj -> tajuk}} : {{$upkj -> keterangan}} </span>
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.upkj.subupkj', $upkj -> id)" :text="__('Kembali')" />
            </x-slot>

            <x-slot name="body">
                <div>

                    <div class="form-group row">
                        <label for="tajuk_kecil" class="col-md-2 col-form-label">@lang('Tajuk Kecil')</label>

                        <div class="col-md-10">
                            <input type="text" name="tajuk_kecil" class="form-control" placeholder="{{ __('TAJUK KECIL') }}" value="{{ old('tajuk_kecil') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="keterangan" class="col-md-2 col-form-label">@lang('Keterangan')</label>

                        <div class="col-md-10">
                            <input type="text" name="keterangan" class="form-control" onkeyup="this.value = this.value.toUpperCase();" placeholder="{{ __('KETERANGAN') }}" value="{{ old('keterangan') }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row" hidden>
                        <label for="upkj_id" class="col-md-2 col-form-label">@lang('UPKJ ID')</label>

                        <div class="col-md-10">
                            <input type="number" name="upkj_id" class="form-control" value="{{$upkj -> id}}" maxlength="255" required />
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
