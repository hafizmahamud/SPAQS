@inject('model', '\App\Models\HeaderSurat')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Maklumat Pengarah'))

@section('content')
    <x-forms.post :action="route('admin.auth.infopengarah.update', $data)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Maklumat Pengarah') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.infopengarah.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="row mb-3"  style="padding-bottom: 80px;">
                    <div class="col-lg-2">
                        <label class="form-label">@lang('Tandatangan Digital')</label>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="tooltip-text" style="font-weight: bold; margin-right:-180px; margin-top:10px; z-index: 99; max-width: 150%; position: absolute;">
                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black; display: inline-block; cursor: pointer; text-align: left;">
                                i. Hanya fail .png sahaja <br>
                                ii. Saiz 2MB dan resolusi 800 x 312 </a><br>
                        </span>
                    </div>
                    <div class="col-lg-10">
                        @if ($data->path_tandatangan != null)
                        <img src="{{$tandatangan}}" style="width:30%; height:120%" id="tandatangan_tag" >
                        <div class="btn-div" style="margin-top: 10px;">
                            <label>
                                <input type="file" class="file-submit" accept="image/png" class="form-control" name="tandatangan" id="tandatangan">
                            </label>
                        </div>
                        @else
                        <div class="col-md-10">
                            <img src="{{$tandatangan}}" style="width:30%; height:120%;" id="tandatangan_tag">
                            <div class="btn-div" style="margin-top: 10px;">
                                <label>
                                    <input type="file" class="file-submit" accept="image/png" class="form-control" name="tandatangan" id="tandatangan">
                                </label>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Nama')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Jawatan')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input type="text" name="jawatan" value="{{ $data->jawatan }}" class="form-control" required>
                    </div>
                </div>
                <input name="id" value="{{ $data->id }}" hidden>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
    <script>
        //for image tandatangan
        function readURL1(input) {
            if (input.files && input.files[0]) {

                var img = new Image();
                img.onload = function(e) {
                    // checking resolution
                    if ((this.width > '800') || (this.height > '312')) {
                        Swal.fire({
                            width: 600,
                            title: 'Resolusi gambar melebihi 800 x 312',
                            text: 'Sila rujuk ikon info.'
                        });
                    } else {
                        // display image
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#tandatangan_tag').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                };
                //display popup
                var _URL = window.URL || window.webkitURL;
                img.src = _URL.createObjectURL(input.files[0]);
            }
        }
        $("#tandatangan").change(function(){
            readURL1(this);
        });

        $('.file-submit').on('change', function(){
            $(this).closest('.btn-div').find('.chosen')
                .text(this.value.replace(/C:\\fakepath\\/i, ''));
        })

    </script>
@endsection
