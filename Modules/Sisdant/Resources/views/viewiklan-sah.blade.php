<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')
<style>
    .spanner.show {
      position: fixed!important;
    }
</style>
<div class="pagetitle">
    <h1>Permohonan Nombor Perolehan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
<div class="spanner">
    <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
    </div>
</div>

<form id="myForm" autocomplete="off" method="post" action="{{ url('/sisdant/saveiklan') }}" enctype="multipart/form-data"
    style="padding: 10px;">
    @csrf
    <section class="section">
        <div class="tab-content pt-2" id="myTabjustifiedContent">
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                {{-- first begin --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Jenis Iklan</label>
                                <div>
                                    <select class="form-select" name="jenis_iklan" id="jenis_iklan" disabled>
                                        <option value="{{ $mohon->matrikiklan['jenis_iklan_id'] }}">
                                            {{ $mohon->matrikiklan['jenisiklan']['nama'] }}</option>
                                        @foreach ($jenis as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Tahun Perolehan</label><a style="color: red;">*</a>
                                <div>
                                    <input class="form-control" type="text" name="tahun" value="{{ $mohon->tahun_perolehan }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Kategori Perolehan</label><a style="color: red;">*</a>
                                <div>
                                    <select class="form-select" name="kategoriperolehan" id="kategoriperolehan" disabled>
                                        <option value="{{ $mohon->matrikiklan['kategori_perolehan_id'] }}">
                                            {{ $mohon->matrikiklan['kategoriperolehan']['nama'] }}</option>
                                        @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div style="padding-top: 15px;">
                                    <label class="form-label" style="font-weight: bold;">Jenis Perolehan</label><a id="style_jenis_tender"
                                        style="color: red;">*</a>
                                        <div>
                                            <select class="form-select" name="tender" id="tender" disabled>
                                                @if($mohon->matrikiklan['jenis_tender_id'])
                                                <option value="{{ $mohon->matrikiklan['jenis_tender_id'] }}">
                                                    {{ $mohon->matrikiklan['jenistender']['nama'] }}</option>
                                                @endif
                                                @foreach ($tender as $tender)
                                                <option value="{{ $tender->id }}">{{ $tender->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="inputPassword" class=" form-label" style="font-weight: bold;">Tajuk</label><a style="color: red;">*</a>
                                <div>
                                    <textarea class="form-control" name="tajuk" id="tajuk" style="height: 120px"
                                        value="{{ $mohon->tajuk_perolehan  }}" onkeyup="
                                        var start = this.selectionStart;
                                        var end = this.selectionEnd;
                                        this.value = this.value.toUpperCase();
                                        this.setSelectionRange(start, end);" readonly>{{ $mohon->tajuk_perolehan  }}</textarea>
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
                                <div class="row mb-3" id="muatturun">
                                    <div class="col-lg-8">
                                        <a href='/{{ $mohon->dokumen_muatnaik }}'
                                            target="_blank">{{ $mohon->nama_dokumen }}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="inputDate" class=" form-label" style="font-weight: bold;">Tarikh Jangka Iklan</label><a
                                    style="color: red;">*</a>
                                <div>
                                    <input class="form-control" type="text" name="tarikh_iklan" id="tarikh_iklan"
                                        value="{{ date('d/m/Y', strtotime($mohon->tarikh_jangka_iklan)) }}" readonly>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                {{-- first  --}}
                {{-- second --}}
                @if(!$kelas_data->isEmpty())
                <div class="card">
                    <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Lembaga Pembangunan Industri Pembinaan Malaysia (CIDB)</h5>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Kategori Kelas <a style="color: red;"> *</a></label>
                            {{-- <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;" onclick="AddDropDownList()">
                                <i class="fas fa-plus"></i>
                            </span> --}}
                            <div id="kategori_kelas"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Kelas Pengkhususan <a style="color: red;">*</a></label>
                            <div id="kelas_pengkhususan"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div id="dvContainerKelas">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class=" form-label" style="font-weight: bold;">Gred</label><a style="color: red;">*</a>
                            <select class="form-select" name="gred" id="gred" disabled>
                                <option value="">Sila Pilih</option>
                                @foreach ($grade as $gred)
                                <option value="{{ $gred->id }}">{{ $gred->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                @if(!$bidang_data->isEmpty())
                    <div class="card">
                        <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Kementerian Kewangan Malaysia (MOF)</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Kod Bidang <a style="color: red;"> *</a></label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Sub bidang <a style="color: red;">*</a></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div id="dvContainerBidang">
                            </div>
                        </div>
                    </div>
                @endif

                @if(!$pukonsa_data->isEmpty())
                <div class="card" id="divPukonsaData" style="display:block">
                    <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Pusat Pendaftaran Kontraktor-Kontraktor Kerja, Bekalan, Perkhidmatan dan Juruperunding Negeri Sabah (PUKONSA)</h5>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tajuk PUKONSA <a id="pukonsa"  style="color: red;">*</a></label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tajuk Kecil PUKONSA <a id="pukonsakecil" style="color: red;">*</a></label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div id="dvContainerPukonsa">
                        </div>
                    </div>
                </div>
                @endif

                @if($pukonsa_data->isEmpty() && $negeri_singkatan == 'IP')
                <div class="card" id="divPukonsa" style="display:none">
                    <div class="card-body">
                        <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Pusat Pendaftaran Kontraktor-Kontraktor Kerja, Bekalan, Perkhidmatan dan Juruperunding Negeri Sabah (PUKONSA)</h5>
                        {{-- pukonsa start --}}
                        <div class="row mb-3">
                            <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk PUKONSA <a id="upkj"style="color: red;">*</a></label>
                            <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk Kecil PUKONSA <a id="upkj"style="color: red;">*</a></label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-1">
                            </div>
                            <div class="col-lg-5" style="margin-left: -45px">
                                <div>
                                    <select class="form-select" name="tajukpukonsa0" id="tajukpukonsa0" style="width:100%">
                                        <option value="">Sila Pilih</option>
                                        @foreach ($kelaspukonsa as $kelaspukonsa)
                                        <option value="{{ $kelaspukonsa->id }}">{{ $kelaspukonsa->tajuk }} - {{ $kelaspukonsa->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5" style="margin-left: 42px">
                                <div>
                                    <select style="width: 100%;" class="js-example-basic-multiple" name="subtajukpukonsa0[]"
                                        id="subtajukpukonsa0" multiple="multiple" disabled hidden>
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

                @if(!$upkj_data->isEmpty())
                <div class="card" id="divUpkjData" style="display:block">
                    <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Unit Pendaftaran Kontraktor & Juruperunding (UPKJ)</h5>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tajuk UPKJ <a id="upkj"style="color: red;">*</a></label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tajuk Kecil UPKJ <a id="upkjkecil" style="color: red;" disabled>*</a></label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div id="dvContainerUpkj">
                        </div>
                    </div>
                </div>
                @endif

                @if($upkj_data->isEmpty() && $negeri_singkatan == 'IP')
                <div class="card" id="divUpkj" style="display:none">
                    <div class="card-body">
                        {{-- upkj start --}}
                        <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Unit Pendaftaran Kontraktor & Juruperunding (UPKJ)</h5>
                        <div class="row mb-3">
                            <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk UPKJ <a id="upkj"style="color: red;">*</a></label>
                            <label class="form-label col-lg-6" style="font-weight: bold;">Tajuk Kecil UPKJ <a id="upkj"style="color: red;">*</a></label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-1">
                            </div>
                            <div class="col-lg-5" style="margin-left: -45px">
                                <div>
                                    <select class="form-select" name="tajukupkj0" id="tajukupkj0" style="width:100%">
                                        <option value="">Sila Pilih</option>
                                        @foreach ($kelasupkj as $kelasupkj)
                                        <option value="{{ $kelasupkj->id }}">{{ $kelasupkj->tajuk }} - {{ $kelasupkj->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5" style="margin-left: 42px">
                                <div>
                                    <select style="width: 100%;" class="js-example-basic-multiple" name="subtajukupkj0[]"
                                        id="subtajukupkj0" multiple="multiple" required disabled hidden>
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
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Tarikh Jual Mulai Dari<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_mula_jual" id="tarikh_mula_jual"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="inputDate" class="form-label" style="font-weight: bold;">Tarikh Akhir Jual<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_akhir_jual" id="tarikh_akhir_jual" class="form-control"  readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Cara Bayaran<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="cara_bayar" id="cara_bayar" disabled>
                                    <option value="{{ $data->cara_bayaran_id }}">{{ $data->carabayar['nama'] }}
                                    </option>
                                    @foreach ($carabayar as $carabayar)
                                    <option value="{{ $carabayar->id }}">{{ $carabayar->nama }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Harga Dokumen Tender<a style="color: red;">*</a></label>
                            <div class="form-group">
                                <div class="input-icon" style="width:100%;">
                                    <input type="text" name="harga_dokumen" id="harga_dokumen"
                                        class="form-control" value="{{ $data->harga_dokumen }}"
                                        style="padding-left:50px;" readonly>
                                    <i style="width: 50px;"> RM </i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Pejabat Pamer Dan Jual<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="pejabat_pamer" id="pejabat_pamer" disabled>
                                    @if ($mohon->kategori_iklan_id != 1)
                                    <option value="{{ $data->pejabat_pamer_jual }}">
                                        {{ $data->pejabatpamer['alamat'] }}</option>
                                    @endif
                                    @foreach ($senaraialamat as $senaraialamat)
                                    <option value="{{ $senaraialamat->id }}">{{ $senaraialamat->alamat }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Bayar Kepada<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="bayar_kepada" id="bayar_kepada" disabled>
                                    <option value="{{ $data->bayar_kepada_id }}">{{ $data->bayarkepada['nama'] }}
                                    </option>
                                    @foreach ($bayarkepada as $bayarkepada)
                                    <option value="{{ $bayarkepada->id }}">{{ $bayarkepada->nama }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Taklimat Tender<a style="color: red;padding-top: 15px;">*</a></label>
                            <div>
                                <select class="form-select" name="taklimat_tender" id="taklimat_tender" disabled>
                                    <option value="WAJIB" {{ $data->taklimat_tender == "WAJIB"  ? 'selected' : '' }}>WAJIB</option>
                                    <option value="TIDAK_WAJIB" {{ $data->taklimat_tender == "TIDAK_WAJIB"  ? 'selected' : '' }}>TIDAK WAJIB</option>
                                    <option value="ONLINE" {{ $data->taklimat_tender == "ONLINE"  ? 'selected' : '' }}>ATAS TALIAN (ONLINE)</option>
                                </select>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Lawatan Tapak<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="lawatan_tapak" id="lawatan_tapak" disabled>
                                    <option value="WAJIB" {{ $data->lawatan_tapak == "WAJIB"  ? 'selected' : '' }}>WAJIB</option>
                                    <option value="TIDAK_WAJIB" {{ $data->lawatan_tapak == "TIDAK_WAJIB"  ? 'selected' : '' }}>TIDAK WAJIB</option>
                                    <option value="ONLINE" {{ $data->lawatan_tapak == "ONLINE"  ? 'selected' : '' }}>ATAS TALIAN (ONLINE)</option>
                                </select>
                            </div>
                            <label class="form-label" style="font-weight: bold;margin-top: 15px;">Pejabat Lapor<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="pejabat_lapor" id="pejabat_lapor" disabled>
                                    @if ($mohon->kategori_iklan_id != 1)
                                    <option value="{{ $data->pejabatlapor['id'] }}">
                                        {{ $data->pejabatlapor['alamat'] }}</option>
                                    @endif
                                    @foreach ($alamat as $alamat)
                                    <option value="{{ $alamat->id }}">{{ $alamat->alamat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Tarikh Taklimat Tender<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_taklimat_tender" id="tarikh_taklimat_tender"
                                    class="form-control" readonly>
                            </div>
                            <label class="form-label" style="font-weight: bold;margin-top: 15px;">Tarikh Lawatan Tapak<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_lawatan_tapak" id="tarikh_lawatan_tapak"
                                    class="form-control" readonly>
                            </div>
                            <label class="form-label" style="font-weight: bold;margin-top: 15px;">Waktu Lapor<a style="color: red;">*</a></label>
                            <div>
                                <input type="time" name="waktu_lapor" id="waktu_lapor" class="form-control" readonly
                                    value="{{ $data->waktu_lapor }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Lokasi Tapak<a style="color: red;">*</a></label>
                            <i class="bi bi-info-circle-fill"></i>
                            <span class="tooltip-text" style="font-weight: bold; margin-right:360px;">
                                Isikan pautan url sekiranya ada. <br>
                            </span>
                            <div>
                                <textarea class="form-control" name="lokasi" id="lokasi" style="height: 110px" onkeyup="
                                    var start = this.selectionStart;
                                    var end = this.selectionEnd;
                                    this.value = this.value.toUpperCase();
                                    this.setSelectionRange(start, end);" readonly>{{ $data->lokasi_tapak }}</textarea>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card" >
                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Kod QR Borang Saringan Wajib / Lawatan Tapak :</label>
                            <a class="mdi mdi-qrcode" id="link-id" href='{{$path_qrcode}}'target="_blank" role="button"></a>
                    </div>
                </div>
            </div>


        </div>
      </div>
      <div class="button-form">
        <input class="form-control" type="text" name="iklan_perolehan_id" value="{{ $data->id }}"
            style="display:none;">
        <input class="form-control" type="text" name="mohon_perolehan_id" value="{{ $mohon->id_perolehan }}"
            style="display:none;">
        <input class="form-control" type="text" name="kategori_iklan_id" value="{{ $mohon->kategori_iklan_id }}"
            style="display:none;">
        <input class="form-control" type="text" id="status" name="status" style="display:none;">
        <input type="number" name="counterbidang" id="counterbidang" value="count" style="display:none;">
        <input type="number" name="counterkelas" id="counterkelas" value="countKelas" style="display:none;">
        <input type="number" name="counterpukonsa" id="counterpukonsa" style="display:none;">
        <input type="number" name="counterupkj" id="counterupkj" style="display:none;">
    </div>
    </section>
</form>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
<link rel="stylesheet" href={{ Module::asset('tunas:css/style.css') }}>
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
<style>
    #link-id{
        padding: 4px;
        font-size: 26px;
        color: #6c757d;
        background-color: rgb(236, 236, 236);
        border-color: rgb(236, 236, 236);
    }

    #link-id:hover{    /*or .link-class if targeting by class*/
        color: #5c636a;
        background-color: rgb(180, 180, 180);
        border-color: rgb(180, 180, 180);
        border-top-color: rgb(180, 180, 180);
        border-right-color: rgb(180, 180, 180);
        border-bottom-color: rgb(180, 180, 180);
        border-left-color: rgb(180, 180, 180);
    }
</style>

<script>
    //data iklan perolehan
    data = @json($data);
    mohon = @json($mohon);
    bidang_sub = @json($bidang_sub); //selected value
    bidang_data = @json($bidang_data); //selected value
    kelas_data = @json($kelas_data); //selected value
    data_khusus = @json($data_khusus); //selected value
    pukonsa_data = @json($pukonsa_data); //selected value
    data_pukonsa = @json($data_pukonsa); //selected value
    upkj_data = @json($upkj_data); //selected value
    data_upkj = @json($data_upkj); //selected value
    borang_daftar = @json($borang_daftar); //selected value
    let negeri = @json($negeri_singkatan);
    let namaPerolehan = @json($nama_perolehan);



    if (namaPerolehan == 'KERJA') {
        document.getElementById('gred').value = data.grade_id;
    }

    // condition for muat naik draf iklan
    // if (mohon.dokumen_muatnaik == null || mohon.dokumen_muatnaik == '') {
    //     document.getElementById("muatturun").hidden = true;
    //     document.getElementById("muatnaik").hidden = false;
    //     document.getElementById('hantar').disabled = true;
    // } else {
    //     document.getElementById("muatturun").hidden = false;
    // }


    if (mohon.kategori_iklan_id != 1){
        //tarikh mula jual
        var date = data['tarikh_mula_jual'].split(" ")[0];
        var year = date.split("-")[0];
        var month = date.split("-")[1];
        var day = date.split("-")[2];
        var tarikh_mula_jual = year + '-' + month + '-' + day;
        $('#tarikh_mula_jual').val(tarikh_mula_jual);

        document.getElementsByName("tarikh_mula_jual")[0].setAttribute('min', mohon.tarikh_jangka_iklan);

        //tarikh_akhir_jual
        var date = data['tarikh_akhir_jual'].split(" ")[0];
        var year = date.split("-")[0];
        var month = date.split("-")[1];
        var day = date.split("-")[2];
        var tarikh_akhir_jual = year + '-' + month + '-' + day;
        $('#tarikh_akhir_jual').val(tarikh_akhir_jual);
        document.getElementsByName("tarikh_akhir_jual")[0].setAttribute('min', tarikh_mula_jual);

        //tarikh lawatan tapak
        if(data['tarikh_lawatan_tapak']) {
            var date = data['tarikh_lawatan_tapak'].split(" ")[0];
            var year = date.split("-")[0];
            var month = date.split("-")[1];
            var day = date.split("-")[2];
            var tarikh_lawatan_tapak = year + '-' + month + '-' + day;
            $('#tarikh_lawatan_tapak').val(tarikh_lawatan_tapak);
            var mulajual = document.getElementById("tarikh_mula_jual").value;
            var akhirjual = document.getElementById("tarikh_akhir_jual").value;
            document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('min', mulajual);
            document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('max', akhirjual);
        } else {
            document.getElementById('tarikh_lawatan_tapak').disabled = true;
        }

        // tarikh taklimat tender
        if(data['tarikh_taklimat_tender']) {
            var date = data['tarikh_taklimat_tender'].split(" ")[0];
            var year = date.split("-")[0];
            var month = date.split("-")[1];
            var day = date.split("-")[2];
            var tarikh_taklimat_tender = year + '-' + month + '-' + day;
            $('#tarikh_taklimat_tender').val(tarikh_taklimat_tender);
            var mulajual = document.getElementById("tarikh_mula_jual").value;
            var akhirjual = document.getElementById("tarikh_akhir_jual").value;
            document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('min', mulajual);
            document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('max', akhirjual);
        } else {
            document.getElementById('tarikh_taklimat_tender').disabled = true;
        }

        //tarikh_keluar_iklan
        var date = data['tarikh_keluar_iklan'].split(" ")[0];
        var year = date.split("-")[0];
        var month = date.split("-")[1];
        var day = date.split("-")[2];
        var tarikh_keluar_iklan = year + '-' + month + '-' + day;
        $('#tarikh_keluar_iklan').val(tarikh_keluar_iklan);
    }



    //harga dokumen tender
    $('#harga_dokumen').mask('0, 000, 000, 000, 000, 000, 000.00', {
        reverse: true
    }); //quintillion

    // start show file name
    var selDiv = "";
    document.addEventListener("DOMContentLoaded", init, false);

    function init() {
        document.querySelector('#upload').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }

    function handleFileSelect(e) {
        var ul = document.createElement('ul');
        if (!e.target.files) return;
        selDiv.innerHTML = "";
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
        document.getElementById('hantar').disabled = false;
        document.getElementById('draf').disabled = false;
    }
    // end file

    $(document).ready(

        function () {
            //start check ePerolehan
            if (mohon.kategori_iklan_id == 1){
                $('#section_tarikh').hide();
                document.getElementById('cara_bayar').required = false;
                document.getElementById('tarikh_mula_jual').required = false;
                document.getElementById('tarikh_akhir_jual').required = false;
                document.getElementById('harga_dokumen').required = false;
                document.getElementById('pejabat_pamer').required = false;
                document.getElementById('bayar_kepada').required = false;
                document.getElementById('lawatan_tapak').required = false;
                document.getElementById('pejabat_lapor').required = false;
                document.getElementById('tarikh_lawatan_tapak').required = false;
                document.getElementById('lokasi').required = false;
                document.getElementById('waktu_lapor').required = false;
            }
            //end check ePerolehan

            $("#wait").css("display", "block");
            $("div.spanner").addClass("show");
            $("head").append($(
                "<link rel='stylesheet' href='{{ Module::asset('sisdant:css/select2.css') }}' type='text/css' media='screen' />"
            ));
            $.getScript("{{ Module::asset('sisdant:js/1_11_1_jquery.min.js') }}", function () {
                $.getScript("{{ Module::asset('sisdant:js/select2.min.js') }}",
                    function () {
                        if(bidang_data.length > 0){
                            let bidang = @json($tablebidang); // all data
                            let subbidang = @json($tableSubbidang); //all data

                            for (let i = 0; i < bidang_data.length; i++) { //selected value
                                var ddlBidang = document.createElement("SELECT");
                                ddlBidang.classList.add('form-select');
                                ddlBidang.name = 'bidang' + i;
                                ddlBidang.id = 'bidang' + i;


                                var option = document.createElement("OPTION");
                                option.innerHTML = bidang_data[i].bidang.kod + ' - ' + bidang_data[i].bidang.bidang;
                                option.value = bidang_data[i].bidang.id;
                                ddlBidang.options.add(option);

                                //Add the Options to the BidangList.
                                for (var j = 0; j < bidang.length; j++) { //all data

                                    //remove same value
                                    if (bidang[j].id === bidang_data[i].bidang.id){
                                        bidang.splice(j, 1);
                                    }

                                    var option = document.createElement("OPTION");
                                    option.innerHTML = bidang[j].kod + ' - '+ bidang[j].bidang;
                                    option.value = bidang[j].id;
                                    ddlBidang.options.add(option);
                                }

                                // get source element.
                                var dvContainerBidang = document.getElementById("dvContainerBidang");

                                // create new row
                                var row = document.createElement("DIV");
                                row.className = 'row';

                                // create new column for dropdown Bidang. row 1 col 2
                                var colBidang = document.createElement("DIV");
                                colBidang.className = 'col-lg-6';
                                colBidang.style.cssText = 'margin-top:20px; margin-bottom:10px; ';
                                colBidang.appendChild(ddlBidang);

                                $('#bidang' + i).val(bidang_data[i].bidang_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colSub = document.createElement("DIV");
                                var name = "subbidang" + i + "[]";
                                var id = "subbidang" + i;
                                colSub.className = 'col-lg-6';
                                colSub.style.cssText = 'margin-top:20px; margin-bottom:10px;';
                                colSub.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required>
                                                    </select>
                                                </div>`

                                // display bidang
                                row.appendChild(col_remove);
                                row.appendChild(colBidang);
                                row.appendChild(colSub);
                                dvContainerBidang.appendChild(row);
                                // counter bidang + subbidang
                                document.getElementById('counterbidang').value = bidang_data.length;
                                $('#bidang' + i).select2();
                                $('#bidang' + i).prop('disabled', true);


                                //display selected subbidang
                                var id = bidang_data[i].bidang_id;
                                $.ajax({
                                    url: '/sisdant/editpermohonansah/subbidang/' + id,
                                    type: 'get',
                                    dataType: 'json',
                                    success: function (response) {
                                        $("#wait").css("display", "none");
                                        $("div.spanner").removeClass("show");
                                        var len = response[0].length;
                                        var subbidang = "subbidang" + i;
                                        document.getElementById(subbidang.toString()).disabled = false;

                                        for (let loop = 0; loop < bidang_sub[i].length; loop++){ //selected value

                                            var id_ = bidang_sub[i][loop].subbidang.id;
                                            var kod_ = bidang_sub[i][loop].subbidang.kod;
                                            var nama_ = bidang_sub[i][loop].subbidang.sub_bidang;

                                            $('#' + subbidang).append("<option value=" + id_ + " selected>" + kod_ + ' - ' + nama_ +
                                                "</option>");

                                        }

                                        for (var j = bidang_sub[i].length; j < len; j++) {

                                            var id = response[0][j].id;
                                            var nama = response[0][j].sub_bidang;
                                            var kod = response[0][j].kod;
                                            $('#' + subbidang).append("<option value=" + id + ">" + kod + ' - ' + nama +
                                                "</option>");
                                        }

                                        // tukar
                                        if (!$('#subbidang' + i).hasClass(
                                                "select2-hidden-accessible")) {
                                            $('#subbidang' + i).select2();

                                        } else {
                                            $('#subbidang' + i).val('').trigger('change');

                                        }

                                        $('#subbidang' + i).prop('disabled', true);


                                    }
                                });

                                ddlBidang.onchange = function () {
                                    var id = $(this).val();
                                    var selected = this.parentNode.parentNode.id;
                                    $.ajax({
                                        url: '/sisdant/editpermohonansah/subbidang/' + id,
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
                                            var subbidang = "subbidang" + i;

                                            $('#' + subbidang).empty();

                                            for (var j = 0; j < len; j++) {
                                                var id = response[0][j].id;
                                                var nama = response[0][j].sub_bidang;
                                                var kod = response[0][j].kod;
                                                $('#' + subbidang).append("<option value=" + id + ">" + kod + ' - ' + nama +
                                                    "</option>");
                                            }
                                            // tukar
                                            if (!$('#subbidang' + i).hasClass(
                                                        "select2-hidden-accessible")) {
                                                    $('#subbidang' + i).select2();
                                                    $('#subbidang' + i).val('').trigger(
                                                        'change');

                                                } else {
                                                    $('#subbidang' + i).val('').trigger('change');

                                                }
                                            $('#subbidang' + i).prop('disabled', true);

                                        }
                                    });
                                }

                            }
                            //end bidang and sub bidang
                        }
                        //start kelas dan pengkhususan
                        if(kelas_data.length > 0){
                            let kelas = @json($tablekelas); // all data
                            let khusus = @json($tableKhusus); //all data

                            for (let kd = 0; kd < kelas_data.length; kd++) { //selected value
                                var ddlKelas = document.createElement("SELECT");
                                ddlKelas.classList.add('form-select');
                                ddlKelas.name = 'kelas' + kd;
                                ddlKelas.id = 'kelas' + kd;

                                var optionkelas = document.createElement("OPTION");
                                optionkelas.innerHTML = kelas_data[kd].kelas.kod + ' - ' + kelas_data[kd].kelas.kelas;
                                optionkelas.value = kelas_data[kd].kelas.id;
                                ddlKelas.options.add(optionkelas);

                                //Add the Options to the KelasList.
                                for (var k = 0; k < kelas.length; k++) { //all data

                                    //remove same value
                                    if (kelas[k].id === kelas_data[kd].kelas.id){
                                        kelas.splice(k, 1);
                                    }

                                    var optionk = document.createElement("OPTION");
                                    optionk.innerHTML = kelas[k].kod + ' - '+ kelas[k].kelas;
                                    optionk.value = kelas[k].id;
                                    ddlKelas.options.add(optionk);
                                }

                                // get source element.
                                var dvContainerKelas = document.getElementById("dvContainerKelas");
                                var kategori_kelas = document.getElementById("kategori_kelas");
                                var kelas_pengkhususan = document.getElementById("kelas_pengkhususan");


                                // create new row
                                var row_k = document.createElement("DIV");
                                row_k.className = 'row';

                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px; ';
                                colKelas.appendChild(ddlKelas);

                                $('#kelas' + kd).val(kelas_data[kd].kelas_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colKhusus = document.createElement("DIV");

                                var name = "khusus" + kd + "[]";
                                var id = "khusus" + kd;
                                colKhusus.style.cssText = 'margin-top:20px; margin-bottom:10px;';
                                colKhusus.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required>
                                                    </select>
                                                </div>`

                                // display kelas
                                // row_k.appendChild(col_remove);
                                kategori_kelas.appendChild(colKelas);
                                kelas_pengkhususan.appendChild(colKhusus);

                                // counter kelas + khusus
                                document.getElementById('counterkelas').value = kelas_data.length;
                                $('#kelas' + kd).select2();
                                $('#kelas' + kd).prop('disabled', true);

                                //display selected pengkhususan
                                var id_kelas = kelas_data[kd].kelas_id;
                                $.ajax({
                                    url: '/sisdant/editpermohonansah/pengkhususan/' + id_kelas,
                                    type: 'get',
                                    dataType: 'json',
                                    success: function (response) {
                                        $("#wait").css("display", "none");
                                        $("div.spanner").removeClass("show");
                                        var len_ = response[0].length;
                                        var khusus = "khusus" + kd;
                                        document.getElementById(khusus.toString()).disabled = false;

                                        for (let khu = 0; khu < data_khusus[kd].length; khu++){ //selected value
                                            var id_kh = data_khusus[kd][khu].khusus.id;
                                            var kod_kh = data_khusus[kd][khu].khusus.kod;
                                            var nama_kh = data_khusus[kd][khu].khusus.pengkhususan;

                                            $('#' + khusus).append("<option value='" + id_kh + "' selected>" + kod_kh + ' - ' + nama_kh +
                                                "</option>");

                                        }

                                        for (var m = data_khusus[kd].length; m < len_; m++) { //all value

                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].pengkhususan;
                                            var kod_list = response[0][m].kod;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                        }



                                        // tukar
                                        if (!$('#khusus' + kd).hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#khusus' + kd).select2();

                                            } else {
                                                $('#khusus' + kd).val('').trigger('change');

                                            }
                                        $('#khusus' + kd).prop('disabled', true);

                                    }
                                });

                                ddlKelas.onchange = function () {
                                    var id = $(this).val();
                                    var selected = this.parentNode.parentNode.id;
                                    $.ajax({
                                        url: '/sisdant/editpermohonansah/pengkhususan/' + id,
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
                                            var len_ = response[0].length;
                                            var khusus = "khusus" + kd;
                                            document.getElementById(khusus.toString()).disabled = false;
                                            $('#' + khusus).empty();

                                            for (var m = 0; m < len_; m++) { //all value
                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].pengkhususan;
                                            var kod_list = response[0][m].kod;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                            }
                                            // tukar
                                            if (!$('#khusus' + kd).hasClass(
                                                        "select2-hidden-accessible")) {
                                                    $('#khusus' + kd).select2();

                                                } else {
                                                    $('#khusus' + kd).val('').trigger('change');

                                                }
                                            }
                                    });
                                }

                            }
                        }
                        //end kelas dan pengkhususan
                        if(pukonsa_data.length > 0){
                            //start pukonsa

                            let kelaspukonsa = @json($tablepukonsa); // all data
                            let subkelaspukonsa = @json($subkelaspukonsa); //all data

                            for (let kd = 0; kd < pukonsa_data.length; kd++) { //selected value
                                var ddlKelas = document.createElement("SELECT");
                                ddlKelas.classList.add('form-select');
                                ddlKelas.name = 'tajukpukonsa' + kd;
                                ddlKelas.id = 'tajukpukonsa' + kd;

                                var optionkelas = document.createElement("OPTION");
                                optionkelas.innerHTML = pukonsa_data[kd].kelas.tajuk+ ' - ' + pukonsa_data[kd].kelas.keterangan;
                                optionkelas.value = pukonsa_data[kd].kelas.id;
                                ddlKelas.options.add(optionkelas);

                                //Add the Options to the KelasList.
                                for (var k = 0; k < kelaspukonsa.length; k++) { //all data

                                    //remove same value
                                    if (kelaspukonsa[k].id === pukonsa_data[kd].kelas.id){
                                        kelaspukonsa.splice(k, 1);
                                    }

                                    var optionk = document.createElement("OPTION");
                                    optionk.innerHTML = kelaspukonsa[k].tajuk + ' - '+ kelaspukonsa[k].keterangan;
                                    optionk.value = kelaspukonsa[k].id;
                                    ddlKelas.options.add(optionk);
                                }

                                // get source element.
                                var dvContainer = document.getElementById("dvContainerPukonsa");

                                // create new row
                                var row_k = document.createElement("DIV");
                                row_k.className = 'row';

                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.className = 'col-lg-6';
                                colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px; ';
                                colKelas.appendChild(ddlKelas);

                                $('#tajukpukonsa' + kd).val(pukonsa_data[kd].kelas_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colKhusus = document.createElement("DIV");
                                var name = "subtajukpukonsa" + kd + "[]";
                                var id = "subtajukpukonsa" + kd;
                                colKhusus.className = 'col-lg-6';
                                colKhusus.style.cssText = 'margin-top:20px; margin-bottom:10px;';
                                colKhusus.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required>
                                                    </select>
                                                </div>`

                                // display kelas
                                // row_k.appendChild(col_remove);
                                row_k.appendChild(colKelas);
                                row_k.appendChild(colKhusus);
                                dvContainer.appendChild(row_k);
                                // counter kelas + khusus
                                document.getElementById('counterpukonsa').value = pukonsa_data.length;
                                $('#tajukpukonsa' + kd).select2();
                                $('#tajukpukonsa' + kd).prop('disabled', true);


                                // display selected pengkhususan
                                var id_kelas = pukonsa_data[kd].tajuk_id;
                                $.ajax({
                                    url: '/sisdant/editpermohonansah/subtajuk/' + id_kelas,
                                    type: 'get',
                                    dataType: 'json',
                                    success: function (response) {
                                        $("#wait").css("display", "none");
                                        $("div.spanner").removeClass("show");
                                        var len_ = response[0].length;
                                        var khusus = "subtajukpukonsa" + kd;
                                        document.getElementById(khusus.toString()).disabled = false;

                                        for (let khu = 0; khu < data_pukonsa[kd].length; khu++){ //selected value
                                            var id_kh = data_pukonsa[kd][khu].khusus.id;
                                            var kod_kh = data_pukonsa[kd][khu].khusus.tajuk_kecil;
                                            var nama_kh = data_pukonsa[kd][khu].khusus.keterangan;

                                            $('#' + khusus).append("<option value='" + id_kh + "' selected>" + kod_kh + ' - ' + nama_kh +
                                                "</option>");

                                        }

                                        for (var m = data_pukonsa[kd].length; m < len_; m++) { //all value

                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].keterangan;
                                            var kod_list = response[0][m].tajuk_kecil;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                        }

                                        // tukar

                                        $('#subtajukpukonsa' + kd).prop('disabled', true);

                                        if (!$('#subtajukpukonsa' + kd).hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#subtajukpukonsa' + kd).select2();

                                            } else {
                                                $('#subtajukpukonsa' + kd).val('').trigger('change');

                                            }
                                    }
                                });

                                ddlKelas.onchange = function () {
                                    var id = $(this).val();
                                    var selected = this.parentNode.parentNode.id;
                                    $.ajax({
                                        url: '/sisdant/editpermohonansah/subtajuk/' + id,
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
                                            var len_ = response[0].length;
                                            var khusus = "subtajukpukonsa" + kd;
                                            document.getElementById(khusus.toString()).disabled = false;
                                            $('#' + khusus).empty();

                                            for (var m = 0; m < len_; m++) { //all value
                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].keterangan;
                                            var kod_list = response[0][m].tajuk_kecil;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                            }

                                            // tukar
                                            if (!$('#subtajukpukonsa' + kd).hasClass(
                                                        "select2-hidden-accessible")) {
                                                    $('#subtajukpukonsa' + kd).select2();

                                                } else {
                                                    $('#subtajukpukonsa' + kd).val('').trigger('change');

                                                }
                                            }
                                    });
                                }

                            }
                            //end pukonsa
                        }

                        if(pukonsa_data.length == 0 && negeri == 'IP'){
                            if (!$('#tajukpukonsa0')[0].classList.contains('select2-hidden-accessible')) {
                                $("#tajukpukonsa0").select2().on('change', function (e) {
                                    var id = $(this).val();
                                    $.ajax({
                                        url: '/sisdant/editpermohonansah/subtajuk/' + id,
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
                                            document.getElementById("subtajukpukonsa0")
                                                .disabled = false;
                                            document.getElementById('subtajukpukonsa0').removeAttribute('hidden');
                                            $("#subtajukpukonsa0").empty();
                                            for (var i = 0; i < len; i++) {
                                                var id = response[0][i].id;
                                                var tajuk_kecil = response[0][i].tajuk_kecil;
                                                var keterangan = response[0][i].keterangan;
                                                $("#subtajukpukonsa0").append(
                                                    "<option value='" + id + "'>" + tajuk_kecil + " - " +
                                                    keterangan +
                                                    "</option>");
                                            }

                                            if (!$('#subtajukpukonsa0').hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#subtajukpukonsa0').select2();
                                                $('#subtajukpukonsa0').val('').trigger(
                                                    'change');

                                            } else {
                                                $('#subtajukpukonsa0').val('').trigger('change');

                                            }
                                        }
                                    });
                                })
                            }
                        }
                        //start upkj
                        if(upkj_data.length > 0){
                            let kelasupkj = @json($tableupkj); // all data
                            let subkelasupkj = @json($subkelasupkj); //all data

                            for (let kd = 0; kd < upkj_data.length; kd++) { //selected value
                                var ddlKelas = document.createElement("SELECT");
                                ddlKelas.classList.add('form-select');
                                ddlKelas.name = 'tajukupkj' + kd;
                                ddlKelas.id = 'tajukupkj' + kd;

                                var optionkelas = document.createElement("OPTION");
                                optionkelas.innerHTML = upkj_data[kd].kelas.tajuk+ ' - ' + upkj_data[kd].kelas.keterangan;
                                optionkelas.value = upkj_data[kd].kelas.id;
                                ddlKelas.options.add(optionkelas);

                                //Add the Options to the KelasList.
                                for (var k = 0; k < kelasupkj.length; k++) { //all data

                                    var optionk = document.createElement("OPTION");
                                    optionk.innerHTML = kelasupkj[k].tajuk + ' - '+ kelasupkj[k].keterangan;
                                    optionk.value = kelasupkj[k].id;
                                    ddlKelas.options.add(optionk);
                                }

                                // get source element.
                                var dvContainerUpkj = document.getElementById("dvContainerUpkj");

                                // create new row
                                var row_k = document.createElement("DIV");
                                row_k.className = 'row';

                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.className = 'col-lg-6';
                                colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px; ';
                                colKelas.appendChild(ddlKelas);

                                $('#tajukupkj' + kd).val(upkj_data[kd].kelas_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colKhusus = document.createElement("DIV");
                                var name = "subtajukupkj" + kd + "[]";
                                var id = "subtajukupkj" + kd;
                                colKhusus.className = 'col-lg-6';
                                colKhusus.style.cssText = 'margin-top:20px; margin-bottom:10px;';
                                colKhusus.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required>
                                                    </select>
                                                </div>`

                                // display kelas
                                // row_k.appendChild(col_remove);
                                row_k.appendChild(colKelas);
                                row_k.appendChild(colKhusus);
                                dvContainerUpkj.appendChild(row_k);
                                // counter kelas + khusus
                                document.getElementById('counterupkj').value = upkj_data.length;
                                $('#tajukupkj' + kd).select2();
                                $('#tajukupkj' + kd).prop('disabled', true);


                                // display selected pengkhususan
                                var id_kelas = upkj_data[kd].tajuk_id;
                                $.ajax({
                                    url: '/sisdant/editpermohonansah/subtajukupkj/' + id_kelas,
                                    type: 'get',
                                    dataType: 'json',
                                    success: function (response) {
                                        $("#wait").css("display", "none");
                                        $("div.spanner").removeClass("show");
                                        var len_ = response[0].length;
                                        var khusus = "subtajukupkj" + kd;
                                        document.getElementById(khusus.toString()).disabled = false;

                                        for (let khu = 0; khu < data_upkj[kd].length; khu++){ //selected value
                                            var id_kh = data_upkj[kd][khu].khusus.id;
                                            var kod_kh = data_upkj[kd][khu].khusus.tajuk_kecil;
                                            var nama_kh = data_upkj[kd][khu].khusus.keterangan;

                                            $('#' + khusus).append("<option value='" + id_kh + "' selected>" + kod_kh + ' - ' + nama_kh +"</option>");

                                        }

                                        for (var m = data_upkj[kd].length; m < len_; m++) { //all value

                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].keterangan;
                                            var kod_list = response[0][m].tajuk_kecil;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                        }
                                        $('#subtajukupkj' + kd).prop('disabled', true);


                                        // tukar
                                        if (!$('#subtajukupkj' + kd).hasClass(
                                                    "select2-hidden-accessible")) {
                                                $('#subtajukupkj' + kd).select2();

                                            } else {
                                                $('#subtajukupkj' + kd).val('').trigger('change');

                                            }
                                    }
                                });

                                ddlKelas.onchange = function () {
                                    var id = $(this).val();
                                    var selected = this.parentNode.parentNode.id;
                                    $.ajax({
                                        url: '/sisdant/editpermohonansah/subtajukupkj/' + id,
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
                                            var len_ = response[0].length;
                                            var khusus = "subtajukupkj" + kd;
                                            document.getElementById(khusus.toString()).disabled = false;
                                            $('#' + khusus).empty();

                                            for (var m = 0; m < len_; m++) { //all value
                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].keterangan;
                                            var kod_list = response[0][m].tajuk_kecil;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                            }
                                            // tukar
                                            if (!$('#subtajukupkj' + kd).hasClass(
                                                        "select2-hidden-accessible")) {
                                                    $('#subtajukupkj' + kd).select2();

                                                } else {
                                                    $('#subtajukupkj' + kd).val('').trigger('change');

                                                }
                                            }


                                    });
                                }

                            }
                        }

                        if(upkj_data.length == 0 && negeri == 'IP'){
                            if (!$('#tajukupkj0')[0].classList.contains('select2-hidden-accessible')) {
                                $("#tajukupkj0").select2().on('change', function (e) {
                                    var id = $(this).val();
                                    $.ajax({
                                        url: '/sisdant/editpermohonansah/subtajukupkj/' + id,
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


</script>



@endsection
