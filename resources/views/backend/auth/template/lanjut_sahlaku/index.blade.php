@inject('model', '\App\Models\HantarDokumen')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Pelanjutan Tempoh Sah Laku Tender'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Pelanjutan Tempoh Sah Laku Tender') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Rujukan')</label>
                <div class="col-md-10">
                    <input name="rujukan" value="{{ $data->rujukan }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Alamat')</label>
                <div class="col-md-10">
                    <textarea name="alamat" id="alamat" class="form-control" readonly style="height: 210px;">{{ $data->alamat }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Untuk Perhatian')</label>
                <div class="col-md-10">
                    <input name="up" value="{{ $data->up }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Panggilan Hormat')</label>
                <div class="col-md-10">
                    <input name="title" value="{{ $data->title }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Tajuk')</label>
                <div class="col-md-10">
                    <textarea name="tajuk" id="tajuk" class="form-control" readonly style="height: 40px;">{{ $data->tajuk }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 1')</label>
                <div class="col-md-10">
                    <textarea name="text_1" id="text_1" class="form-control" readonly style="height: 90px;">{{ $data->text_1 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 2 (jika ada)')</label>
                <div class="col-md-10">
                    <textarea name="text_2" id="text_2" class="form-control" readonly style="height: 40px;">{{ $data->text_2 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Moto')</label>
                <div class="col-md-10">
                    <textarea name="moto" id="moto" class="form-control" readonly style="height: 80px;">{{ $data->moto }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Frasa Akhir')</label>
                <div class="col-md-10">
                    <textarea name="sym" id="sym" class="form-control" readonly>{{ $data->sym }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Nama Pelulus')</label>
                <div class="col-md-10">
                    <input name="nama" value="{{ $data->nama }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Jawatan Pelulus')</label>
                <div class="col-md-10">
                    <input name="jawatan" value="{{ $data->jawatan }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Kementerian Pelulus')</label>
                <div class="col-md-10">
                    <input name="kementerian" value="{{ $data->kementerian }}" class="form-control" readonly>
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
            window.location.href="sahlaku/" + id + "/edit";
        }

        function panduan() {
            Swal.fire({
                width: 1200,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/lanjut_sahlaku.PNG',
                imageWidth: 1200,
                imageHeight: 500,
                confirmButtonText: 'Kembali',
            })
        }

        function generate() {
            const result = Math.random().toString(36).substring(2,7);
            window.location.href="/admin/auth/sahlaku/downloadsahlaku/" + result;
        }
      </script>
@endsection
