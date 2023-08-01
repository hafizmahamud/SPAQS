<!DOCTYPE HTML>
@extends('tunas::layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Senarai Iklan Belum Tutup</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
    <section class="section">
        <ul style="width: 30%; background-color:white;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" style="width: 50%;"
                    data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                    aria-selected="true">Iklan</button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" style="width: 50%;"
                    data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Senarai Petender
                    @if(in_array('PENYARING PETENDER', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                </button>
            </li>
        </ul>
        <div class="card">
                <!-- Default Tabs -->
                <div class="tab-content pt-2" id="myTabjustifiedContent">
                    {{-- START IKLAN --}}
                    <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                        <div class="spanner">
                            <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
                            </div>
                        </div>
                        <form id="myForm" autocomplete="off" method="post" action="{{ url('/tunas/saveaddendum') }}" enctype="multipart/form-data"
                        style="padding: 10px;">
                        @csrf
                        <div class="card">

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Negeri</label>
                                    <div>
                                        <input class="form-control" type="text" name="negeri" value="{{ $mohon->negeri['negeri'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">No Tender</label>
                                    <div>
                                        <input class="form-control" type="text" name="no_perolehan"
                                            value="{{ $mohon->no_perolehan }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Jenis Iklan</label>
                                    <div>
                                        <input class="form-control" type="text" name="jenis_iklan" value="{{ $mohon->matrikiklan['jenisiklan']['nama'] }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Jenis Tender</label>
                                    <div>
                                        <input class="form-control" type="text" name="tender" value="{{ $mohon->matrikiklan['jenistender']['nama'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Kaedah Perolehan</label>
                                    <div>
                                        <input class="form-control" type="text" name="kategoriperolehan" value="{{ $mohon->matrikiklan['kategoriperolehan']['nama'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <label class=" form-label" style="font-weight: bold;">Tajuk Projek</label>
                                    <div>
                                        <textarea class="form-control" name="tajuk" style="height: 100px" readonly>{{ $mohon->tajuk_perolehan }} </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Lembaga Pembangunan Industri Pembinaan Malaysia (CIDB)</h5>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Kategori<a style="color: red;"> *</a></label>
                                    <div id="kategori_kelas"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Pengkhususan<a style="color: red;">*</a></label>
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
                        @if(!$bidang_data->isEmpty())
                            <div class="card">
                                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Kementerian Kewangan Malaysia (MOF)</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Kod Bidang<a style="color: red;"> *</a></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Sub bidang<a style="color: red;">*</a></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div id="dvContainerBidang">
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!$pukonsa_data->isEmpty())
                            <div class="card">
                                <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Pusat Pendaftaran Kontraktor-Kontraktor Kerja, Bekalan, Perkhidmatan dan Juruperunding Negeri Sabah (PUKONSA)</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Tajuk PUKONSA<a style="color: red;"> *</a></label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Tajuk Kecil PUKONSA<a style="color: red;">*</a></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div id="dvContainerPukonsa">
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(!$upkj_data->isEmpty())
                        <div class="card">
                            <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Unit Pendaftaran Kontraktor & Juruperunding (UPKJ)</h5>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Tajuk UPKJ<a style="color: red;"> *</a></label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Tajuk Kecil UPKJ<a style="color: red;">*</a></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div id="dvContainerUpkj">
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="card">
                            <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Maklumat Dokumen Tender</h5>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label class="form-label" style="font-weight: bold;">Tarikh Jangka Iklan<a style="color: red;">*</a></label>
                                    <div>
                                        <input type="text" name="tarikh_jangka_iklan" id="tarikh_jangka_iklan" value="{{ $mohon->tarikh_jangka_iklan }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label" style="font-weight: bold;">Tarikh Keluar Iklan<a style="color: red;">*</a></label>
                                    <div>
                                        <input type="date" name="tarikh_keluar_iklan" id="tarikh_keluar_iklan" class="form-control" required>
                                    </div>
                                </div>
                            </div>
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
                                        <input type="date" name="tarikh_akhir_jual" id="tarikh_akhir_jual" onchange="enddate(event)" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label" style="font-weight: bold;">Cara Bayaran</label>
                                    <div>
                                        <input type="type" name="cara_bayar" id="cara_bayar" value="{{ $data->carabayar['nama'] }}" class="form-control" disabled>
                                        <input type="type" name="cara_bayar" id="cara_bayar" value="{{ $data->cara_bayaran_id }}" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label class="form-label" style="font-weight: bold;">Harga Dokumen Tender<a style="color: red;">*</a></label>
                                    <div class="form-group">
                                        <div class="input-icon" style="width: 100%;">
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
                                        <select class="form-select" name="pejabat_pamer" id="pejabat_pamer" required>
                                            <option value="{{ $data->pejabat_pamer_jual }}">
                                                {{ $data->pejabatpamer['alamat'] }}</option>
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
                                        <input type="type" name="bayar_kepada" id="bayar_kepada" value="{{ $data->bayarkepada['nama'] }}" class="form-control" disabled>
                                    </div>
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label class="form-label" style="font-weight: bold;">Taklimat Tender<a style="color: red;padding-top: 15px;">*</a></label>
                                    <div>
                                        <select class="form-select" name="taklimat_tender" id="taklimat_tender" onchange="checkingButton()" required>
                                            <option value="WAJIB" {{ $data->taklimat_tender == "WAJIB"  ? 'selected' : '' }}>WAJIB</option>
                                            <option value="TIDAK_WAJIB" {{ $data->taklimat_tender == "TIDAK_WAJIB"  ? 'selected' : '' }}>TIDAK WAJIB</option>
                                            <option value="ONLINE" {{ $data->taklimat_tender == "ONLINE"  ? 'selected' : '' }}>ATAS TALIAN (ONLINE)</option>
                                        </select>
                                    </div>
                                    <label class="form-label" style="font-weight: bold; margin-top: 15px;">Lawatan Tapak<a style="color: red;">*</a></label>
                                    <div>
                                        <select class="form-select" name="lawatan_tapak" id="lawatan_tapak" onchange="checkingButton()" required>
                                            <option value="WAJIB" {{ $data->lawatan_tapak == "WAJIB"  ? 'selected' : '' }}>WAJIB</option>
                                            <option value="TIDAK_WAJIB" {{ $data->lawatan_tapak == "TIDAK_WAJIB"  ? 'selected' : '' }}>TIDAK WAJIB</option>
                                            <option value="ONLINE" {{ $data->lawatan_tapak == "ONLINE"  ? 'selected' : '' }}>ATAS TALIAN (ONLINE)</option>
                                        </select>
                                    </div>
                                    <label class="form-label" style="font-weight: bold; margin-top: 15px;">Pejabat Lapor<a style="color: red;">*</a></label>
                                    <div>
                                        <select class="form-select" name="pejabat_lapor" id="pejabat_lapor" required>
                                            <option value="{{ $data->pejabatlapor['id'] }}">
                                                {{ $data->pejabatlapor['alamat'] }}</option>
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
                                            class="form-control" required>
                                    </div>
                                    <label class="form-label" style="font-weight: bold; margin-top: 15px;">Tarikh Lawatan Tapak<a style="color: red;">*</a></label>
                                    <div>
                                        <input type="date" name="tarikh_lawatan_tapak" id="tarikh_lawatan_tapak"
                                            class="form-control" required>
                                    </div>
                                    <label class="form-label" style="font-weight: bold; margin-top: 15px;">Waktu Lapor<a style="color: red;">*</a></label>
                                    <div>
                                        <input type="time" name="waktu_lapor" class="form-control" required
                                            value="{{ $data->waktu_lapor }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" style="font-weight: bold;">Lokasi Tapak<a style="color: red;">*</a></label>
                                    <div>
                                        <textarea class="form-control" name="lokasi" id="lokasi" style="height: 110px" onkeyup="
                                            var start = this.selectionStart;
                                            var end = this.selectionEnd;
                                            this.value = this.value.toUpperCase();
                                            this.setSelectionRange(start, end);" required>{{ $data->lokasi_tapak }}</textarea>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="card">
                            <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Maklumat Tutup Tender</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Peti Tender<a style="color: red;">*</a></label>
                                        <div>
                                            <select class="form-select" name="peti_tender" id="peti_tender" required  onchange="success()">
                                                @if ($data->peti_tender != null)
                                                    <option value="{{ $data->petitender['id'] }}">
                                                        {{ $data->petitender['alamat'] }}</option>
                                                @elseif ($data->peti_tender == null)
                                                    <option value="">SILA PILIH</option>
                                                @endif
                                                @foreach ($petitender as $petitender)
                                                    <option value="{{ $petitender->id }}">{{ $petitender->alamat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label" style="font-weight: bold;">Tarikh Tutup<a style="color: red;">*</a></label>
                                        <div>
                                            <input type="date" name="tarikh_tutup" id="tarikh_tutup" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="form-label" style="font-weight: bold;">Waktu Tutup<a style="color: red;">*</a></label>
                                        <div>
                                            <input type="time" name="waktu_tutup" class="form-control" required
                                                value="12:00:00">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card">
                            <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Dokumen</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Muat Naik Dokumen Iklan</label>
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span class="tooltip-text" style="font-weight: bold; margin-right:280px; margin-top:10px;">
                                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                                i. Hanya fail .pdf sahaja <br>
                                                ii. Saiz tidak melebihi 10MB</a><br>
                                        </span>
                                        <div id="muatnaik">
                                            <div class="col-lg-4">
                                                <input for="upload" type="button" class="btn btn-outline-primary"
                                                    value="Muat Naik" onclick="document.getElementById('fileIklan').click();"
                                                    style="width: 100%;" />
                                                <input type="file" id="fileIklan" onchange="handleFileSelectIklan(event)" name="fileIklan" style="display:none;"
                                                    accept=".pdf">
                                            </div>
                                            <div class="col-lg-8">
                                                <div id="selectedFilesIklan" name="selectedFilesIklan"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8" id="muatturun">
                                            <a href='/{{ $mohon->dokumen_muatnaik }}'
                                                target="_blank">{{ $mohon->nama_dokumen }}</a>
                                            <i class="mdi mdi-minus-circle" style="color: red; font-size:24px;"
                                                onclick="deletelist({{ $mohon->id_perolehan }})"
                                                data-id="{{ $mohon->id_perolehan }}"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Dokumen Tender</label>
                                        <div id="file_tender">
                                            @if ($dokumen_tender != null)
                                            @foreach ($dokumen_tender as $dt)
                                            <div>
                                                <a href='/{{ $dt->dokumen }}' target="_blank">{{ $dt->nama }}</a>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" style="font-weight: bold;">Muat Naik Dokumen Tambahan</label>
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span class="tooltip-text" style="font-weight: bold; margin-right:250px; margin-top:10px;">
                                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                                i. Hanya fail .zip sahaja <br>
                                                ii. Saiz tidak melebihi 10MB</a><br>
                                        </span>
                                        <div>
                                            <div class="col-lg-4">
                                                <input for="upload" type="button" class="btn btn-outline-primary"
                                                    value="Muat Naik" onclick="document.getElementById('fileAddendum').click();"
                                                    style="width: 100%;" />
                                                <input type="file" id="fileAddendum" onchange="handleFileSelectAddendum(event)" name="fileAddendum"
                                                    style="display:none;" accept=".zip"/><br><br>
                                            </div>
                                            <div class="col-lg-12">
                                                <div id="selectedFilesAddendum" name="selectedFilesAddendum"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6" id="fail_addendum">
                                        <div id="fail_addendum">
                                            @if ($fail_addendum != null)
                                            @foreach ($fail_addendum as $dt)
                                            <div class="ml-5">
                                                <a href='{{ config('app.url').'/'.$dt->path }}' target="_blank">{{ $dt->dokumen }}</a>
                                                <i class="mdi mdi-minus-circle" style="color: red; font-size:24px;"
                                                    onclick="deleteaddendum({{ $dt->id }}, {{ $dt->iklan_perolehan_id }})"
                                                    data-id="{{ $dt->id }}"></i>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="button-form">
                            <button class="btn btn-primary" id="hantar" name="hantar" type="submit" value="hantar" style="width: 10%;">Hantar</button>
                            <button class="btn btn-success" id="draf" name="simpan" type="submit" value="draf" style="width: 10%;">Simpan</button>
                            <input class="btn btn-outline-danger" style="width: 10%; margin-right: 10px;" type="submit" id="Batal" name="Batal" value="Batal" formnovalidate>
                            <button class="btn btn-primary-kembali" style="width: 10%;"
                                onclick="history.back()">Kembali</button>
                            <input class="form-control" type="text" id="status" name="status" style="display:none;">
                            <input class="form-control" type="text" name="iklan_perolehan_id" value={{ $data->id }}
                                style="display:none;">
                            <input class="form-control" type="text" name="mohon_perolehan_id" value={{ $mohon->id_perolehan }}
                                style="display:none;">
                            <input class="form-control" type="file"  name="dokumen"  id="dokumen" accept=".pdf" style="display:none;">
                            <input class="form-control" type="text" name="justifikasi" id="justifikasi"  style="display:none;"></div>
                        </form>
                    </div>

                    {{-- END IKLAN --}}
                    {{-- START SENARAI PETENDER --}}
                    <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <br>
                                    <livewire:frontend.senarai-petender-table />
                                    <br>
                                    <br>
                                </div>
                            </div>

                        </div>
                      </div>
                    {{-- END SENARAI PETENDER --}}
                </div><!-- End Default Tabs -->

          </div><!-- End Default Tabs -->
        </div>
      </div>
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

    // condition for muat naik draf iklan
    if (mohon.dokumen_muatnaik == null || mohon.dokumen_muatnaik == '') {
        document.getElementById("muatturun").hidden = true;
        document.getElementById("muatnaik").hidden = false;
    } else {
        document.getElementById("muatturun").hidden = false;
        document.getElementById("muatnaik").hidden = true;
    }
    // delete uploaded file iklan
    function deletelist(id) {
        Swal.fire({
            title: "Adakah Anda Pasti Untuk Hapuskan Fail Ini ?",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            icon: 'warning'
        }).then((result) => {

            if (result.value) {
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

                        console.log("File deleted");
                    }
                });
            }
        });
    }
    // end delete uploaded file

    // delete uploaded file addendum
    function deleteaddendum(id, iklan_id) {
        console.log([id, iklan_id]);
        Swal.fire({
            title: "Adakah Anda Pasti Untuk Hapuskan Fail Ini ?",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            reverseButtons: true,
            icon: 'warning'
        }).then((result) => {

            if (result.value) {
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: "deleteaddendum/",
                    type: 'post',
                    data: {
                        "id": id,
                        "iklan_id": iklan_id,
                        "_token": token,
                    },
                    success: function (response) {
                        let addendum = document.getElementById('fail_addendum');
                        addendum.innerHTML = '';
                        response.forEach(element => {
                            addendum.innerHTML += `
                                <div class="ml-5"><a href="` + element.dokumen + `" target="_blank">` + element
                                .dokumen +
                                `</a>
                                <i class="mdi mdi-minus-circle" style="color: red; font-size:24px;" onclick="deleteaddendum(` +
                                element.id + `, ` + element.iklan_perolehan_id +
                                `)" data-id="` + element.id + `"></i></div>`;
                        });
                    }
                });
            }
        });
    }
    // end delete uploaded file addendum

    //tarikh mula jual
    var date = data['tarikh_mula_jual'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_mula_jual = year + '-' + month + '-' + day;
    $('#tarikh_mula_jual').val(tarikh_mula_jual);
    document.getElementsByName("tarikh_mula_jual")[0].setAttribute('min', tarikh_mula_jual);

    //tarikh_akhir_jual
    var date = data['tarikh_akhir_jual'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_akhir_jual = year + '-' + month + '-' + day;
    $('#tarikh_akhir_jual').val(tarikh_akhir_jual);
    document.getElementsByName("tarikh_akhir_jual")[0].setAttribute('min', tarikh_mula_jual);
    $('#tarikh_tutup').val(tarikh_akhir_jual);

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

    //tarikh_waktu_tutup
    var date = data['tarikh_waktu_tutup'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_waktu_tutup = year + '-' + month + '-' + day;
    $('#tarikh_tutup').val(tarikh_waktu_tutup);
    document.getElementsByName("tarikh_tutup")[0].setAttribute('min', tarikh_mula_jual);

    //tarikh_jangka_iklan
    var date = mohon['tarikh_jangka_iklan'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_jangka_iklan = day + '/' + month + '/' + year;
    $('#tarikh_jangka_iklan').val(tarikh_jangka_iklan);

    //tarikh_keluar_iklan
    var date = data['tarikh_keluar_iklan'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_keluar_iklan = year + '-' + month + '-' + day;
    $('#tarikh_keluar_iklan').val(tarikh_keluar_iklan);

    //onchange tarikh mula jual
    function datestart(e){
        var now1 = new Date(e.target.value);
        var now = new Date(now1.setDate(now1.getDate() + 20));
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today1 = now.getFullYear() + "-" + (month) + "-" + (day);
        $('#tarikh_akhir_jual').val(today1);
        var tarikhkeluariklan = document.getElementById("tarikh_keluar_iklan").value;
        document.getElementsByName("tarikh_mula_jual")[0].setAttribute('min', tarikhkeluariklan);
        document.getElementsByName("tarikh_akhir_jual")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('min', e.target.value);
        document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('max', today1);
        $('#tarikh_lawatan_tapak').val('');
        $('#tarikh_tutup').val(today1);
        document.getElementsByName("tarikh_tutup")[0].setAttribute('min', e.target.value);
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
        $('#tarikh_tutup').val(today1);
        $('#tarikh_lawatan_tapak').val('');
    }

    function checkingButton() {
        lawatan_tapak = document.getElementById('lawatan_tapak').value;
        if (lawatan_tapak == 'TIDAK_WAJIB') {
            $('#tarikh_lawatan_tapak').val('');
            document.getElementById('tarikh_lawatan_tapak').disabled = true;
        } else {
            if(data['tarikh_lawatan_tapak']) {
                document.getElementById('tarikh_lawatan_tapak').disabled = false;
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
                document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('min', document.getElementById('tarikh_mula_jual').value);
                document.getElementsByName("tarikh_lawatan_tapak")[0].setAttribute('max', document.getElementById('tarikh_akhir_jual').value);
                document.getElementById('tarikh_lawatan_tapak').disabled = false;
            }
        }

        taklimat_tender = document.getElementById('taklimat_tender').value;
        if (taklimat_tender == 'TIDAK_WAJIB') {
            $('#tarikh_taklimat_tender').val('');
            document.getElementById('tarikh_taklimat_tender').disabled = true;
        } else {
            if(data['tarikh_taklimat_tender']) {
                document.getElementById('tarikh_taklimat_tender').disabled = false;
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
                document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('min', document.getElementById('tarikh_mula_jual').value);
                document.getElementsByName("tarikh_taklimat_tender")[0].setAttribute('max', document.getElementById('tarikh_akhir_jual').value);
                document.getElementById('tarikh_taklimat_tender').disabled = false;
            }
        }
    }
    //harga dokumen tender
    $('#harga_dokumen').mask('0, 000, 000, 000, 000, 000, 000.00', {
        reverse: true
    }); //quintillion

    function upload() {
        document.getElementById('dokumen').click();
    }
    // declare for display list upload dokumen
    var selDiv1 = "";
    document.addEventListener("DOMContentLoaded", init, false);
    var selDiv = "";
    document.addEventListener("DOMContentLoaded", init, false);
    var selDiv2 = "";
    document.addEventListener("DOMContentLoaded", init, false);

    function init() {
        selDiv = document.querySelector("#selectedFilesIklan");
        selDiv1 = document.querySelector("#selectedFilesTender");
        document.querySelector('#dokumen').addEventListener('change', handleFileSelectBatalDokumen, false);
        selDiv2 = document.querySelector("#selectedFiles_dokumen");
    }

    function handleFileSelectBatalDokumen(e) {
        if(!e.target.files) return;
        document.getElementById('selectedFiles_dokumen').innerHTML = "";
        var files = e.target.files;
        for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('a');
            li.setAttribute('id','file'+i);
            var f = files[i];
            li.innerHTML= f.name;
        }
        document.getElementById('selectedFiles_dokumen').appendChild(li);

    }
    // start show file dokumen iklan
    function handleFileSelectIklan(e) {
        if (!e.target.files) return;
        selDiv1 = document.querySelector("#selectedFilesTender");
        selDiv.innerHTML = "";

        var saiz = e.target.files[0].size / 1024 / 1024;
        if (saiz > 10) {
            Swal.fire({
                title: "Fail yang dipilih melebihi 10MB. Sila pilih semula.",
                icon: 'info'
            });
            var fileIklan = document.getElementById("fileIklan");
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
            document.getElementById('selectedFilesIklan').appendChild(ul);
            document.getElementById('hantar').disabled = false;
            document.getElementById('draf').disabled = false;
        }
    }
    // end file dokumen iklan

    // start show file dokumen tender
    function handleFileSelect(e) {
        var ul = document.createElement('ul');
        if (!e.target.files) return;
        selDiv1.innerHTML = "";
        var files = e.target.files;
        for (var i = 0; i < files.length; i++) {
            var count = i;
            var li = document.createElement('li');
            li.setAttribute('id', 'file' + i);
            var f = files[i];
            li.innerHTML = f.name;
            ul.appendChild(li);
        }
        document.getElementById('selectedFilesTender').appendChild(ul);
        document.getElementById('hantar').disabled = false;
        document.getElementById('draf').disabled = false;
    }
    // end file dokumen tender

    // start show file addendum
    function handleFileSelectAddendum(e) {
        if (!e.target.files) return;
        var selDiv2 = document.getElementById('selectedFilesAddendum');
        selDiv2.innerHTML = "";
        var saiz = e.target.files[0].size / 1024 / 1024;
        if (saiz > 10) {
            Swal.fire({
                title: "Fail yang dipilih melebihi 10MB. Sila pilih semula.",
                icon: 'info'
            });
            var oldInput = document.getElementById("fileAddendum");
            var newInput = document.createElement("input");
            newInput.type = "file";
            newInput.id = oldInput.id;
            newInput.name = oldInput.name;
            newInput.className = oldInput.className;
            newInput.accept = oldInput.accept;
            newInput.onchange = oldInput.onchange;
            newInput.style.cssText = oldInput.style.cssText;
            oldInput.parentNode.replaceChild(newInput, oldInput);
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
            document.getElementById('selectedFilesAddendum').appendChild(ul);
            document.getElementById('hantar').disabled = false;
            document.getElementById('draf').disabled = false;
        }
    }
    // end file addendum

    $( "form" ).submit(function( event ) {
        event.preventDefault();
        if(document.activeElement.value == 'hantar'){
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Hantar ?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.isConfirmed == true) {
                    document.getElementById("status").value = 'hantar';
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                    document.getElementById('Batal').disabled = false;
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
                if (result.isConfirmed == true) {
                    document.getElementById("status").value = 'draf';
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                    document.getElementById('Batal').disabled = false;
                }
            });
        } else if(document.activeElement.value == 'Batal'){
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Membatalkan ?",
                html: "<label class='form-label'>Justifikasi :</label><br><textarea class='form-control' id='input_justifikasi' style='height: 120px'></textarea><br><input type='button' class='btn btn-outline-primary' value='Muat Naik Dokumen' onclick='upload()' style='width:100%;'/><div id='selectedFiles_dokumen' name='selectedFiles_dokumen' style='width:100%; margin-top:3%;'></div>",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                allowOutsideClick: false,
                preConfirm: () => {
                    if (document.getElementById('input_justifikasi').value) {
                        // Handle return value
                    } else {
                        Swal.showValidationMessage('Isi justifikasi')
                    }
                }
            }).then((result) => {
                if (result.isConfirmed == true) {
                    document.getElementById("justifikasi").value = document.getElementById('input_justifikasi').value;
                    document.getElementById("status").value = 'Batal';
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                    document.getElementById('Batal').disabled = false;
                }
            });
        }
    });

    $(document).ready(

        function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const data2 = urlParams.get('data2')
            if(@JSON(session('data2')) != null || data2 != null)
                {
                    document.getElementById("profile-tab").click();
                }
            document.getElementById('gred').value = data.grade_id;
            $("#wait").css("display", "block");
            // $("#body").css({"overflow: hidden"})
            $("div.spanner").addClass("show");
            setTimeout(function(){
                $("#wait").css("display", "none");
                $("div.spanner").removeClass("show");
            }, 5000);
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

                                // create new column for delete - row 1 col 1
                                var col_remove = document.createElement("DIV");
                                col_remove.className = 'col-lg-1';

                                // Create a Remove Button.
                                var btnRemove = document.createElement("LABEL");
                                btnRemove.innerHTML =
                                    `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                btnRemove.onclick = function () {
                                    dvContainer.removeChild(this.parentNode.parentNode);
                                };

                                // insert remove button into delete column.
                                col_remove.appendChild(btnRemove);

                                // create new column for dropdown Bidang. row 1 col 2
                                var colBidang = document.createElement("DIV");
                                colBidang.className = 'col-lg-6';
                                colBidang.style.cssText = 'margin-top:20px; margin-bottom:10px;';
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
                                // row.appendChild(col_remove);
                                row.appendChild(colBidang);
                                row.appendChild(colSub);
                                dvContainerBidang.appendChild(row);
                                // counter bidang + subbidang
                                // document.getElementById('counterbidang').value = bidang_data.length;
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
                                            //remove same value

                                            // if (response[0][j].id === bidang_sub[i][0].sub_bidang_id){
                                            //     response[0].splice(j, 1);
                                            // }

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

                                        $('#' + subbidang).prop('disabled', true);

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
                                            // document.getElementById(subbidang.toString()).disabled = false;
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

                            // create new column for delete - row 1 col 1
                            var col_remove = document.createElement("DIV");
                            col_remove.className = 'col-lg-1';

                            // Create a Remove Button.
                            var btnRemove = document.createElement("LABEL");
                            btnRemove.innerHTML =
                                `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                            btnRemove.onclick = function () {
                                kategori_kelas.removeChild(this.parentNode.parentNode);
                            };

                            // insert remove button into delete column.
                            col_remove.appendChild(btnRemove);

                            // create new column for dropdown Bidang. row 1 col 2
                            var colKelas = document.createElement("DIV");
                            // colKelas.className = 'col-lg-6';
                            colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px;';
                            colKelas.appendChild(ddlKelas);

                            $('#kelas' + kd).val(kelas_data[kd].kelas_id);

                            // create new column for dropdown sub Bidang. row 1 col 3
                            var colKhusus = document.createElement("DIV");
                            var name = "khusus" + kd + "[]";
                            var id = "khusus" + kd;
                            // colKhusus.className = 'col-lg-6';
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
                            // document.getElementById('counterkelas').value = kelas_data.length;
                            $('#kelas' + kd).select2();
                            $('#kelas' + kd).prop('disabled', true);

                            //display selected pengkhususan
                            var id_kelas = kelas_data[kd].kelas_id;
                            $.ajax({
                                url: '/sisdant/editpermohonansah/pengkhususan/' + id_kelas,
                                type: 'get',
                                dataType: 'json',
                                success: function (response) {
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

                                        //remove same value
                                        // if (response[0][m].id === data_khusus[kd][0].khusus.id){
                                        //     response[0].splice(m, 1);
                                        // }

                                        var id_list = response[0][m].id;
                                        var nama_list = response[0][m].pengkhususan;
                                        var kod_list = response[0][m].kod;
                                        $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                            "</option>");
                                    }
                                    $('#' + khusus).prop('disabled', true);



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
                                var dvContainerKelas = document.getElementById("dvContainerPukonsa");

                                // create new row
                                var row_k = document.createElement("DIV");
                                row_k.className = 'row';

                                // create new column for delete - row 1 col 1
                                var col_remove = document.createElement("DIV");
                                col_remove.className = 'col-lg-1';

                                // Create a Remove Button.
                                var btnRemove = document.createElement("LABEL");
                                btnRemove.innerHTML =
                                    `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                btnRemove.onclick = function () {
                                    dvContainer.removeChild(this.parentNode.parentNode);
                                };

                                // insert remove button into delete column.
                                col_remove.appendChild(btnRemove);

                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.className = 'col-lg-6';
                                colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px;';
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
                                dvContainerKelas.appendChild(row_k);
                                // counter kelas + khusus
                                // document.getElementById('counterpukonsa').value = pukonsa_data.length;
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

                                            //remove same value
                                            // if (response[0][m].id === data_pukonsa[kd][0].khusus.id){
                                            //     response[0].splice(m, 1);
                                            // }

                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].keterangan;
                                            var kod_list = response[0][m].tajuk_kecil;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                        }

                                        $('#' + khusus).prop('disabled', true);

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
                                var dvContainerKelas = document.getElementById("dvContainerUpkj");

                                // create new row
                                var row_k = document.createElement("DIV");
                                row_k.className = 'row';

                                // create new column for delete - row 1 col 1
                                var col_remove = document.createElement("DIV");
                                col_remove.className = 'col-lg-1';

                                // Create a Remove Button.
                                var btnRemove = document.createElement("LABEL");
                                btnRemove.innerHTML =
                                    `<i class="mdi mdi-minus-circle" style="color: red; font-size:24px;margin-left:30px;"></i>`;
                                btnRemove.onclick = function () {
                                    dvContainer.removeChild(this.parentNode.parentNode);
                                };

                                // insert remove button into delete column.
                                col_remove.appendChild(btnRemove);

                                // create new column for dropdown Bidang. row 1 col 2
                                var colKelas = document.createElement("DIV");
                                colKelas.className = 'col-lg-6';
                                colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px;';
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
                                dvContainerKelas.appendChild(row_k);
                                // counter kelas + khusus
                                // document.getElementById('counterupkj').value = upkj_data.length;
                                $('#tajukupkj' + kd).select2();
                                $('#tajukupkj' + kd).prop('disabled', true);


                                // display selected pengkhususan
                                // console.log(upkj_data[kd].kelas_id);
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

                                            //remove same value
                                            // if (response[0][m].id === data_upkj[kd][0].khusus.id){
                                            //     response[0].splice(m, 1);
                                            // }

                                            var id_list = response[0][m].id;
                                            var nama_list = response[0][m].keterangan;
                                            var kod_list = response[0][m].tajuk_kecil;
                                            $('#' + khusus).append("<option value='" + id_list + "'>" + kod_list + ' - ' + nama_list +
                                                "</option>");
                                        }

                                        $('#' + khusus).prop('disabled', true);

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
                    })
            })
        }
    );
      </script>
    </section>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.nav-list a').removeClass('active');
    }, false);

    $("document").ready(function(){
            var local = window.location.origin;
            var url = "/tunas/senaraiiklanbelumtutup";
            $('.link[href="'+url+'"]').addClass('active');
        });
</script>

@endsection
