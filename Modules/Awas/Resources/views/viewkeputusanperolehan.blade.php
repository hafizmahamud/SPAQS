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
    <ul style="width: 15%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation" >
            <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                aria-selected="false">Keputusan</button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabjustifiedContent">
        {{-- START KEPUTUSAN --}}
        <div class="card">
            <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Laporan Tender Dikemukakan ke Lembaga Perolehan </label>
                        <div>
                            <input class="form-control" type="date" id="tarikh_laporan" name="tarikh_laporan"  readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Bil Mesyuarat Lembaga Perolehan</label>
                        <div>
                            <input class="form-control" type="text" id="bil_mesyuarat" name="bil_mesyuarat"  readonly>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Mesyuarat Lembaga Perolehan </label>
                        <div>
                            <input class="form-control" type="date"  id="tarikh_mesyuarat" name="tarikh_mesyuarat" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Keputusan Lembaga Perolehan </label>
                        <div>
                            <input class="form-control" type="date"  id="tarikh_keputusan" name="tarikh_keputusan" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Terima Keputusan Lembaga Perolehan </label>
                        <div>
                            <input class="form-control" type="date"  id="tarikh_terima" name="tarikh_terima" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Edar Keputusan</label>
                        <div>
                            <input class="form-control" type="date"  id="tarikh_edar" name="tarikh_edar" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;"> Keputusan Lembaga Perolehan </label>
                        <div>
                            <input class="form-control" type="text"  id="keputusan" name="keputusan"  readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Nombor Rujukan </label>
                        <div class="row mb-3">
                            <input type="text" class="form-control" id="no_rujukan_ep" name="no_rujukan_ep" min="1" onclick="success()"  style=" margin-left:10px; margin-right:5px;" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Harga</label>
                        <div>
                            <input class="form-control" type="text" id="harga" name="harga" readonly>
                        </div>
                        <label class="form-label" style="font-weight: bold; margin-top:10px;">Tempoh </label>
                        <div>
                            <input class="form-control" type="text" id="tempoh" name="tempoh" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Catatan PBM (Jika Ada)</label>
                        <div>
                            <textarea class="form-control" style="height: 120px;" name="catatan" id="catatan" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-form" style="margin-bottom: 50px;">
            <button class="btn btn-outline-primary"
                style="width: 10%; margin-right: 10px; border: none; background: none; padding: 0; color: blue; text-align: right;"
                onclick="history.back()">Kembali</button>
        </div>
    </div>

</section>

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script>

    var dataPenilaian = @json($dataPenilaian);
    $(document).ready(function () {

        var tarikh_laporan = dataPenilaian['tarikh_laporan_tender'].split(" ")[0];
            tarikh_laporan = tarikh_laporan.split("-")[0] + '-' + tarikh_laporan.split("-")[1] + '-' + tarikh_laporan.split("-")[2];
        $('#tarikh_laporan').val(tarikh_laporan);

        var tarikh_mesy_lembaga = dataPenilaian['tarikh_mesy_lembaga'].split(" ")[0];
            tarikh_mesy_lembaga = tarikh_mesy_lembaga.split("-")[0] + '-' + tarikh_mesy_lembaga.split("-")[1] + '-' + tarikh_mesy_lembaga.split("-")[2];
        $('#tarikh_mesyuarat').val(tarikh_mesy_lembaga);

        var tarikh_mesy_lembaga = dataPenilaian['tarikh_mesy_lembaga'].split(" ")[0];
            tarikh_mesy_lembaga = tarikh_mesy_lembaga.split("-")[0] + '-' + tarikh_mesy_lembaga.split("-")[1] + '-' + tarikh_mesy_lembaga.split("-")[2];
        $('#tarikh_mesyuarat').val(tarikh_mesy_lembaga);

        var tarikh_result = dataPenilaian['tarikh_result'].split(" ")[0];
            tarikh_result = tarikh_result.split("-")[0] + '-' + tarikh_result.split("-")[1] + '-' + tarikh_result.split("-")[2];
        $('#tarikh_keputusan').val(tarikh_result);

        var tarikh_terima_result = dataPenilaian['tarikh_terima_result'].split(" ")[0];
            tarikh_terima_result = tarikh_terima_result.split("-")[0] + '-' + tarikh_terima_result.split("-")[1] + '-' + tarikh_terima_result.split("-")[2];
        $('#tarikh_terima').val(tarikh_terima_result);

        var tarikh_edar_result = dataPenilaian['tarikh_edar_result'].split(" ")[0];
            tarikh_edar_result = tarikh_edar_result.split("-")[0] + '-' + tarikh_edar_result.split("-")[1] + '-' + tarikh_edar_result.split("-")[2];
        $('#tarikh_edar').val(tarikh_edar_result);

        if(dataPenilaian['tempoh']){
            $('#tempoh').val(dataPenilaian['tempoh']);
            document.getElementById("tempoh").removeAttribute("disabled");
        }

        if(dataPenilaian['harga']){
            $('#harga').val("RM "+dataPenilaian['harga']);
            document.getElementById("harga").removeAttribute("disabled");
        }
        $('#no_rujukan_ep').val(dataPenilaian['no_rujukan']);

        $('#catatan').val(dataPenilaian['catatan']);
        $('#bil_mesyuarat').val(dataPenilaian['bil_mesy']);
        $('#keputusan').val(dataPenilaian['nama_syarikat']);

    });

</script>
<style>
    .span6 label,
    .span6 input {
        display: inline-block;
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

</style>
@endsection
