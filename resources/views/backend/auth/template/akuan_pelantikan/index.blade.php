@inject('model', '\App\Models\Pelantikan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Surat Akuan Pelantikan Ahli Jawatankuasa Penilaian Tender'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Surat Akuan Pelantikan Ahli Jawatankuasa Penilaian Tender') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Tajuk')</label>
                <div class="col-md-10">
                    <textarea name="tajuk" id="tajuk" class="form-control" readonly>{{ $data->tajuk }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Pengenalan')</label>
                <div class="col-md-10">
                    <textarea name="text_1" id="text_1" class="form-control" readonly>{{ $data->text_1 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 1')</label>
                <div class="col-md-10">
                    <textarea name="text_2" id="text_2" class="form-control" readonly style="height: 70px;">{{ $data->text_2 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 2')</label>
                <div class="col-md-10">
                    <textarea name="text_3" id="text_3" class="form-control" readonly style="height: 50px;">{{ $data->text_3 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 3')</label>
                <div class="col-md-10">
                    <textarea name="text_4" id="text_4" class="form-control" readonly style="height: 100px;">{{ $data->text_4 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 4')</label>
                <div class="col-md-10">
                    <textarea name="text_5" id="text_5" class="form-control" readonly style="height: 60px;">{{ $data->text_5 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 5')</label>
                <div class="col-md-10">
                    <textarea name="text_6" id="text_6" class="form-control" readonly style="height: 80px;">{{ $data->text_6 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 6')</label>
                <div class="col-md-10">
                    <textarea name="text_7" id="text_7" class="form-control" readonly style="height: 80px;">{{ $data->text_7 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 7 (jika ada)')</label>
                <div class="col-md-10">
                    <textarea name="text_8" id="text_8" class="form-control" readonly style="height: 60px;">{{ $data->text_8 }}</textarea>
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
            window.location.href="akuanpelantikan/" + id + "/edit";
        }

        function panduan() {
            Swal.fire({
                width: 600,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/akuan_lantikan.PNG',
                imageWidth: 600,
                imageHeight: 650,
                confirmButtonText: 'Kembali',
            })
        }

        function generate() {
            const result = Math.random().toString(36).substring(2,7);
            window.location.href="/admin/auth/akuanpelantikan/downloadakuanlantikan/" + result;
        }
      </script>
@endsection
