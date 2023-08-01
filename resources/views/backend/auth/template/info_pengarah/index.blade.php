@inject('model', '\App\Models\Tandatangan')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Maklumat Pengarah'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            <span style="font-weight: bold;"> @lang('Isi Kandungan Maklumat Pengarah') </span>
        </x-slot>
        <x-slot name="body">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Tandatangan Digital')</label>
                @if ($data->path_tandatangan != null)
                    <div class="col-md-10">
                        <img src="{{$tandatangan}}" style="width:20%; height:100%" id="tandatangan">
                    </div>
                @else
                    <div class="col-md-10">
                        <input type="text" name="tandatangan" value="TIADA" class="form-control" readonly>
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Nama')</label>
                <div class="col-md-10">
                    <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">@lang('Jawatan')</label>
                <div class="col-md-10">
                    <input type="text" name="jawatan" value="{{ $data->jawatan }}" class="form-control" readonly>
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
            window.location.href = "infopengarah/" + id + "/edit";
        }

        //for image jata negara
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#tandatangan').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#tandatangan").change(function(){
            readURL(this);
        });

        function panduan() {
            Swal.fire({
                width: 1000,
                imageUrl: window.location.origin + '/spaqs/assets/img/panduan/pengarah.PNG',
                imageWidth: 1000,
                imageHeight: 300,
                confirmButtonText: 'Kembali',
            })
        }

    </script>
@endsection
