@inject('model', '\App\Models\SuratEdarKeputusan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Surat Edar Keputusan'))

@section('content')
    <x-forms.post :action="route('admin.auth.suratkeputusan.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Surat Edar Keputusan') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.suratkeputusan.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Rujukan')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="rujukan" id="rujukan" class="form-control" required value="{{ $data->rujukan }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Panggilan Hormat')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="title" id="title" class="form-control" required value="{{ $data->title }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Kementerian')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="kementerian" id="kementerian" class="form-control" required value="{{ $data->kementerian }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_1" id="text_1" class="form-control" required>{{ $data->text_1 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 2')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_2" id="text_2" class="form-control" required>{{ $data->text_2 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 3 (jika ada)')</label>
                    <div class="col-md-10">
                        <textarea name="text_3" id="text_3" class="form-control">{{ $data->text_3 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Moto')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="moto" id="moto" class="form-control" required style="height: 80px;">{{ $data->moto }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Frasa Akhir')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="sym" id="sym" class="form-control" required value="{{ $data->sym }}">
                    </div>
                </div>
                <input name="id" value="{{ $data->id }}" hidden>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
