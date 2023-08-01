@inject('model', '\App\Models\MemoEdarKeputusan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Memo Edar Keputusan'))

@section('content')
    <x-forms.post :action="route('admin.auth.memokeputusan.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Memo Edar Keputusan') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.memokeputusan.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Rujukan')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="rujukan" id="rujukan" class="form-control" required value="{{ $data->rujukan }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Perkara')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="perkara" id="perkara" class="form-control" required value="{{ $data->perkara }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Kementerian')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="kementerian" id="kementerian" class="form-control" required value="{{ $data->kementerian }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Kementerian (singkatan)')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="kementerian1" id="kementerian1" class="form-control" required value="{{ $data->kementerian1 }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_1" id="text_1" class="form-control" required>{{ $data->text_1 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Panggilan Hormat')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="title" id="title" class="form-control" required>{{ $data->title }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 2 (jika ada)')</label>
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
