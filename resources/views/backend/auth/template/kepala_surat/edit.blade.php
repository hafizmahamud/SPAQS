@inject('model', '\App\Models\HeaderSurat')
@extends('backend.layouts.app')

@section('title', __('Isi Kandungan Kepala Memo/Surat'))

@section('content')
    <x-forms.post :action="route('admin.auth.kepalasurat.update', $data)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                <span style="font-weight: bold;"> @lang('Isi Kandungan Kepala Memo/Surat') </span>
            </x-slot>
            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.kepalasurat.index')" :text="__('Kembali')" />
            </x-slot>
            <x-slot name="body">
                <div class="row mb-3">
                    <div class="col-lg-2">
                        <label class="form-label">@lang('Jata Negara')</label>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="tooltip-text" style="font-weight: bold; margin-right:-140px; margin-top:10px; z-index: 99; max-width: 150%; position: absolute;">
                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black; display: inline-block; cursor: pointer; text-align: left;">
                                i. Hanya fail .png sahaja <br>
                                ii. Saiz 2MB dan resolusi 293x231 </a><br>
                        </span>
                    </div>
                    <div class="col-lg-10">
                        <img src="{{$jata_negara}}" style="width:20%; height:80%" id="jata_negara_tag" >
                        <div class="btn-div" style="margin-top: 10px;">
                            <label>
                                <input type="file" class="file-submit" accept="image/png" class="form-control" name="jata_negara" id="jata_negara">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-2">
                        <label class="form-label">@lang('Gambar Memo')</label>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="tooltip-text" style="font-weight: bold; margin-right:-160px; margin-top:10px; z-index: 99; max-width: 150%;position: absolute;">
                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black; display: inline-block; cursor: pointer; text-align: left;">
                                i. Hanya fail .png sahaja <br>
                                ii. Saiz 2MB dan resolusi 293x231 </a><br>
                        </span>
                    </div>
                    <div class="col-lg-10">
                        <img src="{{$img_memo}}" style="width:20%; height:70%" id="img_memo_tag">
                        <div class="btn-div" style="margin-top: 10px;">
                            <label>
                                <input type="file" class="file-submit" accept="image/png" class="form-control" name="img_memo" id="img_memo">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Jabatan')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input type="text" name="jabatan" value="{{ $data->jabatan }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Kementerian')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input type="text" name="kementerian" value="{{ $data->kementerian }}" class="form-control"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Alamat')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input type="text" name="alamat" value="{{ $data->alamat }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Laman Web')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input type="text" name="laman_web" value="{{ $data->laman_web }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('No. Tel')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="no_tel" value="{{ $data->no_tel }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('No. Faks')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="no_fax" value="{{ $data->no_fax }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">@lang('Emel')<a style="color: red;"> *</a></label>
                    <div class="col-md-10">
                        <input name="email" value="{{ $data->email }}" class="form-control" required>
                    </div>
                </div>
                <input name="id" value="{{ $data->id }}" hidden>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-success float-right" type="submit">@lang('Simpan')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        //for image jata negara
        function readURL1(input) {
            if (input.files && input.files[0]) {

                var img = new Image();
                img.onload = function(e) {
                    // checking resolution
                    if ((this.width > '293') || (this.height > '231')) {
                        Swal.fire({
                            width: 600,
                            title: 'Format gambar tidak tepat.<br>',
                            text: 'Sila rujuk ikon info.'
                        });

                    } else {
                        // display image
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#jata_negara_tag').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                };

                //display popup
                var _URL = window.URL || window.webkitURL;
                img.src = _URL.createObjectURL(input.files[0]);
            }
        }
        $("#jata_negara").change(function(){
            readURL1(this);
        });

        $('.file-submit').on('change', function(){
            $(this).closest('.btn-div').find('.chosen')
                .text(this.value.replace(/C:\\fakepath\\/i, ''));
        })

        //for image memo
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var img = new Image();
                img.onload = function(e) {
                    // checking resolution
                    if ((this.width > '293') || (this.height > '231')) {
                        Swal.fire({
                            width: 600,
                            title: 'Resolusi gambar melebihi 293 x 231',
                            text: 'Sila rujuk ikon info.'
                        });

                    } else {
                        // display image
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#img_memo_tag').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                //display popup
                var _URL = window.URL || window.webkitURL;
                img.src = _URL.createObjectURL(input.files[0]);
            }
        }
        $("#img_memo").change(function(){
            readURL2(this);
        });

        $('.file-submit').on('change', function(){
            $(this).closest('.btn-div').find('.chosen')
                .text(this.value.replace(/C:\\fakepath\\/i, ''));
        })
    </script>
@endsection
