@inject('model', '\App\Models\SuratEdarKeputusan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Surat Edar Keputusan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Surat Edar Keputusan') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Rujukan')</label>
                <div class="col-md-10">
                    <input name="rujukan" id="rujukan" class="form-control" readonly value="{{ $data->rujukan }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Panggilan Hormat')</label>
                <div class="col-md-10">
                    <input name="title" id="title" class="form-control" readonly value="{{ $data->title }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Kementerian')</label>
                <div class="col-md-10">
                    <input name="kementerian" id="kementerian" class="form-control" readonly value="{{ $data->kementerian }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 1')</label>
                <div class="col-md-10">
                    <textarea name="text_1" id="text_1" class="form-control" readonly>{{ $data->text_1 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 2')</label>
                <div class="col-md-10">
                    <textarea name="text_2" id="text_2" class="form-control" readonly>{{ $data->text_2 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 3 (jika ada)')</label>
                <div class="col-md-10">
                    <textarea name="text_3" id="text_3" class="form-control" readonly>{{ $data->text_3 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Moto')</label>
                <div class="col-md-10">
                    <textarea name="moto" id="moto" class="form-control" readonly style="height: 90px;">{{ $data->moto }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Frasa Akhir')</label>
                <div class="col-md-10">
                    <input name="sym" id="sym" class="form-control" readonly value="{{ $data->sym }}">
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <label class="btn float-left" onclick="panduan()" style="color: blue;">Panduan</label>
            <button class="btn btn-success float-right" onclick="view({{ $data->id }})" type="submit" style="width: auto; height: 1%;">@lang('Kemaskini')</button>
            <button class="btn btn-info float-right" onclick="generate()" type="button" style="width: auto; margin-right:1%; height: 1%;">@lang('Muat Turun Template')</button>
        </x-slot>
    </x-backend.card>
    <script>
        function view(id) {
            window.location.href="suratkeputusan/" + id + "/edit";
        }

        function panduan() {
            Swal.fire({
                width: 600,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/srt_keputusan.PNG',
                imageWidth: 600,
                imageHeight: 600,
                confirmButtonText: 'Kembali',
            })
        }

        function generate() {
            const result = Math.random().toString(36).substring(2,7);
            window.location.href="/admin/auth/suratkeputusan/downloadsuratkeputusan/" + result;
        }
      </script>
@endsection
