@inject('model', '\App\Models\LantikanPenilai')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Memo Lantikan Penilai'))

@section('content')
    <x-forms.post :action="route('admin.auth.lantikanpenilai.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Memo Lantikan Penilai') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.lantikanpenilai.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_1" id="text_1" class="form-control" required style="height: 70px;">{{ $data->text_1 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 2')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_2" id="text_2" class="form-control" required style="height: 70px;">{{ $data->text_2 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 2.1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_3" id="text_3" class="form-control" required style="height: 40px;">{{ $data->text_3 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 3 (jika ada)')</label>
                    <div class="col-md-10">
                        <textarea name="text_4" id="text_4" class="form-control" style="height: 40px;">{{ $data->text_4 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Moto')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="moto_1" id="moto_1" class="form-control" required style="height: 70px;">{{ $data->moto_1 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Frasa Akhir')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="sym" id="sym" class="form-control" required>{{ $data->sym }}</textarea>
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
