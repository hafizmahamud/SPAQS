<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Butiran Penilaian dan Keputusan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
<section class="section">
    <ul style="width: 30%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"  style="width: 50%;"
                data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                aria-selected="true">Penilaian</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"  style="width: 50%;"
                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                aria-selected="false">Keputusan</button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabjustifiedContent">
        <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">No Tender</label>
                        <div>
                            <input class="form-control" type="text" value="{{$data->no_perolehan}}"
                                name="no_perolehan" id="no_perolehan" readonly>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Nama Projek</label>
                        <div>
                            <textarea class="form-control" value="{{$data->tajuk_perolehan}}"
                                readonly>{{$data->tajuk_perolehan}}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Ketua Penilai</label>
                        <div>
                            <input class="form-control" type="text" value="{{$getuserKP->name}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Tutup Tender</label>
                        <div>
                            <input type="text" name="tarikh_tutup_tender" id="tarikh_tutup_tender"
                                class="form-control"
                                value="{{\Carbon\Carbon::parse($dataIklan->tarikh_waktu_tutup)->format('d/m/Y')}}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Pegawai Penilai 1</label>
                        <div>
                            <input class="form-control" type="text" value="{{$getuserP1->name}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bold;">Tempoh Sah Laku Tender</label>
                        <div class="control-group span6">
                            <input class="form-control" type="text" value="{{$dataPenilaian->tempoh_sah_laku}} Hari"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bold;" hidden>Tempoh Sah Laku Tender
                            (Hari)<a style="color: red;" hidden>*</a></label>
                        <div class="control-group span6">
                            <input class="form-control" type="text" value="{{$dataPenilaian->tempoh_sah_laku}}"
                                hidden>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Pegawai Penilai 2</label>
                        <div>
                            <input class="form-control" type="text" value="{{$getuserP2->name}}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bold;">Tarikh Serah Dokumen Untuk
                            Penilaian</label>
                        <div>
                            <input class="form-control" type="text" value="{{$tarikhserahdokumen}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bold;" hidden>Tempoh Sah Laku Tender
                            (Hari)<a style="color: red;" hidden>*</a></label>
                        <div class="control-group span6">
                            <input class="form-control" name="tempoh_sahlaku" id="tempoh_sahlaku" type="text"
                                value="90" placeholder="90 Hari" hidden />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class=" form-label" style="font-weight: bold;">Penyedia</label>
                        <div>
                            <input class="form-control" type="text" value="{{$getuserP->name}}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h6 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Butiran
                    Memo Lantikan Penilai</h6>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label class="form-label" style="font-weight: bold;">Nombor Rujukan</label>
                        <div>
                            <input class="form-control" type="text" value="{{$dataPenilaian->no_rujukan}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label" style="font-weight: bold;">Tarikh Terima Laporan Tender
                        </label>
                        <div>
                            <input class="form-control" type="text"
                                value="{{\Carbon\Carbon::parse($dataPenilaian->tarikh_sah_laku)->format('d/m/Y')}}" readonly>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" style="font-weight: bold;">Tempoh Sedia Laporan Tender
                        </label>
                        <div>
                            <input class="form-control" type="text" value="{{$dataPenilaian->tempoh_sedia_lt}} Hari" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-form">
                <button class="btn btn-outline-primary"
                    style="width: 10%; margin-right: 10px; border: none; background: none; padding: 0; color: blue; text-align: right;"
                    onclick="history.back()">Kembali</button>
            </div>

        </div>
        {{-- END PENILAIAN --}}
        {{-- START KEPUTUSAN --}}
        <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card" id="card_syor" >
                <label class="form-label" style="font-weight: bold; margin-top:10px;">Senarai Pengesyoran :</label>
                <ol id="senarai_syor">
                    @foreach( $syor as $syor)
                        <li id="ul_{{$syor->syarikat}}">{{ $syor->syrikt['nama_syarikat']}}</li>
                    @endforeach
                </ol>
            </div>
            <div class="card">
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
                            <input class="form-control" type="text" id="bil_mesyuarat" name="bil_mesyuarat" readonly>
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
                            <input class="form-control" type="date" id="tarikh_keputusan" name="tarikh_keputusan" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Terima Keputusan Lembaga Perolehan </label>
                        <div>
                            <input class="form-control" type="date" id="tarikh_terima" name="tarikh_terima" readonly>
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
                            <input class="form-control" type="text" id="keputusan" name="keputusan" disabled>
                        </div>
                        <label class="form-label" style="font-weight: bold; margin-top:10px;">Harga</label>
                        <div>
                                <input class="form-control" type="text" id="harga" name="harga" readonly>
                        </div>
                        <label class="form-label" style="font-weight: bold; margin-top:10px;">Tempoh </label>
                        <div>
                            <input class="form-control" type="text" id="tempoh" name="tempoh"  readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Catatan PBM (Jika Ada)</label>
                        <div>
                            <textarea class="form-control" style="height: 180px;" name="catatan" id="catatan" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-form">
                <button class="btn btn-outline-primary"
                    style="width: 10%; margin-right: 10px; border: none; background: none; padding: 0; color: blue; text-align: right;"
                    onclick="history.back()">Kembali</button>
            </div>

        </div>
    </div>

</section>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script>

    var dataPenilaian = @json($dataPenilaian);
    var syarikat = @json($syarikat);
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

        if(dataPenilaian['keputusan_akhir'] == "-1") {
            $("#keputusan").val("TIADA SYARIKAT DIPILIH");
        } else {
            $("#keputusan").val(syarikat['nama_syarikat']);

        }

        $('#catatan').val(dataPenilaian['catatan']);
        $('#bil_mesyuarat').val(dataPenilaian['bil_mesy']);

    });

</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('.nav-list a').removeClass('active');
	}, false);

  $("document").ready(function(){
        var local = window.location.origin;
        var url = "/awas/keputusan";
		$('.link[href="'+url+'"]').addClass('active');
	});
</script>
<style>
    .span6 label,
    .span6 input {
        display: inline-block;
    }


</style>
@endsection
