@inject('model', '\App\Models\HeaderSurat')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Kepala Memo/Surat'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Kepala Memo/Surat') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Jata Negara')</label>
                @if ($data->path_jata_negara != null)
                    <div class="col-md-10">
                        <img src="{{$jata_negara}}" style="width:20%; height:100%" id="jata_negara">
                    </div>
                @else
                    <div class="col-md-10">
                        <input type="text" name="jabatan" value="TIADA" class="form-control" readonly>
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Gambar Memo')</label>
                @if ($data->path_img_memo != null)
                    <div class="col-md-10">
                        <img src="{{$img_memo}}" style="width:20%; height:100%" id="img_memo">
                    </div>
                @else
                    <div class="col-md-10">
                        <input type="text" name="jabatan" value="TIADA" class="form-control" readonly>
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Jabatan')</label>
                <div class="col-md-10">
                    <input type="text" name="jabatan" value="{{ $data->jabatan }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Kementerian')</label>
                <div class="col-md-10">
                    <input type="text" name="kementerian" value="{{ $data->kementerian }}" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Alamat')</label>
                <div class="col-md-10">
                    <input type="text" name="alamat" value="{{ $data->alamat }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Laman Web')</label>
                <div class="col-md-10">
                    <input type="text" name="laman_web" value="{{ $data->laman_web }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('No. Tel')</label>
                <div class="col-md-10">
                    <input name="no_tel" value="{{ $data->no_tel }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('No. Faks')</label>
                <div class="col-md-10">
                    <input name="no_fax" value="{{ $data->no_fax }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Emel')</label>
                <div class="col-md-10">
                    <input name="email" value="{{ $data->email }}" class="form-control" readonly>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <label class="btn float-left" onclick="panduan()" style="color: blue;">Panduan</label>
            <button class="btn btn-success float-right" onclick="view({{ $data->id }})" type="submit"
                style="width: auto;">@lang('Kemaskini')</button>
        </x-slot>
    </x-backend.card>
    <script>
        function view(id) {
            window.location.href = "kepalasurat/" + id + "/edit";
        }

        //for image jata negara
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#jata_negara').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#jata_negara").change(function(){
            readURL(this);
        });

        //for image memo
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_memo').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#img_memo").change(function(){
            readURL(this);
        });

        function panduan() {
            Swal.fire({
                width: 1000,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/kepala.PNG',
                imageWidth: 900,
                imageHeight: 300,
                confirmButtonText: 'Kembali',
            })
        }
    </script>
@endsection
