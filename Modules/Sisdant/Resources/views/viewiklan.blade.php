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

                        <div class="row mb-3" id='tajuk_per'>
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
                                        this.setSelectionRange(start, end);
                                        success();">{{ $mohon->tajuk_perolehan  }}</textarea>
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
                                        <input type="file" id="upload" name="upload" style="display:none;"
                                            accept=".pdf">
                                        <input type="text" name="file" id="file" style="display:none;">
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="selectedFiles" name="selectedFiles" style="color: #0d6efd;"></div>
                                    </div>
                                </div>
                                <div class="row mb-3" id="muatturun">
                                    <div class="col-lg-1" style="margin-left: 20px">
                                        <i class="mdi mdi-minus-circle" style="color: red; font-size:22px;"
                                            onclick="deletelist({{ $mohon->id_perolehan }})"
                                            data-id="{{ $mohon->id_perolehan }}"></i>
                                    </div>
                                    <div class="col-lg-8" style="margin-left: -25px; margin-top: 7px;">
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
                <div class="card" id="cidb">
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
                            <i class="bi bi-info-circle-fill"></i>
                            <span class="tooltip-text" style="font-weight: bold; margin-right:360px;">
                                <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                    Boleh pilih satu atau lebih</a><br>
                            </span>
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
                            <select class="form-select" name="gred" id="gred" onchange="success()">
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
                    <div class="card" id="mof">
                        <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Kementerian Kewangan Malaysia (MOF)</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Kod Bidang <a style="color: red;"> *</a></label>
                                {{-- <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;" onclick="AddDropDownList()">
                                    <i class="fas fa-plus"></i>
                                </span> --}}
                                <div id="divkod"></div>

                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Sub bidang <a style="color: red;">*</a></label>
                                <div id="divsub"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div id="dvContainerBidang">
                            </div>
                        </div>
                    </div>
                @endif

                @if($negeri_singkatan == 'IP')
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
                                <input type="text" id="pre" name="pre" hidden/>
                            </div>
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
                                    <select style="width: 100%;" class="js-example-basic-multiple" name="subtajukpukonsa0[]"
                                        id="subtajukpukonsa0" multiple="multiple" disabled hidden onchange="success()">
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
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Tarikh Jual Mulai Dari<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_mula_jual" id="tarikh_mula_jual" onchange="datestart(event);"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="inputDate" class="form-label" style="font-weight: bold;">Tarikh Akhir Jual<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_akhir_jual" id="tarikh_akhir_jual" class="form-control" onchange="enddate(event);" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Cara Bayaran<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="cara_bayar" id="cara_bayar" onchange="carabayar(event)" required>
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
                                <div class="input-icon" style="width: 100%;">
                                    <input type="text" name="harga_dokumen" id="harga_dokumen"
                                        class="form-control" value="{{ $data->harga_dokumen }}"
                                        style="padding-left:50px;" onkeyup="success()" required>
                                    <i style="width: 50px;"> RM </i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Pejabat Pamer Dan Jual<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="pejabat_pamer" id="pejabat_pamer" onchange="success()" required>
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
                                <select class="form-select" name="bayar_kepada" id="bayar_kepada" onchange="success()" required>
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
                                <select class="form-select" name="taklimat_tender" id="taklimat_tender" onchange="success()" required>
                                    <option value="WAJIB" {{ $data->taklimat_tender == "WAJIB"  ? 'selected' : '' }}>WAJIB</option>
                                    <option value="TIDAK_WAJIB" {{ $data->taklimat_tender == "TIDAK_WAJIB"  ? 'selected' : '' }}>TIDAK WAJIB</option>
                                    <option value="ONLINE" {{ $data->taklimat_tender == "ONLINE"  ? 'selected' : '' }}>ATAS TALIAN (ONLINE)</option>
                                </select>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Lawatan Tapak<a style="color: red;">*</a></label>
                            <div>
                                <select class="form-select" name="lawatan_tapak" id="lawatan_tapak" onchange="success()" required>
                                    <option value="WAJIB" {{ $data->lawatan_tapak == "WAJIB"  ? 'selected' : '' }}>WAJIB</option>
                                    <option value="TIDAK_WAJIB" {{ $data->lawatan_tapak == "TIDAK_WAJIB"  ? 'selected' : '' }}>TIDAK WAJIB</option>
                                    <option value="ONLINE" {{ $data->lawatan_tapak == "ONLINE"  ? 'selected' : '' }}>ATAS TALIAN (ONLINE)</option>
                                </select>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Pejabat Lapor<a style="color: red; padding-top: 15px;">*</a></label>
                            <div>
                                <select class="form-select" name="pejabat_lapor" id="pejabat_lapor" onchange="success()" required>
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
                            <label class="form-label" style="font-weight: bold;">Tarikh Taklimat Tender<a style="color: red; margin-top: 15px;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_taklimat_tender" id="tarikh_taklimat_tender"
                                    class="form-control" onchange="success()" required>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Tarikh Lawatan Tapak<a style="color: red;">*</a></label>
                            <div>
                                <input type="date" name="tarikh_lawatan_tapak" id="tarikh_lawatan_tapak"
                                    class="form-control" onchange="success()" required>
                            </div>

                            <label class="form-label" style="font-weight: bold;">Waktu Lapor<a style="color: red; margin-top: 15px;">*</a></label>
                            <div>
                                <input type="time" name="waktu_lapor" id="waktu_lapor" class="form-control" required
                                    value="{{ $data->waktu_lapor }}" onchange="success()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Lokasi Tapak<a style="color: red;">*</a></label>
                            <i class="bi bi-info-circle-fill"></i>
                            <span class="tooltip-text" style="font-weight: bold; margin-right:360px;">
                                Isikan pautan url sekiranya ada. <br>
                            </span>
                            <div>
                                <textarea class="form-control" name="lokasi" id="lokasi" style="height: 155px" onkeyup="
                                    var start = this.selectionStart;
                                    var end = this.selectionEnd;
                                    this.value = this.value.toUpperCase();
                                    this.setSelectionRange(start, end);
                                    success();" required>{{ $data->lokasi_tapak }}</textarea>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>
      </div>
      <div class="button-form">
        <button class="btn btn-primary" id="hantar" name="hantar" type="submit" value="hantar" style="width: 10%;">Iklan</button>
        <button class="btn btn-success" id="draf" name="simpan" type="submit" value="draf" style="width: 10%;">Simpan</button>
        <button class="btn btn-outline-primary" style="width: 10%; margin-right: 10px;"
            onclick="history.back()">Kembali</button>
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

    if (negeri == 'IP') {
        if(pukonsa_data.length > 0) {
            document.getElementById('pukonsa').checked = true;
            document.getElementById('pre').value = 'pukonsa';
        } else if (upkj_data.length > 0) {
            document.getElementById('upkj').checked = true;
            document.getElementById('pre').value = 'upkj';
        } else {
            document.getElementById('pre').value = 'tiada';
        }
    }


    // condition for muat naik draf iklan
    if (mohon.dokumen_muatnaik == null || mohon.dokumen_muatnaik == '') {
        document.getElementById("muatturun").hidden = true;
        document.getElementById("muatnaik").hidden = false;
        document.getElementById('hantar').disabled = true;
        document.getElementById('draf').disabled = true;
    } else {
        document.getElementById("muatturun").hidden = false;
        document.getElementById("muatnaik").hidden = true;
    }

    if(data.cara_bayaran_id == 1) {
        document.getElementById('harga_dokumen').readOnly = true;
        document.getElementById('bayar_kepada').disabled = true;
    }
    // delete uploaded file iklan
    function deletelist(id) {

        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/sisdant/editpermohonansah/deletefile/" + id,
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
                console.log("File deleted");
            }
        });
    }
    // end delete uploaded file

    function getSyarat(el) {

        if(el.value == 'pukonsa') {

            var pre = document.getElementById('pre').value;

            if (pukonsa_data.length > 0) {
                document.getElementById('divPukonsaData').style.display = 'block';
            } else {
                document.getElementById('divPukonsa').style.display = 'block';
            }

            if (upkj_data.length > 0) {
                document.getElementById('divUpkjData').style.display = 'none';
            } else {
                document.getElementById('divUpkj').style.display = 'none';
            }

            document.getElementById('tajukpukonsa0').setAttribute('required', '');
            document.getElementById('subtajukpukonsa0').setAttribute('required', '');

            if (pre == 'upkj') {
                document.getElementById('tajukupkj0').removeAttribute('required');
                document.getElementById('subtajukupkj0').removeAttribute('required');
            }

            document.getElementById('pre').value = el.value;
            success();

        } else if(el.value == 'upkj') {

            var pre = document.getElementById('pre').value;

            if (pukonsa_data.length > 0) {
                document.getElementById('divPukonsaData').style.display = 'none';
            } else {
                document.getElementById('divPukonsa').style.display = 'none';
            }

            if (upkj_data.length > 0) {
                document.getElementById('divUpkjData').style.display = 'block';
            } else {
                document.getElementById('divUpkj').style.display = 'block';
            }
            document.getElementById('tajukupkj0').setAttribute('required', '');
            document.getElementById('subtajukupkj0').setAttribute('required', '');

            if (pre == 'pukonsa') {
                document.getElementById('tajukpukonsa0').removeAttribute('required');
                document.getElementById('subtajukpukonsa0').removeAttribute('required');
            }

            document.getElementById('pre').value = el.value;
            success();

        } else if (el.value == 'tiada') {

            var pre = document.getElementById('pre').value;

            if (pukonsa_data.length > 0) {
                document.getElementById('divPukonsaData').style.display = 'none';
            } else {
                document.getElementById('divPukonsa').style.display = 'none';
            }

            if (upkj_data.length > 0) {
                document.getElementById('divUpkjData').style.display = 'none';
            } else {
                document.getElementById('divUpkj').style.display = 'none';
            }

            if (pre == 'pukonsa') {
                document.getElementById('tajukpukonsa0').removeAttribute('required');
                document.getElementById('subtajukpukonsa0').removeAttribute('required');
            } else if (pre == 'upkj') {
                document.getElementById('tajukupkj0').removeAttribute('required');
                document.getElementById('subtajukupkj0').removeAttribute('required');
            }

            document.getElementById('pre').value = el.value;
            success();

        }
    }

    //onchange cara bayar
    function carabayar(e){
        if (e.target.value == '1'){
            document.getElementById('harga_dokumen').readOnly = true;
            document.getElementById('bayar_kepada').disabled = true;
            document.getElementById('harga_dokumen').value = '0';
            if(data.cara_bayaran_id == 1) {
                var opt= document.getElementById('bayar_kepada').options[0];
                opt.value = data.bayar_kepada_id;
                opt.text = data.bayarkepada['nama'] ;
                document.getElementById('bayar_kepada').value = data.bayar_kepada_id;
            }
        } else{
            document.getElementById('harga_dokumen').readOnly = false;
            document.getElementById('harga_dokumen').value = '';
            document.getElementById('bayar_kepada').disabled = false;
            if(data.cara_bayaran_id == 1) {
                var opt= document.getElementById('bayar_kepada').options[0];
                opt.value =  '';
                opt.text = 'Sila Pilih';
                document.getElementById('bayar_kepada').value = '';
            }
        }
        success();
    }

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
            $('#tarikh_taklimat_tender').val(tarikh_lawatan_tapak);
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
        $('#tarikh_iklan').val(tarikh_keluar_iklan);
    }

    //onchange tarikh mula jual
    function datestart(e){
        var now1 = new Date(e.target.value);
        var now = new Date(now1.setDate(now1.getDate() + 13));
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today1 = now.getFullYear() + "-" + (month) + "-" + (day);
        $('#tarikh_akhir_jual').val(today1);
        document.getElementsByName("tarikh_akhir_jual")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('max', today1);
        $('#tarikh_lawatan_tapak').val('');
        success();
    }

    //onchange tarikh akhir jual
    function enddate(e){
        var now = new Date(e.target.value);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today1 = now.getFullYear() + "-" + (month) + "-" + (day);
        var tarikhmula = document.getElementById("tarikh_mula_jual").value;
        document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('min', tarikhmula);
        document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('max', today1);
        $('#tarikh_lawatan_tapak').val('');
        success();
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

            if( namaPerolehan == 'KERJA') {
                inputs_text = document.querySelectorAll('#cidb select');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( namaPerolehan != 'KERJA') {
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
                    if (upkj_data.length > 0) {
                        inputs_text = document.querySelectorAll('#divUpkjData select');
                        for (index = 0; index < inputs_text.length; ++index) {
                            if(inputs_text[index].value == '') {
                                count++;
                            }
                        }
                    } else {
                        inputs_text = document.querySelectorAll('#divUpkj select');
                        for (index = 0; index < inputs_text.length; ++index) {
                            if(inputs_text[index].value == '') {
                                count++;
                            }
                        }
                    }
                }

                if (syarat == 'pukonsa') {
                    if (pukonsa_data.length > 0) {
                        inputs_text = document.querySelectorAll('#divPukonsaData select');
                        for (index = 0; index < inputs_text.length; ++index) {
                            if(inputs_text[index].value == '') {
                                count++;
                            }
                        }
                    } else {
                        inputs_text = document.querySelectorAll('#divPukonsa select');
                        for (index = 0; index < inputs_text.length; ++index) {
                            if(inputs_text[index].value == '') {
                                count++;
                            }
                        }
                    }
                }

            } else if (negeri == 'SBH') {

                inputs_text = document.querySelectorAll('#divPukonsaData select');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }

            } else if (negeri == 'SRK') {

                inputs_text = document.querySelectorAll('#divUpkjData select');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }

            }

            if (mohon.kategori_iklan_id == 2) {
                cara_bayar = document.getElementById('cara_bayar').value;

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
                document.getElementById('tarikh_lawatan_tapak').disabled = true;
            } else {
                document.getElementById('tarikh_lawatan_tapak').disabled = false;
            }

            taklimat_tender = document.getElementById('taklimat_tender').value;
            if (taklimat_tender == 'TIDAK_WAJIB') {
                count = count - 1;
                document.getElementById('tarikh_taklimat_tender').disabled = true;
            } else {
                document.getElementById('tarikh_taklimat_tender').disabled = false;
            }

            // console.log('BIL' + count);

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
                    document.getElementById("status").value = 'hantar';
                    for (let i = 0; i < bidang_data.length; i++) {
                        $('#bidang' + i).prop('disabled', false);
                    }
                    for (let kd = 0; kd < kelas_data.length; kd++) {
                        $('#kelas' + kd).prop('disabled', false);
                    }
                    for (let tp = 0; tp < pukonsa_data.length; tp++) { //selected value
                        $('#tajukpukonsa' + tp).prop('disabled', false);
                    }
                    for (let tu = 0; tu < upkj_data.length; tu++) { //selected value
                        $('#tajukpkj'+ tu).prop('disabled', false);
                    }
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });

        }else if(document.activeElement.value == 'draf'){
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
                document.getElementById('taklimat_tender').required = false;
                document.getElementById('tarikh_taklimat_tender').required = false;}
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
                                var divkod = document.getElementById("divkod");
                                var divsub = document.getElementById("divsub");


                                // create new row
                                var row = document.createElement("DIV");
                                row.className = 'row';

                                if ( i != 0) {
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                    btnRemove.onclick = function () {
                                        dvContainerBidang.removeChild(this.parentNode.parentNode);
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                } else {
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="fas fa-plus" style="color: Dodgerblue; margin-top: 15px; margin-left:37px;"></i>`;
                                    btnRemove.onclick = function () {
                                        AddDropDownList()
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                }
                                // create new column for dropdown Bidang. row 1 col 2
                                var colBidang = document.createElement("DIV");
                                // colBidang.className = 'col-lg-6';
                                // colBidang.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: -40px;';
                                colBidang.appendChild(ddlBidang);

                                $('#bidang' + i).val(bidang_data[i].bidang_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colSub = document.createElement("DIV");
                                var name = "subbidang" + i + "[]";
                                var id = "subbidang" + i;
                                // colSub.className = 'col-lg-6';
                                // colSub.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: 30px;';
                                colSub.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required onchange="success()">
                                                    </select>
                                                </div>`

                                // display bidang
                                // row.appendChild(col_remove);
                                divkod.appendChild(colBidang);
                                divsub.appendChild(colSub);
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

                                if(kd != 0 ){
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                    btnRemove.onclick = function () {
                                        // console.log(this.parentNode.parentNode);
                                        kategori_kelas.removeChild(this.parentNode.parentNode);
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                } else {
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="fas fa-plus" style="color: Dodgerblue; margin-top: 15px; margin-left:37px;"></i>`;
                                    btnRemove.onclick = function () {
                                        // console.log(this.parentNode.parentNode);
                                        AddDropDownKhusus()
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                }
                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                // colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: -40px;';
                                colKelas.appendChild(ddlKelas);

                                $('#kelas' + kd).val(kelas_data[kd].kelas_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colKhusus = document.createElement("DIV");

                                var name = "khusus" + kd + "[]";
                                var id = "khusus" + kd;
                                // colKhusus.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: 30px;';
                                colKhusus.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required onchange="success()">
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

                                if (kd != 0) {
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                    btnRemove.onclick = function () {
                                        dvContainer.removeChild(this.parentNode.parentNode);
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                } else {
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="fas fa-plus" style="color: Dodgerblue; margin-top: 15px; margin-left:37px;"></i>`;
                                    btnRemove.onclick = function () {
                                        AddDropDownListPukonsa()
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                }
                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.className = 'col-lg-6';
                                // colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: -40px;';
                                colKelas.appendChild(ddlKelas);

                                $('#tajukpukonsa' + kd).val(pukonsa_data[kd].kelas_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colKhusus = document.createElement("DIV");
                                var name = "subtajukpukonsa" + kd + "[]";
                                var id = "subtajukpukonsa" + kd;
                                colKhusus.className = 'col-lg-6';
                                // colKhusus.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: 30px;';
                                colKhusus.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required onchange="success()">
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
                                // console.log(pukonsa_data[kd].kelas_id);
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

                                    //remove same value
                                    // if (kelasupkj[k].id === upkj_data[kd].kelas.id){
                                    //     kelasupkj.splice(k, 1);
                                    // }

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

                                if (kd != 0) {
                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                    btnRemove.onclick = function () {
                                        dvContainerUpkj.removeChild(this.parentNode.parentNode);
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);

                                } else {

                                    // create new column for delete - row 1 col 1
                                    var col_remove = document.createElement("DIV");
                                    col_remove.className = 'col-lg-1';
                                    col_remove.style.marginTop = '10px';

                                    // Create a Remove Button.
                                    var btnRemove = document.createElement("LABEL");
                                    btnRemove.innerHTML =
                                        `<i class="fas fa-plus" style="color: Dodgerblue; margin-top: 15px; margin-left:37px;"></i>`;
                                    btnRemove.onclick = function () {
                                        AddDropDownListUPKJ()
                                    };

                                    // insert remove button into delete column.
                                    col_remove.appendChild(btnRemove);
                                }

                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.className = 'col-lg-6';
                                // colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: -40px;';
                                colKelas.appendChild(ddlKelas);

                                $('#tajukupkj' + kd).val(upkj_data[kd].kelas_id);

                                // create new column for dropdown sub Bidang. row 1 col 3
                                var colKhusus = document.createElement("DIV");
                                var name = "subtajukupkj" + kd + "[]";
                                var id = "subtajukupkj" + kd;
                                colKhusus.className = 'col-lg-6';
                                // colKhusus.style.cssText = 'margin-top:20px; margin-bottom:10px; margin-left: 30px;';
                                colKhusus.innerHTML = `<div>
                                                    <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
                                    id + ` multiple="multiple" required onchange="success()">
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

    //start add kelas
    countKelas = kelas_data.length;
    function AddDropDownKhusus() {
        let tablekelas = @json($tablekelas);

        //Create a DropDown List Kelas
        var ddlKelas = document.createElement("SELECT");

        // create khusus list
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
                    success();
                    var len = response[0].length;
                    var kelas_exist = kelas_data.length -1;
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
        col_remove.style.marginTop = '10px';

        // create new column for dropdown Kelas. row 1 col 2
        var colKelas = document.createElement("DIV");
        colKelas.className = 'col-lg-5';
        colKelas.style.cssText = 'margin-top:15px; margin-bottom:10px; margin-left: -40px;';

        // create new column for dropdown Khusus. row 1 col 3
        var colKhusus = document.createElement("DIV");
        var name = "khusus" + countKelas.toString() + "[]";
        var id = "khusus" + countKelas.toString();
        colKhusus.className = 'col-lg-5';

        colKhusus.style.cssText = 'margin-left: 30px; margin-top: 13px;';
        colKhusus.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" required disabled hidden onchange="success()">
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 33px;"></i>`;
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

    // start add bidang
    count = bidang_data.length;
    function AddDropDownList() {
        let tablebidang = @json($tablebidang);
        //Create a Bidang List
        var ddlBidang = document.createElement("SELECT");

        // create sub bidang list
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
        var dvContainerBidang = document.getElementById("dvContainerBidang");

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = count;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';
        col_remove.style.marginTop = '10px';

        // create new column for dropdown Bidang. row 1 col 2
        var colBidang = document.createElement("DIV");
        colBidang.className = 'col-lg-5';
        colBidang.style.cssText = 'margin-top:15px; margin-bottom:10px; margin-left: -40px;';

        // create new column for dropdown sub Bidang. row 1 col 3
        var colSub = document.createElement("DIV");
        var name = "subbidang" + count.toString() + "[]";
        var id = "subbidang" + count.toString();
        colSub.className = 'col-lg-5';
        colSub.style.cssText = 'margin-left: 30px; margin-top: 13px;';
        colSub.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" disabled hidden onchange="success()">
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 33px;"></i>`;
        btnRemove.onclick = function () {
            dvContainerBidang.removeChild(this.parentNode.parentNode);
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
        dvContainerBidang.appendChild(row);

        // counter bidang + subbidang
        document.getElementById('counterbidang').value = count;

        $('#bidang'+count).select2();
        count++;
    };
    // end add bidang

    //pukonsa
    if(pukonsa_data.length) {
        countPukonsa = pukonsa_data.length;
    } else {
        countPukonsa = 1;
    }
    function AddDropDownListPukonsa() {
        let tablebidang = @json($tablepukonsa);
        //Create a Bidang List
        var ddlBidang = document.createElement("SELECT");

        // create sub bidang list
        ddlBidang.onchange = function () {
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
                    success();
                    var len = response[0].length;
                    var subbidang = "subtajukpukonsa" + selected.toString();
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
        var dvContainer = document.getElementById("dvContainerPukonsa");

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = countPukonsa;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';
        col_remove.style.marginTop = '10px';

        // create new column for dropdown Bidang. row 1 col 2
        var colBidang = document.createElement("DIV");
        colBidang.className = 'col-lg-5';
        colBidang.style.cssText = 'margin-top:15px; margin-bottom:10px; margin-left: -40px;';

        // create new column for dropdown sub Bidang. row 1 col 3
        var colSub = document.createElement("DIV");
        var name = "subtajukpukonsa" + countPukonsa.toString() + "[]";
        var id = "subtajukpukonsa" + countPukonsa.toString();
        colSub.className = 'col-lg-5';
        colSub.style.cssText = 'margin-left: 30px; margin-top: 13px;';
        colSub.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" required disabled hidden onchange="success()">
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 33px;"></i>`;
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
        document.getElementById('counterpukonsa').value = countPukonsa;

        $('#tajukpukonsa'+countPukonsa).select2()
        countPukonsa++;
    };
    // end add bidang

    //upkj
    if(upkj_data.length) {
        countUpkj = upkj_data.length;
    } else {
        countUpkj = 1;
    }
    function AddDropDownListUPKJ() {
        let tablebidang = @json($tableupkj);
        //Create a Bidang List
        var ddlBidang = document.createElement("SELECT");

        // create sub bidang list
        ddlBidang.onchange = function () {
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
        var dvContainerUpkj = document.getElementById("dvContainerUpkj");

        // create new row
        var row = document.createElement("DIV");
        row.className = 'row';
        row.id = countUpkj;

        // create new column for delete - row 1 col 1
        var col_remove = document.createElement("DIV");
        col_remove.className = 'col-lg-1';
        col_remove.style.marginTop = '10px';

        // create new column for dropdown Bidang. row 1 col 2
        var colBidang = document.createElement("DIV");
        colBidang.className = 'col-lg-5';
        colBidang.style.cssText = 'margin-top:15px; margin-bottom:10px; margin-left: -40px;';

        // create new column for dropdown sub Bidang. row 1 col 3
        var colSub = document.createElement("DIV");
        var name = "subtajukupkj" + countUpkj.toString() + "[]";
        var id = "subtajukupkj" + countUpkj.toString();
        colSub.className = 'col-lg-5';
        colSub.style.cssText = 'margin-left: 30px; margin-top: 13px;';
        colSub.innerHTML = `<div>
                            <select style="width: 100%;" class="js-example-basic-multiple" name=` + name + ` id=` +
            id + ` multiple="multiple" required disabled hidden onchange="success()">
                            </select>
                        </div>`

        // Create a Remove Button.
        var btnRemove = document.createElement("LABEL");
        btnRemove.innerHTML =
            `<i class="mdi mdi-minus-circle" style="color: red; font-size:22px; margin-left: 30px;"></i>`;
        btnRemove.onclick = function () {
            dvContainerUpkj.removeChild(this.parentNode.parentNode);
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
        dvContainerUpkj.appendChild(row);

        // counter bidang + subbidang
        document.getElementById('counterupkj').value = countUpkj;

        $('#tajukupkj'+countUpkj).select2()
        countUpkj++;
    };
    // end add bidang

</script>


@endsection
