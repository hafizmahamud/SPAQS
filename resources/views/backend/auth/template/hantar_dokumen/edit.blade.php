@inject('model', '\App\Models\HantarDokumen')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Kertas Perakuan Kepada Lembaga Perolehan'))

@section('content')
    <x-forms.post :action="route('admin.auth.hantardokumen.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Kertas Perakuan Kepada Lembaga Perolehan') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.hantardokumen.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Rujukan')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="rujukan" value="{{ $data->rujukan }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Alamat')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="alamat" id="alamat" class="form-control" required style="height: 190px;">{{ $data->alamat }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Untuk Perhatian')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="up" value="{{ $data->up }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Panggilan Hormat')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="title" value="{{ $data->title }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Tajuk')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="tajuk" value="{{ $data->tajuk }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_1" id="text_1" class="form-control" required style="height: 40px;">{{ $data->text_1 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1.1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_2" id="text_2" class="form-control" required style="height: 40px;">{{ $data->text_2 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 2 (jika ada)')</label>
                    <div class="col-md-10">
                        <textarea name="text_3" id="text_3" class="form-control" style="height: 40px;">{{ $data->text_3 }}</textarea>
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
                        <input name="sym" value="{{ $data->sym }}" class="form-control" required>
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
