<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="pagetitle">
    <h1>Permohonan Dibatalkan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif
</div><!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Jenis Iklan</label>
                        <div>
                            <input class="form-control" type="text" name="jenis_iklan" value="{{ $jenisiklan->nama }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label">Tahun Perolehan</label>
                        <div>
                            <input class="form-control" type="text" name="tahun" value="{{ $data->tahun_perolehan }}"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class=" form-label">Kategori Perolehan</label>
                        <div>
                            <input class="form-control" type="text" name="perolehan" value="{{ $perolehan->nama }}"
                                readonly>
                        </div>

                        <div style="padding-top: 15px;">
                            <label class="form-label">Jenis Perolehan</label><a id="style_jenis_tender"
                                style="color: red;">*</a>
                            <div>
                                @if ($tender != null)
                                <input class="form-control" type="text" name="tender" value="{{ $tender->nama }}"
                                    readonly>
                                @else
                                <input class="form-control" type="text" name="tender" value="TIADA" readonly>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="inputPassword" class=" form-label">Tajuk</label><a style="color: red;">*</a>
                        <div>
                            <textarea class="form-control" name="tajuk" id="tajuk" style="height: 120px"
                                value="{{ $data->tajuk_perolehan }}" readonly>{{ $data->tajuk_perolehan }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Dokumen Iklan</label><a id="style_muat_naik" style="color: red;"
                            hidden>*</a>
                        <div class="row mb-3" id="muatnaik">
                            <div class="col-lg-4">
                                <input for="upload" type="button" class="btn btn-outline-primary" value="Muat Naik"
                                    onclick="document.getElementById('upload').click();" style="width: 100%;" />
                                <input class="form-control" type="file" id="upload" name="file_upload"
                                    style="display:none;" accept=".pdf">
                                <input class="form-control" type="text" id="upload_file" name="upload_file"
                                    style="display:none;">
                            </div>
                            <div class="col-lg-8">
                                <div id="selectedFiles" name="selectedFiles" style="color: #0d6efd;"></div>
                            </div>
                        </div>
                        <div class="row mb-3" id="muatturun">
                            <div class="col-lg-12">
                                <a href='/{{ $data->dokumen_muatnaik }}'
                                    target="_blank">{{ $data->nama_dokumen }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="inputDate" class=" form-label">Tarikh Jangka Iklan</label><a
                            style="color: red;">*</a>
                        <div>
                            <input class="form-control" type="text" name="tarikh_iklan" id="tarikh_iklan" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Platform Iklan</label><a id="kategori_iklan" style="color: red;"></a>
                        <div>
                            @foreach($dataKategoriIklan as $key => $value)
                            <label><input disabled type="radio" name="kategori_iklan" value="{{ $value->id }}"  {{ $data->kategoriIklan['id'] == $value->id ? 'checked' : ''}}>&nbsp{{ $value->nama }}&nbsp&nbsp&nbsp</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                            <br>
                                <div style="width: 100%; overflow: hidden;">
                                    <div style="width: 20%; float: left;">
                                        <label class="form-label">Justifikasi Pembatalan</label>
                                    </div>
                                    <div style="width: 80%; float: right;">
                                        <textarea class="form-control" name="justifikasi" style="height: 70px"
                                        value="justifikasi" readonly>{{ $data->justifikasi_batal }}</textarea>
                                        <br>
                                        @if($data->dokumen_batal)
                                        <a href='/{{$data->dokumen_batal}}' target='_blank'> Dokumen Justifikasi Pembatalan </a>
                                        @endif
                                    </div>
                               </div>
                            </div>
                    </div>

                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="button-form">
        <button class="btn btn-outline-primary"  style="width: 10%; margin-right: 10px;" onclick="history.back()">Kembali</button>
    </div>

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
<link rel="stylesheet" href={{ Module::asset('sisdant:css/style.css') }}>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('.nav-list a').removeClass('active');
	}, false);

  $("document").ready(function(){
        var local = window.location.origin;
        var url = "/sisdant";
		$('.link[href="'+url+'"]').addClass('active');
	});
</script>
<script>
    //select current value
    var data = @json($data);
    var today = data.tarikh_jangka_iklan;
    var pieces = today.split('-');
    document.getElementById('tarikh_iklan').value = pieces[2]+"/"+pieces[1]+"/"+pieces[0];

    // condition for muat naik draf iklan
    if (data.dokumen_muatnaik == null || data.dokumen_muatnaik == '') {
        document.getElementById("muatturun").hidden = true;
        document.getElementById("muatnaik").hidden = false;
    } else {
        document.getElementById("muatturun").hidden = false;
        document.getElementById("muatnaik").hidden = true;
    }

</script>
<style>
    .form-label{
        font-weight: bold;
    }
    .container {
    margin-top: 3%;
    }

    .one {
    width: 15%;
    float: left;
    }

    .two {
    margin-left: 15%;
    }
</style>
@endsection
