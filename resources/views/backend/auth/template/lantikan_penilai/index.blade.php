@inject('model', '\App\Models\LantikanPenilai')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Memo Lantikan Penilai'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Memo Lantikan Penilai') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 1')</label>
                <div class="col-md-10">
                    <textarea name="text_1" id="text_1" class="form-control" readonly style="height: 70px;">{{ $data->text_1 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 2')</label>
                <div class="col-md-10">
                    <textarea name="text_2" id="text_2" class="form-control" readonly style="height: 70px;">{{ $data->text_2 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 2.1')</label>
                <div class="col-md-10">
                    <textarea name="text_3" id="text_3" class="form-control" readonly style="height: 40px;">{{ $data->text_3 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Isi 3 (jika ada)')</label>
                <div class="col-md-10">
                    <textarea name="text_4" id="text_4" class="form-control" readonly style="height: 40px;">{{ $data->text_4 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Moto')</label>
                <div class="col-md-10">
                    <textarea name="moto_1" id="moto_1" class="form-control" readonly style="height: 70px;">{{ $data->moto_1 }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Frasa Akhir')</label>
                <div class="col-md-10">
                    <textarea name="sym" id="sym" class="form-control" readonly>{{ $data->sym }}</textarea>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <label class="btn float-left" onclick="panduan()" style="color: blue;">Panduan</label>
            <button class="btn btn-success float-right" onclick="view({{ $data->id }})" type="button" style="width: auto;">@lang('Kemaskini')</button>
            <button class="btn btn-info float-right" onclick="generate()" type="button" style="width: auto; margin-right:10px;">@lang('Muat Turun Template')</button>

        </x-slot>
    </x-backend.card>
    <script>
        function view(id) {
            window.location.href="lantikanpenilai/" + id + "/edit";
        }

        function generate() {
            const result = Math.random().toString(36).substring(2,7);
            window.location.href="/admin/auth/lantikanpenilai/downloadmemolantikan/" + result;
        }

        function panduan() {
            Swal.fire({
                width: 600,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/lantikan.PNG',
                imageWidth: 600,
                imageHeight: 600,
                confirmButtonText: 'Kembali',
            })
        }
      </script>
@endsection
