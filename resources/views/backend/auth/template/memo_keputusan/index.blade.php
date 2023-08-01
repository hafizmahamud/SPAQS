@inject('model', '\App\Models\MemoEdarKeputusan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Memo Edar Keputusan'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Memo Edar Keputusan') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Rujukan')</label>
                <div class="col-md-10">
                    <input name="rujukan" id="rujukan" class="form-control" readonly value="{{ $data->rujukan }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Perkara')</label>
                <div class="col-md-10">
                    <input name="perkara" id="perkara" class="form-control" readonly value="{{ $data->perkara }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Kementerian')</label>
                <div class="col-md-10">
                    <input name="kementerian" id="kementerian" class="form-control" readonly value="{{ $data->kementerian }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Kementerian (singkatan)')</label>
                <div class="col-md-10">
                    <input name="kementerian1" id="kementerian1" class="form-control" readonly value="{{ $data->kementerian1 }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 1')</label>
                <div class="col-md-10">
                    <textarea name="text_1" id="text_1" class="form-control" readonly>{{ $data->text_1 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Panggilan Hormat')</label>
                <div class="col-md-10">
                    <textarea name="title" id="title" class="form-control" readonly>{{ $data->title }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 2 (jika ada)')</label>
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
            <button class="btn btn-success float-right" onclick="view({{ $data->id }})" type="submit" style="width: auto;">@lang('Kemaskini')</button>
            <button class="btn btn-info float-right" onclick="generate()" type="button" style="width: auto; margin-right:10px;">@lang('Muat Turun Template')</button>
        </x-slot>
    </x-backend.card>
    <script>
        function view(id) {
            window.location.href="memokeputusan/" + id + "/edit";
        }

        function panduan() {
            Swal.fire({
                width: 600,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/memo_keputusan.PNG',
                imageWidth: 600,
                imageHeight: 600,
                confirmButtonText: 'Kembali',
            })
        }

        function generate() {
            const result = Math.random().toString(36).substring(2,7);
            window.location.href="/admin/auth/memokeputusan/downloadmemokeputusan/" + result;
        }
      </script>
@endsection
