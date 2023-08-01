<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="pagetitle">
    <h1>Permohonan Nombor Perolehan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif
</div><!-- End Page Title -->
<div class="spanner">
    <div id="wait">
      <img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
    </div>
  </div>
<form id="myForm" autocomplete="off" method="post" action="{{ url('/sisdant/updatepermohonansah') }}" enctype="multipart/form-data"
    style="padding: 10px;">
    @csrf
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Jenis Iklan</label><a style="color: red;">*</a>
                        <div>
                            <input class="form-control" type="text" name="jenis_iklan" value="{{ $jenisiklan->nama }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Tahun Perolehan</label><a style="color: red;">*</a>
                        <div>
                            <input class="form-control" type="text" name="tahun" value="{{ $data->tahun_perolehan }}"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3" id='tajuk_per'>
                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Kategori Perolehan</label><a style="color: red;">*</a>
                        <div>
                            <input class="form-control" type="text" name="perolehan" value="{{ $perolehan->nama }}"
                                readonly>
                        </div>

                        <div style="padding-top: 15px;">
                            <label class="form-label" style="font-weight: bold;">Jenis Perolehan</label><a id="style_jenis_tender"
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
                        <label for="inputPassword" class=" form-label" style="font-weight: bold;">Tajuk</label><a style="color: red;">*</a>
                        <div>
                            <textarea class="form-control" name="tajuk" id="tajuk" style="height: 120px"
                                value="{{ $data->tajuk_perolehan }}" onkeyup="
                                var start = this.selectionStart;
                                var end = this.selectionEnd;
                                this.value = this.value.toUpperCase();
                                this.setSelectionRange(start, end);
                                success();">{{ $data->tajuk_perolehan }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Dokumen Iklan</label><a id="style_muat_naik" style="color: red;"
                            hidden>*</a>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="tooltip-text" style="font-weight: bold; margin-right:360px;">
                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                i. Hanya fail .pdf sahaja <br>
                                ii. Saiz tidak melebihi 10MB</a><br>
                        </span>
                        <div class="row mb-3" id="muatnaik">
                            <div class="col-lg-4">
                                <input for="upload" type="button" class="btn btn-outline-primary"
                                    value="Muat Naik" onclick="document.getElementById('upload').click();"
                                    style="width: 100%;" />
                                <input type="file" id="upload" name="upload" style="display:none;" onchange="handleFileSelect(event)"
                                    accept=".pdf">
                                <input type="text" name="file" id="file" style="display:none;">
                            </div>
                            <div class="col-lg-8">
                                <div id="selectedFiles" name="selectedFiles" style="color: #0d6efd;"></div>
                            </div>
                        </div>
                        <div class="row mb-3" id="muatturun">
                            <div class="col-lg-1" style="margin-left: 22px">
                                <i class="mdi mdi-minus-circle" style="color: red; font-size:22px;"
                                    onclick="deletelist({{ $data->id_perolehan }})"
                                    data-id="{{ $data->id_perolehan }}"></i>
                            </div>
                            <div class="col-lg-8" style="margin-top: 7px;">
                                <a href='/{{ $data->dokumen_muatnaik }}'
                                    target="_blank">{{ $data->nama_dokumen }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="inputDate" class=" form-label" style="font-weight: bold;">Tarikh Jangka Iklan</label><a
                            style="color: red;">*</a>
                        <div>
                            <input class="form-control" type="text" name="tarikh_iklan" id="tarikh_iklan"
                                value="{{ date('d/m/Y', strtotime($data->tarikh_jangka_iklan)) }}" readonly>
                        </div>
                    </div>
                </div>


            </div>


        </div>
        @if($data->kategori_iklan_id == 2)
        <div class="card" id="cidb">
            <div class="card-body">
                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Lembaga Pembangunan Industri Pembinaan Malaysia (CIDB)</h5>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Kategori Kelas <a style="color: red;">*</a></label>
                        <div>
                            <select style="width: 100%;" class="form-select" name="kelas0" id="kelas" onchange="success()">
                                <option value="">Sila Pilih</option>
                                @foreach ($kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->kod }} - {{ $kelas->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Kelas Pengkhususannn <a style="color: red;" disabled>*</a></label>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="tooltip-text" style="font-weight: bold; margin-right:360px;">
                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                Boleh pilih satu atau lebih</a><br>
                        </span>
                        <div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name="khusus0[]" id="khusus"
                                multiple="multiple" disabled hidden onchange="success()">
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <!-- <div class="col-lg-1">
                        <span style="font-size: 20%; color: Dodgerblue; margin-top: 50px; margin-left:30px;"
                            onclick="AddDropDownKhusus()">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div> -->
                </div>
                <div id="dvContainerKelas"></div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Gred</label><a style="color: red;">*</a>
                        <div>
                            <select class="form-select" name="gred" id="gred" onchange="success()">
                                <option value="">Sila Pilih</option>
                                @foreach ($grade as $gred)
                                <option value="{{ $gred->id }}">{{ $gred->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($data->kategori_iklan_id == 1)
        <div class="card" id="mof">
            <div class="card-body">
                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Kementerian Kewangan Malaysia (MOF)</h5>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label col-lg-6" style="font-weight: bold;">Kod Bidang <a style="color: red;">*</a></label>
                        <select class="form-select" name="bidang0" id="bidang" onchange="success()">
                            <option value="">Sila Pilih</option>
                            @foreach ($bidang as $bidang)
                            <option value="{{ $bidang->id }}">{{ $bidang->kod }} - {{ $bidang->bidang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label col-lg-6" style="font-weight: bold;">Sub Bidang <a style="color: red;" disabled>*</a></label>
                        <select style="width: 100%;" class="js-example-basic-multiple" name="subbidang0[]"
                            id="subbidang" multiple="multiple" disabled hidden onchange="success()">
                            <option value=''>Sila Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <!-- <div class="col-lg-1">
                        <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;"
                            onclick="AddDropDownList()">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div> -->
                </div>
                <div id="dvContainerMOF"></div>
            </div>
        </div>
        @endif
        @if($negeri == 'IP')
        <div class="card">
            <div class="card-body">
                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Syarat-syarat Perolehan yang lain</h5>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <input type="radio" name="syarat" id="pukonsa" value="pukonsa" style="margin-left: 30px" onchange="getSyarat(this)"/>
                        <label for="always">PUKONSA</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="radio" name="syarat" id="upkj" value="upkj" onchange="getSyarat(this)"/>
                        <label for="never">UPKJ</label>
                    </div>
                    <div class="col-lg-4">
                        <input type="radio" name="syarat" id="upkj" value="tiada" onchange="getSyarat(this)" checked="checked"/>
                        <label for="never">TIDAK BERKENAAN</label>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($negeri == 'IP' ||  $negeri == 'SBH' )
        <div class="card" id="divPukonsa" style="display:block">
            <div class="card-body">
                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Pusat Pendaftaran Kontraktor-Kontraktor Kerja, Bekalan, Perkhidmatan dan Juruperunding Negeri Sabah (PUKONSA)</h5>
                {{-- pukonsa start --}}
                <div class="row mb-3">
                    <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk PUKONSA<a id="pukonsa" style="color: red;">*</a></label>
                    <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk Kecil PUKONSA<a id="pukonsakecil" style="color: red;" disabled>*</a></label>
                </div>
                <div class="row mb-3">
                    <!-- <div class="col-lg-1">
                        <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;"
                            onclick="AddDropDownListPukonsa()">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div> -->
                    <div class="col-lg-6">
                        <div>
                            <select class="form-select" name="tajukpukonsa0" id="tajukpukonsa0" style="width:100%" onchange="success()">
                                <option value="">Sila Pilih</option>
                                @foreach ($kelaspukonsa as $kelaspukonsa)
                                <option value="{{ $kelaspukonsa->id }}">{{ $kelaspukonsa->tajuk }} - {{ $kelaspukonsa->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name="subtajuk0[]"
                                id="subtajuk0" multiple="multiple" disabled hidden onchange="success()">
                                <option value=''>Sila Pilih</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="dvContainerPukonsa"></div>
                {{-- pukonsa end --}}
            </div>
        </div>
        @endif
        @if($negeri == 'IP' ||  $negeri == 'SRK' )
        <div class="card" id="divUpkj" style="display:block">
            <div class="card-body">
                {{-- upkj start --}}
                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Unit Pendaftaran Kontraktor & Juruperunding (UPKJ)</h5>
                <div class="row mb-3">
                    <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk UPKJ<a id="upkj"style="color: red;">*</a></label>
                    <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk Kecil UPKJ<a id="upkjkecil" style="color: red;" disabled>*</a></label>
                </div>
                <div class="row mb-3">
                    <!-- <div class="col-lg-1">
                        <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;"
                            onclick="AddDropDownListUPKJ()">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div> -->
                    <div class="col-lg-6">
                        <div>
                            <select class="form-select" name="tajukupkj0" id="tajukupkj0" style="width:100%" onchange="success()">
                                <option value="">Sila Pilih</option>
                                @foreach ($kelasupkj as $kelasupkj)
                                <option value="{{ $kelasupkj->id }}">{{ $kelasupkj->tajuk }} - {{ $kelasupkj->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name="subtajukupkj0[]"
                                id="subtajukupkj0" multiple="multiple" required disabled hidden onchange="success()">
                                <option value=''>Sila Pilih</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="dvContainerUpkj"></div>
                {{-- upkj end --}}
            </div>
        </div>
        @endif
        <div class="card" id="section_tarikh">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="inputDate" class=" form-label" style="font-weight: bold;">Tarikh Jual Mulai Dari</label><a
                            style="color: red;">*</a>
                        <div>
                            <input type="date" name="tarikh_mula_jual" id="tarikh_mula_jual" onchange="datestart(event);" class="form-control" required>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="inputDate" class=" form-label" style="font-weight: bold;">Tarikh Akhir Jual</label><a style="color: red;">*</a>
                        <div>
                            <input type="date" name="tarikh_akhir_jual" id="tarikh_akhir_jual" onchange="enddate(event);" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label class=" form-label" style="font-weight: bold;">Cara Bayaran</label><a style="color: red;">*</a>
                        <select class="form-select" name="cara_bayar" id="cara_bayar" onchange="carabayar(event)" required>
                            <option value="">Sila Pilih</option>
                            @foreach ($cara_bayar as $cara)
                            <option value="{{ $cara->id }}">{{ $cara->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class=" form-label" style="font-weight: bold;">Harga Dokumen Tender (RM)</label><a style="color: red;">*</a>
                        <div class="form-group">
                            <div class="input-icon" style="width:100%;">
                                <input type="text" name="harga" id="harga" class="form-control" placeholder="0.00" required onkeyup="success()">
                                <i style="width: 50px;">RM </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="inputDate" class=" form-label" style="font-weight: bold;">Pejabat Pamer Dan Jual</label><a
                            style="color: red;">*</a>
                        <select class="form-select" name="pejabat_pamer" id="pejabat_pamer"onchange="success()" required>
                            <option value="">Sila Pilih</option>
                            @foreach ($senaraialamat as $alamat)
                            <option value="{{ $alamat->id }}">{{ $alamat->alamat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Bayar Kepada</label><a style="color: red;">*</a>
                        <select class="form-select" name="bayar_kepada" id="bayar_kepada" onchange="success()" required>
                            <option value="">Sila Pilih</option>
                            @foreach ($bayar_kepada as $ke)
                            <option value="{{ $ke->id }}">{{ $ke->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="inputDate" class=" form-label" style="font-weight: bold;">Taklimat Tender</label><a
                        style="color: red;">*</a>
                        <select class="form-select" name="taklimat_tender" id="taklimat_tender" onchange="success()" required>
                            <option value="">Sila Pilih</option>
                            <option value="WAJIB">WAJIB</option>
                            <option value="TIDAK_WAJIB">TIDAK WAJIB</option>
                            <option value="ONLINE">ATAS TALIAN (ONLINE)</option>
                        </select>

                        <label for="inputDate" class=" form-label" style="font-weight: bold; padding-top: 15px;">Lawatan Tapak</label><a
                        style="color: red;">*</a>
                        <select class="form-select" name="lawatan_tapak" id="lawatan_tapak" onchange="success()" required>
                            <option value="">Sila Pilih</option>
                            <option value="WAJIB">WAJIB</option>
                            <option value="TIDAK_WAJIB">TIDAK WAJIB</option>
                            <option value="ONLINE">ATAS TALIAN (ONLINE)</option>
                        </select>

                        <div style="padding-top: 15px;">
                            <label for="inputDate" class=" form-label" style="font-weight: bold;">Pejabat Lapor</label><a style="color: red;">*</a>
                            <select class="form-select" name="pejabat_lapor" id="pejabat_lapor" onchange="success()" required>
                                <option value="">Sila Pilih</option>
                                @foreach ($senaraialamat as $alamat)
                                <option value="{{ $alamat->id }}">{{ $alamat->alamat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label for="inputDate" class=" form-label" style="font-weight: bold;">Tarikh Taklimat Tender</label><a
                        style="color: red;">*</a>
                        <div>
                            <input type="date" name="tarikh_taklimat_tender" id="tarikh_taklimat_tender" class="form-control" onchange="success()" required>
                        </div>

                        <label for="inputDate" class=" form-label" style="font-weight: bold; padding-top: 15px;">Tarikh Lawatan Tapak</label><a
                            style="color: red;">*</a>
                        <div>
                            <input type="date" name="tarikh_lawatan" id="tarikh_lawatan" class="form-control" onchange="success()" required>
                        </div>

                        <div style="padding-top: 15px;">
                            <label class=" form-label" style="font-weight: bold;">Waktu Lapor</label><a style="color: red;">*</a>
                            <div>
                                <input type="time" name="waktu_lapor" id="waktu_lapor" class="form-control" onchange="success()" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Lokasi Tapak</label><a style="color: red;">*</a>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="tooltip-text" style="font-weight: bold; margin-right:360px;">
                            Isikan pautan url sekiranya ada. <br>
                        </span>
                        <div>
                            <textarea class="form-control" name="lokasi" id="lokasi" style="height: 183px" onkeyup="
                            var start = this.selectionStart;
                            var end = this.selectionEnd;
                            this.value = this.value.toUpperCase();
                            this.setSelectionRange(start, end);
                            success();" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-form">
            <button class="btn btn-primary" id="hantar" name="hantar" type="submit" value="hantar"
                onclick="simpanpermohonan()" style="width: 10%;">Hantar</button>
            <button class="btn btn-success" id="draf" name="simpan" type="submit" value="draf"
                onclick="drafpermohonan()" style="width: 10%;">Simpan</button>
            <button class="btn btn-outline-primary"  style="width: 10%; margin-right: 10px;" onclick="history.back()">Kembali</button>
            <input class="form-control" type="text" id="status" name="status" style="display:none;">
            <input class="form-control" type="text" name="id_perolehan" value="{{ $data->id_perolehan }}"
                style="display:none;">
            <input class="form-control" type="text" name="matrik_iklan_id" value="{{ $data->matrik_iklan_id }}"
                style="display:none;">
            <input class="form-control" type="text" name="kategori_iklan_id" value="{{ $data->kategori_iklan_id }}"
                style="display:none;">
            <input type="number" name="counterbidang" id="counterbidang" value="count" style="display:none;">
            <input type="number" name="counterkelas" id="counterkelas" value="countKelas" style="display:none;">
            <input type="number" name="counterPukonsa" id="counterPukonsa"  style="display:none;">
            <input type="number" name="counterUpkj" id="counterUpkj" style="display:none;">
        </div>
    </section>
</form>

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
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

    document.getElementById('hantar').disabled = true;
    document.getElementById('draf').disabled = true;


    let negeri = @json($negeri);
    let namaPerolehan = @json($nama_perolehan);
    //select current value
    var data = @json($data);

    if(negeri == 'IP') {
        document.getElementById('divPukonsa').style.display = 'none';
        document.getElementById('divUpkj').style.display = 'none';
    }

    if  (data.kategori_iklan_id == 1 && negeri == 'SBH') {

        document.getElementById('bidang').setAttribute('required', '');
        document.getElementById('subbidang').setAttribute('required', '');
        document.getElementById('tajukpukonsa0').setAttribute('required', '');
        document.getElementById('subtajuk0').setAttribute('required', '');

    } else if(data.kategori_iklan_id == 1 && negeri == 'SRK') {

        document.getElementById('bidang').setAttribute('required', '');
        document.getElementById('subbidang').setAttribute('required', '');
        document.getElementById('tajukupkj0').setAttribute('required', '');
        document.getElementById('subtajukupkj0').setAttribute('required', '');

    }  else if(data.kategori_iklan_id == 2 && negeri == 'SBH') {

        document.getElementById('kelas').setAttribute('required', '');
        document.getElementById('khusus').setAttribute('required', '');
        document.getElementById('gred').setAttribute('required', '');
        document.getElementById('tajukpukonsa0').setAttribute('required', '');
        document.getElementById('subtajuk0').setAttribute('required', '');

    }  else if(data.kategori_iklan_id == 2 && negeri == 'SRK') {

        document.getElementById('kelas').setAttribute('required', '');
        document.getElementById('khusus').setAttribute('required', '');
        document.getElementById('gred').setAttribute('required', '');
        document.getElementById('tajukupkj0').setAttribute('required', '');
        document.getElementById('subtajukupkj0').setAttribute('required', '');

    } else if (data.kategori_iklan_id == 2 && negeri == 'IP'){

        document.getElementById('kelas').setAttribute('required', '');
        document.getElementById('khusus').setAttribute('required', '');
        document.getElementById('gred').setAttribute('required', '');

    } else if (data.kategori_iklan_id == 1 && negeri == 'IP'){

        document.getElementById('bidang').setAttribute('required', '');
        document.getElementById('subbidang').setAttribute('required', '');
    }

    //hide loader
    $('#loader').hide();

    // condition for muat naik draf iklan
    if (data.dokumen_muatnaik == null || data.dokumen_muatnaik == '') {
        document.getElementById("muatturun").hidden = true;
        document.getElementById("muatnaik").hidden = false;
    } else {
        document.getElementById("muatturun").hidden = false;
        document.getElementById("muatnaik").hidden = true;
    }

    // delete uploaded file
    function deletelist(id) {

        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "deletefile/" + id,
            type: 'post',
            data: {
                "id": id,
                "_token": token,
            },
            success: function () {
                document.getElementById("muatturun").hidden = true;
                document.getElementById("muatnaik").hidden = false;
                document.getElementById("file").value = 'ada';
                success();

            }
        });
    }
    // end delete uploaded file

    // function init() {
    //     // document.querySelector('#upload').addEventListener('change', handleFileSelect, false);
    // }

    // start show file name
    var selDiv = "";
    // document.addEventListener("DOMContentLoaded", init, false);

    function handleFileSelect(e) {
        if (!e.target.files) return;
        selDiv = document.querySelector("#selectedFiles");
        selDiv.innerHTML = "";

        var saiz = e.target.files[0].size / 1024 / 1024;
        if (saiz > 10) {
            Swal.fire({
                title: "Fail yang dipilih melebihi 10MB. Sila pilih semula.",
                icon: 'info'
            });
            var fileIklan = document.getElementById("upload");
            var newInputfileIklan = document.createElement("input");
            newInputfileIklan.type = "file";
            newInputfileIklan.id = fileIklan.id;
            newInputfileIklan.name = fileIklan.name;
            newInputfileIklan.className = fileIklan.className;
            newInputfileIklan.accept = fileIklan.accept;
            newInputfileIklan.onchange = fileIklan.onchange;
            newInputfileIklan.style.cssText = fileIklan.style.cssText;
            fileIklan.parentNode.replaceChild(newInputfileIklan, fileIklan);
        } else {
            var ul = document.createElement('ul');
            var files = e.target.files;
            for (var i = 0; i < files.length; i++) {
                var count = i;
                var li = document.createElement('li');
                li.setAttribute('id', 'file' + i);
                var f = files[i];
                li.innerHTML = f.name;
                ul.appendChild(li);
            }
            document.getElementById('selectedFiles').appendChild(ul);
            success();
        }
    }
    // end file

    function getSyarat(el) {
        if(el.value == 'pukonsa') {

            document.getElementById('divPukonsa').style.display = 'block';
            document.getElementById('divUpkj').style.display = 'none';
            document.getElementById('tajukpukonsa0').setAttribute('required', '');
            document.getElementById('subtajuk0').setAttribute('required', '');
            document.getElementById('tajukupkj0').removeAttribute('required');
            document.getElementById('subtajukupkj0').removeAttribute('required');
            success();

        } else if(el.value == 'upkj') {

            document.getElementById('divUpkj').style.display = 'block';
            document.getElementById('divPukonsa').style.display = 'none';
            document.getElementById('tajukupkj0').setAttribute('required', '');
            document.getElementById('subtajukupkj0').setAttribute('required', '');
            document.getElementById('tajukpukonsa0').removeAttribute('required');
            document.getElementById('subtajuk0').removeAttribute('required');
            success();

        } else if (el.value == 'tiada') {

            document.getElementById('divUpkj').style.display = 'none';
            document.getElementById('divPukonsa').style.display = 'none';
            document.getElementById('tajukpukonsa0').removeAttribute('required');
            document.getElementById('subtajuk0').removeAttribute('required');
            document.getElementById('tajukupkj0').removeAttribute('required');
            document.getElementById('subtajukupkj0').removeAttribute('required');
            success();
        }
    }

    function success() {
            var inputs_text, index, cara_bayar, syarat, radios, selected, file_iklan, tajuk;
            var count = 0;

            if (document.getElementById('tajuk').value == ''){
                inputs_text = document.querySelectorAll('#tajuk_per textarea');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if(document.getElementById('file').value) {
                inputs_text = document.querySelectorAll('#muatnaik input');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( data.kategori_iklan_id == 2) {
                inputs_text = document.querySelectorAll('#cidb select');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( data.kategori_iklan_id == 1) {
                inputs_text = document.querySelectorAll('#mof select');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( negeri == 'IP') {
                radios = document.getElementsByName("syarat");
                selected = Array.from(radios).find(radio => radio.checked);
                syarat = selected.value;

                if (syarat == 'upkj') {
                    inputs_text = document.querySelectorAll('#divUpkj select');
                    for (index = 0; index < inputs_text.length; ++index) {
                        if(inputs_text[index].value == '') {
                            count++;
                        }
                    }
                }

                if (syarat == 'pukonsa') {
                    inputs_text = document.querySelectorAll('#divPukonsa select');
                    for (index = 0; index < inputs_text.length; ++index) {
                        if(inputs_text[index].value == '') {
                            count++;
                        }
                    }
                }

            } else if (negeri == 'SBH') {

                if (syarat == 'pukonsa') {
                    inputs_text = document.querySelectorAll('#divPukonsa select');
                    for (index = 0; index < inputs_text.length; ++index) {
                        if(inputs_text[index].value == '') {
                            count++;
                        }
                    }
                }

            } else if (negeri == 'SRK') {

                if (syarat == 'upkj') {
                    inputs_text = document.querySelectorAll('#divUpkj select');
                    for (index = 0; index < inputs_text.length; ++index) {
                        if(inputs_text[index].value == '') {
                            count++;
                        }
                    }
                }

            }

            if (data.kategori_iklan_id == 2) {
                cara_bayar = document.getElementById('cara_bayar').value;

                if(cara_bayar == 1) {
                    count = count - 2;
                }

                inputs_text = document.querySelectorAll('#section_tarikh input');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }

                inputs_text = document.querySelectorAll('#section_tarikh select');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }

                inputs_text = document.querySelectorAll('#section_tarikh textarea');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }

            }

            lawatan_tapak = document.getElementById('lawatan_tapak').value;
            if (lawatan_tapak == 'TIDAK_WAJIB') {
                count = count - 1;
                document.getElementById('tarikh_lawatan').disabled = true;
            } else {
                document.getElementById('tarikh_lawatan').disabled = false;
            }

            taklimat_tender = document.getElementById('taklimat_tender').value;
            if (taklimat_tender == 'TIDAK_WAJIB') {
                count = count - 1;
                document.getElementById('tarikh_taklimat_tender').disabled = true;
            } else {
                document.getElementById('tarikh_taklimat_tender').disabled = false;
            }


            if( count > 0 ){
                document.getElementById('hantar').disabled = true;
                document.getElementById('draf').disabled = true;
            } else {
                document.getElementById('hantar').disabled = false;
                document.getElementById('draf').disabled = false;
            }
    }

    $( "form" ).submit(function( event ) {

        event.preventDefault();

        if(document.activeElement.value == 'hantar'){
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Mengiklan ?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });

        } else if (document.activeElement.value == 'draf'){
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Simpan ?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    document.getElementById("status").value = 'draf';
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });
        }
    });

    // start add bidang
    count = 1;
    function AddDropDownList() {
        let tablebidang = @json($tablebidang);
        //Create a Bidang List
        var ddlBidang = document.createElement("SELECT");

        // create sub bidang list
        ddlBidang.onchange = function () {
            var id = $(this).val();
            var selected = this.parentNode.parentNode.id;
            $.ajax({
                url: 'subbidang/' + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                },
                complete: function () {
                    $("#wait").css("display", "none");
                    $("div.spanner").removeClass("show");
                },
                success: function (response) {

                    success();
                    var len = response[0].length;
                    var subbidang = "subbidang" + selected.toString();
                    document.getElementById(subbidang.toString()).disabled = false;
                    document.getElementById(subbidang.toString()).removeAttribute('hidden');
                    $('#' + subbidang).empty();
                    for (var i = 0; i < len; i++) {
                        var id = response[0][i].id;
                        var nama = response[0][i].sub_bidang;
                        var kod = response[0][i].kod;
                        $('#' + subbidang).append("<option value='" + id + "'>" + kod + " - " + nama +
                            "</option>");
                    }
                    if (!$('#' + subbidang).hasClass(
                            "select2-hidden-accessible")) {
                        $('#' + subbidang).select2();
                        $('#' + subbidang).val('').trigger(
                            'change');

                    } else {
                        $('#' + subbidang).val('').trigger('change');

                    }
                }
            });
        };
        ddlBidang.classList.add('form-select');
        ddlBidang.name = 'bidang' + count;
        ddlBidang.id = 'bidang' + count;
        ddlBidang.onchange = success();
        ddlBidang.style.cssText = 'margin-top:10px; margin-bottom:10px;';

        var option = document.createElement("OPTION");
        option.innerHTML = 'Sila Pilih';
        option.value = '';
        ddlBidang.options.add(option);
        //Add the Options to the BidangList.
        for (var i = 0; i < tablebidang.length; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = tablebidang[i].kod + ' - ' + tablebidang[i].bidang;
            option.value = tablebidang[i].id;
            ddlBidang.options.add(option);
        }

        // get source element.
        var dvContainer = document.getElementById("dvContainerMOF")

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = count;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';

        // create new column for dropdown Bidang. row 1 col 2
        var colBidang = document.createElement("DIV");
        colBidang.className = 'col-lg-5';
        colBidang.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: -45px;';

        // create new column for dropdown sub Bidang. row 1 col 3
        var colSub = document.createElement("DIV");
        var name = "subbidang" + count.toString() + "[]";
        var id = "subbidang" + count.toString();
        colSub.className = 'col-lg-5';
        colSub.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: 43px;';
        colSub.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" onchange="success()" disabled hidden>
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 25px;"></i>`;
        btnRemove.onclick = function () {
            dvContainer.removeChild(this.parentNode.parentNode);
        };

        // insert remove button into delete column.
        col_remove.appendChild(btnRemove);

        // insert dropdown list into dropdown bidang column
        colBidang.appendChild(ddlBidang);

        //Add all col into row.
        row.appendChild(col_remove);
        row.appendChild(colBidang);
        row.appendChild(colSub);

        // add row into source
        dvContainer.appendChild(row);

        // counter bidang + subbidang
        document.getElementById('counterbidang').value = count;

        $('#bidang'+count).select2();
        console.log('INI');
        count++;
    };
    // end add bidang

    //start add kelas
    countKelas = 1;
    function AddDropDownKhusus() {
        let tablekelas = @json($tablekelas);

        //Create a DropDown List Kelas
        var ddlKelas = document.createElement("SELECT");

        // create khusus list
        ddlKelas.onchange = function () {
            var id = $(this).val();
            var selected = this.parentNode.parentNode.id;
            $.ajax({
                url: 'pengkhususan/' + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                },
                complete: function () {
                    $("#wait").css("display", "none");
                    $("div.spanner").removeClass("show");
                },
                success: function (response) {
                    success();
                    var len = response[0].length;
                    var khusus = "khusus" + selected.toString();
                    document.getElementById(khusus.toString()).disabled = false;
                    document.getElementById(khusus.toString()).removeAttribute('hidden');
                    $('#' + khusus).empty();
                    for (var i = 0; i < len; i++) {
                        var id = response[0][i].id;
                        var pengkhususan = response[0][i].pengkhususan;
                        var kod = response[0][i].kod;
                        $('#' + khusus).append("<option value='" + id + "'>" + kod + " - " + pengkhususan +
                            "</option>");
                    }
                    if (!$('#' + khusus).hasClass("select2-hidden-accessible")) {
                        $('#' + khusus).select2();
                        $('#' + khusus).val('').trigger(
                            'change');

                    } else {
                        $('#' + khusus).val('').trigger('change');

                    }
                }
            });
        };
        ddlKelas.classList.add('form-select');
        ddlKelas.name = 'kelas' + countKelas;
        ddlKelas.id = 'kelas' + countKelas;
        ddlKelas.style.cssText = 'margin-top:10px; margin-bottom:10px;';

        var option = document.createElement("OPTION");
        option.innerHTML = 'Sila Pilih';
        option.value = '';
        ddlKelas.options.add(option);
        //Add the Options to the KelasList.
        for (var i = 0; i < tablekelas.length; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = tablekelas[i].kod + ' - ' + tablekelas[i].kelas;
            option.value = tablekelas[i].id;
            ddlKelas.options.add(option);
        }

        // get source element.
        var dvContainerKelas = document.getElementById("dvContainerKelas")

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = countKelas;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';

        // create new column for dropdown Kelas. row 1 col 2
        var colKelas = document.createElement("DIV");
        colKelas.className = 'col-lg-5';
        colKelas.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: -45px;';

        // create new column for dropdown Khusus. row 1 col 3
        var colKhusus = document.createElement("DIV");
        var name = "khusus" + countKelas.toString() + "[]";
        var id = "khusus" + countKelas.toString();
        colKhusus.className = 'col-lg-5';
        colKhusus.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: 43px;';
        colKhusus.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" onchange="success()" required disabled hidden>
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 25px;"></i>`;
        btnRemove.onclick = function () {
            dvContainerKelas.removeChild(this.parentNode.parentNode);
        };

        // insert remove button into delete column.
        col_remove.appendChild(btnRemove);

        // insert dropdown list into dropdown kelas column
        colKelas.appendChild(ddlKelas);

        //Add all col into row.
        row.appendChild(col_remove);
        row.appendChild(colKelas);
        row.appendChild(colKhusus);

        // add row into source
        dvContainerKelas.appendChild(row);

        // counter kelas + pengkhususan
        document.getElementById('counterkelas').value = countKelas;
        $('#kelas'+countKelas).select2();
        countKelas++;
    };
    //end add kelas

    //tarikh mula jual
    $('#tarikh_mula_jual').val('');
    var tarikh_iklan = document.getElementById('tarikh_iklan').value;
    document.getElementsByName("tarikh_mula_jual")[0].setAttribute('min', data.tarikh_jangka_iklan);

    //tarikh akhir jual
    $('#tarikh_akhir_jual').val('');

    //tarikh lawatan
    $('#tarikh_lawatan').val('');
    document.getElementsByName("tarikh_lawatan")[0].setAttribute('min', document.getElementById('tarikh_mula_jual').value);
    document.getElementsByName("tarikh_lawatan")[0].setAttribute('max', document.getElementById('tarikh_akhir_jual').value);

    //tarikh lawatan
    $('#tarikh_taklimat_tender').val('');
    document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('min', document.getElementById('tarikh_mula_jual').value);
    document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('max', document.getElementById('tarikh_akhir_jual').value);
    //onchange tarikh mula jual
    function datestart(e){
        var now1 = new Date(e.target.value);
        var now = new Date(now1.setDate(now1.getDate() + 13));
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today1 = now.getFullYear() + "-" + (month) + "-" + (day);
        $('#tarikh_akhir_jual').val(today1);
        document.getElementsByName("tarikh_akhir_jual")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_lawatan")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_lawatan")[0].setAttribute('max', today1);
        $('#tarikh_lawatan').val('');
        document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('max', today1);
        $('#tarikh_taklimat_tender').val('');
        success();
    }

    //onchange tarikh akhir jual
    function enddate(e){
        var now = new Date(e.target.value);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today1 = now.getFullYear() + "-" + (month) + "-" + (day);
        var tarikhmula = document.getElementById("tarikh_mula_jual").value;
        document.getElementsByName("tarikh_lawatan")[0].setAttribute('min', tarikhmula);
        document.getElementsByName("tarikh_lawatan")[0].setAttribute('max', today1);
        $('#tarikh_lawatan').val('');
        document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('max', today1);
        $('#tarikh_taklimat_tender').val('');
        success();
    }

    // onchange cara bayar
    function carabayar(e){
        if (e.target.value == '1'){
            document.getElementById('harga').readOnly = true;
            document.getElementById('bayar_kepada').disabled = true;
        } else{
            document.getElementById('harga').readOnly = false;
            document.getElementById('bayar_kepada').disabled = false;
        }
        success();
    }

    //harga dokumen tender
    $('#harga').mask('0, 000, 000, 000, 000, 000, 000.00', {
        reverse: true
    }); //quintillion

    function simpanpermohonan() {
        var check = document.getElementById('hantar').value;
        document.getElementById('status').value = check;
    }

    function drafpermohonan() {
        var check = document.getElementById('draf').value;
        document.getElementById('status').value = check;
    }
    $(document).ready(
        function () {
            //start check ePerolehan
            if (data.kategori_iklan_id == 1){
                $('#section_tarikh').hide();
                document.getElementById('cara_bayar').required = false;
                document.getElementById('tarikh_mula_jual').required = false;
                document.getElementById('tarikh_akhir_jual').required = false;
                document.getElementById('harga').required = false;
                document.getElementById('pejabat_pamer').required = false;
                document.getElementById('bayar_kepada').required = false;
                document.getElementById('lawatan_tapak').required = false;
                document.getElementById('taklimat_tender').required = false;
                document.getElementById('pejabat_lapor').required = false;
                document.getElementById('tarikh_lawatan').required = false;
                document.getElementById('tarikh_taklimat_tender').required = false;
                document.getElementById('lokasi').required = false;
                document.getElementById('waktu_lapor').required = false;
            }
            //end check ePerolehan

            $("head").append($(
                "<link rel='stylesheet' href='{{ Module::asset('sisdant:css/select2.css') }}' type='text/css' media='screen' />"
            ));
            $.getScript("{{ Module::asset('sisdant:js/1_11_1_jquery.min.js') }}", function () {
                $.getScript("{{ Module::asset('sisdant:js/select2.min.js') }}",
                    function () {
                        $('#gred').select2();

                        if (data.kategori_iklan_id == 1) {
                            if (!$('#bidang')[0].classList.contains('select2-hidden-accessible')) {
                                $("#bidang").select2().on('change', function (e) {
                                    var id = $(this).val();
                                    $.ajax({
                                        url: 'subbidang/' + id,
                                        type: 'get',
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $("#wait").css("display", "block");
                                            $("div.spanner").addClass("show");
                                        },
                                        complete: function () {
                                            $("#wait").css("display", "none");
                                            $("div.spanner").removeClass("show");
                                        },
                                        success: function (response) {
                                            var len = response[0].length;
                                            document.getElementById("subbidang")
                                                .disabled = false;
                                            document.getElementById('subbidang').removeAttribute('hidden');
                                            $("#subbidang").empty();
                                            for (var i = 0; i < len; i++) {
                                                var id = response[0][i].id;
                                                var nama = response[0][i].sub_bidang;
                                                var kod = response[0][i].kod;
                                                $("#subbidang").append(
                                                    "<option value='" + id + "'>" + kod + " - " +
                                                    nama +
                                                    "</option>");
                                            }
                                            if (!$('#subbidang').hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#subbidang').select2();
                                                $('#subbidang').val('').trigger(
                                                    'change');

                                            } else {
                                                $('#subbidang').val('').trigger('change');

                                            }
                                        }
                                    });
                                })
                            }
                        }
                        if (data.kategori_iklan_id == 2) {
                            if (!$('#kelas')[0].classList.contains('select2-hidden-accessible')) {
                                $("#kelas").select2().on('change', function (e) {
                                    var id = $(this).val();
                                    $.ajax({
                                        url: 'pengkhususan/' + id,
                                        type: 'get',
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $("#wait").css("display", "block");
                                            $("div.spanner").addClass("show");
                                        },
                                        complete: function () {
                                            $("#wait").css("display", "none");
                                            $("div.spanner").removeClass("show");
                                        },
                                        success: function (response) {
                                            var len = response[0].length;
                                            document.getElementById("khusus")
                                                .disabled = false;
                                            document.getElementById('khusus').removeAttribute('hidden');
                                            $("#khusus").empty();
                                            for (var i = 0; i < len; i++) {
                                                var id = response[0][i].id;
                                                var nama = response[0][i].pengkhususan;
                                                var kod = response[0][i].kod;
                                                $("#khusus").append(
                                                    "<option value='" + id + "'>" + kod + " - " +
                                                    nama +
                                                    "</option>");
                                            }
                                            if (!$('#khusus').hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#khusus').select2();
                                                $('#khusus').val('').trigger(
                                                    'change');

                                            } else {
                                                $('#khusus').val('').trigger('change');

                                            }
                                        }
                                    });
                                })
                            }
                        }

                        if (negeri == 'IP' || negeri == 'SBH') {

                            if (!$('#tajukpukonsa0')[0].classList.contains('select2-hidden-accessible')) {
                                $("#tajukpukonsa0").select2().on('change', function (e) {
                                    var id = $(this).val();
                                    $.ajax({
                                        url: 'subtajuk/' + id,
                                        type: 'get',
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $("#wait").css("display", "block");
                                            $("div.spanner").addClass("show");
                                        },
                                        complete: function () {
                                            $("#wait").css("display", "none");
                                            $("div.spanner").removeClass("show");
                                        },
                                        success: function (response) {
                                            var len = response[0].length;
                                            document.getElementById("subtajuk0")
                                                .disabled = false;
                                            document.getElementById('subtajuk0').removeAttribute('hidden');
                                            $("#subtajuk0").empty();
                                            for (var i = 0; i < len; i++) {
                                                var id = response[0][i].id;
                                                var tajuk_kecil = response[0][i].tajuk_kecil;
                                                var keterangan = response[0][i].keterangan;
                                                $("#subtajuk0").append(
                                                    "<option value='" + id + "'>" + tajuk_kecil + " - " +
                                                    keterangan +
                                                    "</option>");
                                            }
                                            if (!$('#subtajuk0').hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#subtajuk0').select2();
                                                $('#subtajuk0').val('').trigger(
                                                    'change');

                                            } else {
                                                $('#subtajuk0').val('').trigger('change');

                                            }
                                        }
                                    });
                                })
                            }
                        }
                        if (negeri == 'IP' || negeri == 'SRK') {
                            // upkj
                            if (!$('#tajukupkj0')[0].classList.contains('select2-hidden-accessible')) {
                                $("#tajukupkj0").select2().on('change', function (e) {
                                    var id = $(this).val();
                                    $.ajax({
                                        url: 'subtajukupkj/' + id,
                                        type: 'get',
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $("#wait").css("display", "block");
                                            $("div.spanner").addClass("show");
                                        },
                                        complete: function () {
                                            $("#wait").css("display", "none");
                                            $("div.spanner").removeClass("show");
                                        },
                                        success: function (response) {
                                            var len = response[0].length;
                                            document.getElementById("subtajukupkj0").disabled = false;
                                            document.getElementById('subtajukupkj0').removeAttribute('hidden');
                                            $("#subtajukupkj0").empty();
                                            for (var i = 0; i < len; i++) {
                                                var id = response[0][i].id;
                                                var tajuk_kecil = response[0][i].tajuk_kecil;
                                                var keterangan = response[0][i].keterangan;
                                                $("#subtajukupkj0").append(
                                                    "<option value='" + id + "'>" + tajuk_kecil + " - " +
                                                    keterangan +
                                                    "</option>");
                                            }
                                            if (!$('#subtajukupkj0').hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#subtajukupkj0').select2();
                                                $('#subtajukupkj0').val('').trigger(
                                                    'change');

                                            } else {
                                                $('#subtajukupkj0').val('').trigger('change');

                                            }
                                        }
                                    });
                                })
                            }
                        }
                    })
            })
        }
    );

    //pukonsa
    countPukonsa = 1;
    function AddDropDownListPukonsa() {
        let tablebidang = @json($tablepukonsa);
        //Create a Bidang List
        var ddlBidang = document.createElement("SELECT");

        // create sub bidang list
        ddlBidang.onchange = function () {
            var id = $(this).val();
            var selected = this.parentNode.parentNode.id;
            $.ajax({
                url: 'subtajuk/' + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                },
                complete: function () {
                    $("#wait").css("display", "none");
                    $("div.spanner").removeClass("show");
                },
                success: function (response) {
                    success();
                    var len = response[0].length;
                    var subbidang = "subtajuk" + selected.toString();
                    document.getElementById(subbidang.toString()).disabled = false;
                    document.getElementById(subbidang.toString()).removeAttribute('hidden');
                    $('#' + subbidang).empty();
                    for (var i = 0; i < len; i++) {
                        var id = response[0][i].id;
                        var tajuk_kecil = response[0][i].tajuk_kecil;
                        var keterangan = response[0][i].keterangan;
                        $('#' + subbidang).append("<option value='" + id + "'>" + tajuk_kecil + " - " + keterangan +
                            "</option>");
                    }
                    if (!$('#' + subbidang).hasClass(
                            "select2-hidden-accessible")) {
                        $('#' + subbidang).select2();
                        $('#' + subbidang).val('').trigger(
                            'change');

                    } else {
                        $('#' + subbidang).val('').trigger('change');

                    }
                }
            });
        };

        ddlBidang.classList.add('form-select');
        ddlBidang.name = 'tajukpukonsa' + countPukonsa;
        ddlBidang.id = 'tajukpukonsa' + countPukonsa;
        ddlBidang.style.cssText = 'margin-top:10px; margin-bottom:10px;';

        var option = document.createElement("OPTION");
        option.innerHTML = 'Sila Pilih';
        option.value = '';
        ddlBidang.options.add(option);
        //Add the Options to the BidangList.
        for (var i = 0; i < tablebidang.length; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = tablebidang[i].tajuk + ' - ' + tablebidang[i].keterangan;
            option.value = tablebidang[i].id;
            ddlBidang.options.add(option);
        }

        // get source element.
        var dvContainer = document.getElementById("dvContainerPukonsa")

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = countPukonsa;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';

        // create new column for dropdown Bidang. row 1 col 2
        var colBidang = document.createElement("DIV");
        colBidang.className = 'col-lg-5';
        colBidang.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: -45px;';

        // create new column for dropdown sub Bidang. row 1 col 3
        var colSub = document.createElement("DIV");
        var name = "subtajuk" + countPukonsa.toString() + "[]";
        var id = "subtajuk" + countPukonsa.toString();
        colSub.className = 'col-lg-5';
        colSub.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: 43px;';
        colSub.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" required disabled hidden onchange="success()">
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 25px;"></i>`;
        btnRemove.onclick = function () {
            dvContainer.removeChild(this.parentNode.parentNode);
        };

        // insert remove button into delete column.
        col_remove.appendChild(btnRemove);

        // insert dropdown list into dropdown bidang column
        colBidang.appendChild(ddlBidang);

        //Add all col into row.
        row.appendChild(col_remove);
        row.appendChild(colBidang);
        row.appendChild(colSub);

        // add row into source
        dvContainer.appendChild(row);

        // counter bidang + subbidang
        document.getElementById('counterPukonsa').value = countPukonsa;

        $('#tajukpukonsa'+countPukonsa).select2()
        countPukonsa++;
    };
    // end add bidang

    //upkj
    countUpkj = 1;
    function AddDropDownListUPKJ() {
        let tablebidang = @json($tableupkj);
        //Create a Bidang List
        var ddlBidang = document.createElement("SELECT");

        // create sub bidang list
        ddlBidang.onchange = function () {
            var id = $(this).val();
            var selected = this.parentNode.parentNode.id;
            $.ajax({
                url: 'subtajukupkj/' + id,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                },
                complete: function () {
                    $("#wait").css("display", "none");
                    $("div.spanner").removeClass("show");
                },
                success: function (response) {
                    success();
                    var len = response[0].length;
                    var subbidang = "subtajukupkj" + selected.toString();
                    document.getElementById(subbidang.toString()).disabled = false;
                    document.getElementById(subbidang.toString()).removeAttribute('hidden');
                    $('#' + subbidang).empty();
                    for (var i = 0; i < len; i++) {
                        var id = response[0][i].id;
                        var tajuk_kecil = response[0][i].tajuk_kecil;
                        var keterangan = response[0][i].keterangan;
                        $('#' + subbidang).append("<option value='" + id + "'>" + tajuk_kecil + " - " + keterangan +
                            "</option>");
                    }
                    if (!$('#' + subbidang).hasClass(
                            "select2-hidden-accessible")) {
                        $('#' + subbidang).select2();
                        $('#' + subbidang).val('').trigger(
                            'change');

                    } else {
                        $('#' + subbidang).val('').trigger('change');

                    }
                }
            });
        };

        ddlBidang.classList.add('form-select');
        ddlBidang.name = 'tajukupkj' + countUpkj;
        ddlBidang.id = 'tajukupkj' + countUpkj;
        ddlBidang.style.cssText = 'margin-top:10px; margin-bottom:10px;';

        var option = document.createElement("OPTION");
        option.innerHTML = 'Sila Pilih';
        option.value = '';
        ddlBidang.options.add(option);
        //Add the Options to the BidangList.
        for (var i = 0; i < tablebidang.length; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = tablebidang[i].tajuk + ' - ' + tablebidang[i].keterangan;
            option.value = tablebidang[i].id;
            ddlBidang.options.add(option);
        }

        // get source element.
        var dvContainer = document.getElementById("dvContainerUpkj")

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = countUpkj;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';

        // create new column for dropdown Bidang. row 1 col 2
        var colBidang = document.createElement("DIV");
        colBidang.className = 'col-lg-5';
        colBidang.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: -45px;';

        // create new column for dropdown sub Bidang. row 1 col 3
        var colSub = document.createElement("DIV");
        var name = "subtajukupkj" + countUpkj.toString() + "[]";
        var id = "subtajukupkj" + countUpkj.toString();
        colSub.className = 'col-lg-5';
        colSub.style.cssText = 'margin-top: 10px; margin-bottom:10px; margin-left: 43px;';
        colSub.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" required disabled hidden onchange="success()">
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 25px;"></i>`;
        btnRemove.onclick = function () {
            dvContainer.removeChild(this.parentNode.parentNode);
        };

        // insert remove button into delete column.
        col_remove.appendChild(btnRemove);

        // insert dropdown list into dropdown bidang column
        colBidang.appendChild(ddlBidang);

        //Add all col into row.
        row.appendChild(col_remove);
        row.appendChild(colBidang);
        row.appendChild(colSub);

        // add row into source
        dvContainer.appendChild(row);

        // counter bidang + subbidang
        document.getElementById('counterUpkj').value = countUpkj;

        $('#tajukupkj'+countUpkj).select2()
        countUpkj++;
    };
    // end add bidang

</script>
@endsection
