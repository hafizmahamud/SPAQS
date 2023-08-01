@inject('model', '\App\Models\Pelantikan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Surat Akuan Selesai Tugas Ahli Jawatankuasa Penilaian Tender'))

@section('content')
    <x-forms.post :action="route('admin.auth.selesaitugas.update', $data)">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Surat Akuan Selesai Tugas Ahli Jawatankuasa Penilaian Tender') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.selesaitugas.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Tajuk')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="tajuk" id="tajuk" class="form-control" required>{{ $data->tajuk }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Pengenalan')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_1" id="text_1" class="form-control" required>{{ $data->text_1 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_2" id="text_2" class="form-control" required>{{ $data->text_2 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 1.1')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_3" id="text_3" class="form-control" required style="height: 70px;">{{ $data->text_3 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 2')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_4" id="text_4" class="form-control" required style="height: 70px;">{{ $data->text_4 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 3')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_5" id="text_5" class="form-control" required style="height: 60px;">{{ $data->text_5 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 4')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <textarea name="text_6" id="text_6" class="form-control" required style="height: 60px;">{{ $data->text_6 }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Isi 5 (jika ada)')</label>
                    <div class="col-md-10">
                        <textarea name="text_7" id="text_7" class="form-control" style="height: 60px;">{{ $data->text_7 }}</textarea>
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
