<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Butiran Keputusan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
    <section class="section">
        <div class="spanner">
            <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
            </div>
        </div>
        <ul style="width: 30%; background: white;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
            @if($no_perolehan->kategori_iklan_id == 1)
            <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
                <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Keputusan</button>
            </li>
            @else
            <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                    aria-selected="true">Penilaian</button>
            </li>
            @endif
        </ul>

        <!-- Default Tabs -->
        <div class="tab-content pt-2" id="myTabjustifiedContent">
            {{-- START PENILAIAN --}}
            @if($no_perolehan->kategori_iklan_id != 1)
            <form id="myForm" autocomplete="off" method="post" novalidate action="{{ url('/awas/savepenilaian') }}"
            enctype="multipart/form-data">
            @csrf
                <div class="card">
                    <div class="tab-pane fade show active" id="home-justified" role="tabpanel"
                        aria-labelledby="home-tab">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">No Tender</label>
                                <div>
                                    <input class="form-control" type="text" value="{{$no_perolehan->no_perolehan}}"
                                        name="no_perolehan" id="no_perolehan" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Nama Projek</label>
                                <div>
                                    <textarea class="form-control" name="tajuk_perolehan" id="tajuk_perolehan" style="height: 80px;" readonly>{{$no_perolehan->tajuk_perolehan}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Ketua Penilai<a
                                        style="color: red;">*</a></label>
                                <div>
                                    <select class="form-select" name="ketua_penilai" id="ketua_penilai"
                                        onchange="success()" value="{{ old('ketua_penilai') }}" required>
                                        <option value="">Sila Pilih</option>
                                        @foreach ($getListKP as $pegawai)
                                        <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Tutup Tender</label>
                                <div>
                                    <input type="date" name="tarikh_tutup_tender" id="tarikh_tutup_tender"
                                        class="form-control" value="{{ $year }}-{{ $month }}-{{ $day }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Pegawai Penilai 1<a
                                        style="color: red;">*</a></label>
                                <div>
                                    <select class="form-select" name="peg_penilai_1" id="peg_penilai_1"
                                        onchange="success()" required>
                                        <option value="">Sila Pilih</option>
                                        @foreach ($getListPP1 as $penilai)
                                        <option value="{{ $penilai->id }}">
                                            {{ $penilai->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-3">
                                <label class="form-label" style="font-weight: bold;">Tempoh Sah Laku Tender (Hari)<a
                                        style="color: red;">*</a></label>
                                <div class="control-group span6">
                                    <input type="number" min="1" value="90" class="form-control" name="tempoh_sah_laku"
                                        id="tempoh_sah_laku" onchange="success()" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" style="font-weight: bold;" hidden>Tempoh Sah Laku Tender
                                    (Hari)<a style="color: red;" hidden>*</a></label>
                                <div class="control-group span6">
                                    <input class="form-control" name="#" id="#" type="text" hidden />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Pegawai Penilai 2<a
                                        style="color: red;">*</a></label>
                                <div>
                                    <select class="form-select" name="peg_penilai_2" id="peg_penilai_2"
                                        onchange="success()" required>
                                        <option value="">Sila Pilih</option>
                                        @foreach ($getListPP2 as $penilai)
                                        <option value="{{ $penilai->id }}">{{ $penilai->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label" style="font-weight: bold;">Tarikh Tamat Sah Laku Tender<a style="color: red;">*</a></label>
                                <div>
                                    <input type="date" class="form-control" id="tarikh_serah_dokumen"
                                        name="tarikh_serah_dokumen" value="{{ $yearSDT }}-{{ $monthSDT }}-{{ $daySDT }}"
                                        onchange="success()" readonly>
                                </div>`
                            </div>

                            <div class="col-md-3">
                                <label class="form-label" style="font-weight: bold;" hidden>Tempoh Sah Laku Tender
                                    (Hari)<a style="color: red;" hidden>*</a></label>
                                <div class="control-group span6">
                                    <input class="form-control" name="#" id="#" type="text" hidden />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Penyedia<a
                                        style="color: red;">*</a></label>
                                <div>
                                    <select class="form-select" name="penyedia" id="penyedia" onchange="success()"
                                        required>
                                        <option value="">Sila Pilih</option>
                                        @foreach ($getListPenyedia as $penyedia)
                                        <option value="{{ $penyedia->id }}">{{ $penyedia->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="button-form">
                    <button class="btn btn-primary" id="open" data-toggle="modal" href="#myModal1" data-backdrop="false"
                        style="width: 10%;" onclick="return false;" disabled>Hantar</button>
                    <button class="btn btn-success" id="draf" name="simpan" type="submit" value="draf"
                        style="width: 10%;" disabled>Simpan</button>
                    <button class="btn btn-outline-primary"
                        style="width: 10%; margin-right: 10px; border: none; background: none; padding: 0; color: blue;"
                        onclick="history.back()">Kembali</button>
                    <input class="form-control" type="text" id="status" name="status" style="display:none;">
                    <input class="form-control" type="text" name="id_perolehan" value="{{ $no_perolehan->id_perolehan }}"
                        style="display:none;">
                </div>
            </form>
            @endif
            {{-- END PENILAIAN --}}
            {{-- START KEPUTUSAN MANUAL --}}
            @if($no_perolehan->kategori_iklan_id == 1)
            <form id="myFormPerolehan" autocomplete="off" method="post" novalidate action="{{ url('/awas/savekeputusanperolehan') }}"
            enctype="multipart/form-data" >
            @csrf
                <div class="card">
                    <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Laporan Tender Dikemukakan ke Lembaga Perolehan </label>
                                <div>
                                    <input class="form-control" type="date" style="width: 50%;" id="tarikh_laporan" name="tarikh_laporan" onchange="success_keputusan()" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Bil Mesyuarat Lembaga Perolehan</label>
                                <div>
                                    <input class="form-control" type="text" id="bil_mesyuarat" name="bil_mesyuarat" style="width: 50%;" onchange="success_keputusan()" >
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Mesyuarat Lembaga Perolehan </label>
                                <div>
                                    <input class="form-control" type="date" style="width: 50%;"  id="tarikh_mesyuarat" name="tarikh_mesyuarat" onchange="success_keputusan()">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Keputusan Lembaga Perolehan </label>
                                <div>
                                    <input class="form-control" type="date" style="width: 50%;"  id="tarikh_keputusan" name="tarikh_keputusan" onchange="success_keputusan()">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Terima Keputusan Lembaga Perolehan </label>
                                <div>
                                    <input class="form-control" type="date" style="width: 50%;"  id="tarikh_terima" name="tarikh_terima" onchange="success_keputusan()">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Edar Keputusan</label>
                                <div>
                                    <input class="form-control" type="date" style="width: 50%;"  id="tarikh_edar" name="tarikh_edar" onchange="success_keputusan()">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;"> Keputusan Lembaga Perolehan </label>
                                <div>
                                    <input class="form-control" type="text"  id="keputusan" name="keputusan" style="width: 50%;" onchange="success_keputusan()">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Nombor Rujukan </label>
                                <div class="row mb-3">
                                    <input type="number" class="form-control" id="no_rujukan_ep" name="no_rujukan_ep" min="1" onchange="success_keputusan()"  style="width:10%; margin-left:10px; margin-right:5px;">
                                    <input type="text" class="form-control" value="P.P.S (s) 15/2011 Jld. " style="font-size: 12px; font-weight: bolder; border: none; border-color: transparent; width:20%; margin-right:5px;" readonly>
                                    <input type="number" class="form-control" id="no_rujukan_ep1" name="no_rujukan_ep1" min="1" onchange="success_keputusan()" style="width:10%;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Harga</label>
                                <div>
                                    <span class="input-symbol-euro">
                                        <input class="form-control" type="text" id="harga" name="harga" onchange="success_keputusan()" disabled>
                                    </span>
                                </div>
                                <label class="form-label" style="font-weight: bold; margin-top:10px;">Tempoh </label>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <input class="form-control" type="number" id="tempoh" name="tempoh" onchange="success_keputusan()" disabled>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="form-select" type="text" id="bulan_minggu" name="bulan_minggu"  onchange="success_keputusan()" disabled>
                                            <option value="">SILA PILIH</option>
                                            <option value="BULAN">BULAN</option>
                                            <option value="MINGGU">MINGGU</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Catatan PBM (Jika Ada)</label>
                                <div>
                                    <textarea class="form-control" style="height: 120px;" name="catatan" id="catatan" onchange="success_keputusan()"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-form">
                    <button class="btn btn-primary" id="hantar_keputusan" style="width: 10%;" type="submit" disabled>Hantar</button>
                    <button class="btn btn-success" id="draf_keputusan" type="submit" value="draf" style="width: 10%;" >Simpan</button>
                    <button class="btn btn-outline-primary"
                        style="width: 10%; margin-right: 10px; border: none; background: none; padding: 0; color: blue;"
                        onclick="history.back()">Kembali</button>
                    <input class="form-control" type="text" id="status_perolehan" name="status_perolehan" style="display:none;">
                    <input class="form-control" type="text" name="id" value="{{ $no_perolehan->id_perolehan }}"
                        style="display:none;">
                </div>
            </form>
            @endif
            {{-- END KEPUTUSAN MANUAL --}}
        </div>
    </section>

<div class="modal" id="myModal1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center">Butiran Memo Lantikan Penilai</h5>
                <div class="pull-right">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="container">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="no_rujukan" style="font-weight: bold;" class="col-sm-4 col-form-label">Nombor
                            Rujukan<a style="color: red;">*</a></label>
                        <div class="col-sm-2">
                            <input type="number" form="myForm" class="form-control" id="no_rujukan" name="no_rujukan"
                                min="1" onclick="successmodal()" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="P.P.S (s) 15/2011 Jld. "
                                style="font-size: 12px; font-weight: bolder; border: none; border-color: transparent;"
                                readonly>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" form="myForm" class="form-control" id="no_rujukan1" name="no_rujukan1"
                                min="1" onclick="successmodal()" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tarikh_penilaian" style="font-weight: bold;" class="col-sm-4 col-form-label">Tarikh
                            Terima DT<a style="color: red;">*</a></label>
                        <div class="col-sm-4">
                            <input type="date" form="myForm" class="form-control" id="tarikh_sah_laku"
                                name="tarikh_sah_laku" onclick="successmodal()" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="hari" style="font-weight: bold;" class="col-sm-4 col-form-label">Tempoh
                            Sedia LT<a style="color: red;">*</a></label>
                        <div class="col-sm-4">
                            <select form="myForm" id="tempoh_sedia_lt" name="tempoh_sedia_lt" class="form-select" onclick="successmodal()"
                                required>
                                <option value="">Sila Pilih</option>
                                <option value="14">14 Hari</option>
                                <option value="30">30 Hari</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" form="myForm" name="hantar" type="submit" id="hantar" value="hantar"
                    onclick="simpanpenilaian()" disabled>Hantar</button>
                <input class="form-control" type="text" id="status" name="status" style="display:none;">
                <input class="form-control" type="text" name="id_perolehan" value="{{ $no_perolehan->id_perolehan }}"
                    style="display:none;">
            </div>
        </div>
    </div>

</div>
<style>
    .span6 label,
    .span6 input {
        display: inline-block;
    }

    .modal {
        background-color: rgb(190, 190, 190, 0.8);
    }

    button.new-button:focus {
        outline: none;
    }

    .input-symbol-euro {
        position: relative;
    }
    .input-symbol-euro input {
        margin-left:5%;
        width:45%;
    }
    .input-symbol-euro:after {
        position: absolute;
        top: 5px;
        content:"RM";
        font-weight: bold;
    }

    .spanner, .overlay {
      opacity: 100!important;
    }
</style>

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    $('.nav-list a').removeClass('active');
	}, false);

  $("document").ready(function(){


        var local = window.location.origin;
        url = "/awas/keputusan";
		$('.link[href="'+url+'"]').addClass('active');
	});
</script>
<script>
    function success() {
        var tempoh_sah_laku = document.getElementById("tempoh_sah_laku").value;
        var ketua_penilai = document.getElementById("ketua_penilai").value;
        var peg_penilai_1 = document.getElementById("peg_penilai_1").value;
        var peg_penilai_2 = document.getElementById("peg_penilai_2").value;
        var penyedia = document.getElementById("penyedia").value;
        var tarikh_serah_dokumen = document.getElementById('tarikh_serah_dokumen').value;
        var tarikh_tutup_tender = document.getElementById('tarikh_tutup_tender').value;

        if (tempoh_sah_laku && ketua_penilai && peg_penilai_1 && peg_penilai_2 && penyedia &&
            tarikh_serah_dokumen && tarikh_tutup_tender) {
            document.getElementById('open').disabled = false;
            document.getElementById('draf').disabled = false;

        } else {
            document.getElementById('open').disabled = true;
            document.getElementById('draf').disabled = true;
        }

        // define variable
        function addDays(date, days) {
            const copy = new Date(Number(date))
            copy.setDate(date.getDate() + days)

            return copy
        }

        var myDate = new Date(new Date(tarikh_tutup_tender).getTime() + (tempoh_sah_laku * 24 * 60 * 60 * 1000));

        // Create new Date instance
        const dateSS = new Date(tarikh_tutup_tender);
        const newDateSS = addDays(dateSS, tempoh_sah_laku);

        // convert min & max date format
        var dtMax = myDate;
        var dtMin = dateSS;

        var month = dtMin.getMonth() + 1;
        var day = dtMin.getDate();
        var year = dtMin.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var month1 = dtMax.getMonth() + 1;
        var day1 = dtMax.getDate();
        var year1 = dtMax.getFullYear();
        if (month1 < 10)
            month1 = '0' + month1.toString();
        if (day1 < 10)
            day1 = '0' + day1.toString();

        var minDate = year + '-' + month + '-' + day;
        var maxDate = year1 + '-' + month1 + '-' + day1;

        document.getElementById('tarikh_serah_dokumen').value = maxDate;

        // set min & max date input for Tarikh Pelantikan AJK Penilaian Tender
        $('#tarikh_sah_laku').attr('min', minDate);
        $('#tarikh_sah_laku').attr('max', maxDate);
    }

    function successmodal() {
        var no_rujukan = document.getElementById("no_rujukan").value;
        var no_rujukan1 = document.getElementById("no_rujukan1").value;
        var tarikh_sah_laku = document.getElementById("tarikh_sah_laku").value;
        var hari = document.getElementById("tempoh_sedia_lt").value;

        if (no_rujukan && no_rujukan1 && tarikh_sah_laku && hari) {
            document.getElementById('hantar').disabled = false;

        } else {
            document.getElementById('hantar').disabled = true;
        }
    }

    // datepicker can't select older date
    $(function () {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var minDate = year + '-' + month + '-' + day;

        $('#tarikh_penilaian').attr('min', minDate);
        $('#tarikh_sah_laku').attr('min', minDate);
    });

    function simpanpenilaian() {
        var check = document.getElementById('hantar').value;
        document.getElementById('status').value = check;
    }

    // simpan atau hantar
    $("form#myForm").submit(function (event) {
        event.preventDefault();
        if (document.activeElement.value == 'hantar') { // kalau hantar
            document.getElementById('status').value = document.activeElement.value;
            var check = document.getElementById('hantar').value;
            document.getElementById('status').value = check;
            Swal.fire({
                title: "Adakah anda pasti untuk menghantar rekod penilaian?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    document.getElementById("myForm").submit();
                    $('.close').click();
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });
        } else if (document.activeElement.value == 'draf') { // kalau simpan
            document.getElementById('status').value = document.activeElement.value;
            var check = document.getElementById('draf').value;
            document.getElementById('status').value = check;
            Swal.fire({
                title: "Adakah anda pasti untuk menyimpan rekod penilaian?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    document.getElementById("myForm").submit();
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                } else {
                    document.getElementById('hantar').disabled = false;
                    document.getElementById('draf').disabled = false;
                }
            });
        }
    });

    // untuk keputusan
    $('#harga').mask('0, 000, 000, 000, 000, 000, 000.00', {
        reverse: true
    });

    document.getElementById("tarikh_mesyuarat").disabled = "true";
    document.getElementById("tarikh_keputusan").disabled = "true";
    document.getElementById("tarikh_terima").disabled = "true";
    document.getElementById("tarikh_edar").disabled = "true";

    function success_keputusan() {
        var tarikh_laporan = document.getElementById("tarikh_laporan").value;
        var tarikh_mesyuarat = document.getElementById("tarikh_mesyuarat").value;
        var tarikh_keputusan = document.getElementById("tarikh_keputusan").value;
        var tarikh_terima = document.getElementById("tarikh_terima").value;
        var tarikh_edar = document.getElementById("tarikh_edar").value;
        var bil_mesyuarat = document.getElementById("bil_mesyuarat").value;
        var keputusan = document.getElementById("keputusan").value;
        var harga = document.getElementById("harga").value;
        var tempoh = document.getElementById("tempoh").value;
        var bulan_minggu = document.getElementById("bulan_minggu").value;
        var no_rujukan_ep = document.getElementById("no_rujukan_ep").value;
        var no_rujukan_ep1 = document.getElementById("no_rujukan_ep1").value;




        if(tarikh_laporan && tarikh_mesyuarat && tarikh_keputusan && tarikh_terima && tarikh_edar && no_rujukan_ep && no_rujukan_ep1 && bil_mesyuarat && keputusan && harga && tempoh && bulan_minggu ) {
            document.getElementById("hantar_keputusan").removeAttribute("disabled");
        } else {
            document.getElementById('hantar_keputusan').disabled = true;
        }
    }

    $('#draf_keputusan').click(function() {
        event.preventDefault();
        var check = document.getElementById('draf_keputusan').value;
        document.getElementById('status_perolehan').value = check;
        Swal.fire({
                title: "Adakah anda pasti untuk menyimpan rekod keputusan?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    document.getElementById("myFormPerolehan").submit();
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                } else {
                    document.getElementById('hantar_keputusan').disabled = false;
                }
            });
    });

    $('#hantar_keputusan').click(function() {
        event.preventDefault();
        var check = document.getElementById('hantar_keputusan').value;
        document.getElementById('status_perolehan').value = check;
        Swal.fire({
                title: "Adakah anda pasti untuk menghantar rekod keputusan?",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                icon: 'question'
            }).then((result) => {
                if (result.value) {
                    document.getElementById("myFormPerolehan").submit();
                    $("#wait").css("display", "block");
                    $("div.spanner").addClass("show");
                } else {
                    document.getElementById('hantar_keputusan').disabled = false;
                }
            });
    });

    var data = @json($no_perolehan);
    var date = data['tarikh_jangka_iklan'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_laporan = year + '-' + month + '-' + day;

    $('#tarikh_laporan').attr('min', tarikh_laporan);

    $('#catatan').keyup(function(){
        this.value = this.value.toUpperCase();
        success_keputusan();
    });

    $('#keputusan').keyup(function(){
        this.value = this.value.toUpperCase();
        success_keputusan();
        if(this.value){
            document.getElementById("tempoh").removeAttribute("disabled");
            document.getElementById("harga").removeAttribute("disabled");
            document.getElementById("bulan_minggu").removeAttribute("disabled");
        } else {
            document.getElementById("tempoh").setAttribute("disabled");
            document.getElementById("harga").setAttribute("disabled");
            document.getElementById("bulan_minggu").setAttribute("disabled");
        }
    });

    $("#tarikh_laporan").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_mesyuarat').attr('min', selected);
        document.getElementById("tarikh_mesyuarat").removeAttribute("disabled");
    });

    $("#tarikh_mesyuarat").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_keputusan').attr('min', selected);
        document.getElementById("tarikh_keputusan").removeAttribute("disabled");
    });

    $("#tarikh_keputusan").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_terima').attr('min', selected);
        document.getElementById("tarikh_terima").removeAttribute("disabled");
    });

    $("#tarikh_terima").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_edar').attr('min', selected);
        document.getElementById("tarikh_edar").removeAttribute("disabled");
    });
</script>
@endsection
