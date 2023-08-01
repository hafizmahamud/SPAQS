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
    <ul style="width: 15%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
            <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                aria-selected="false">Keputusan</button>
        </li>
    </ul>

    <div class="tab-content pt-2" id="myTabjustifiedContent">
        <form id="myForm" autocomplete="off" method="post" novalidate action="{{ url('/awas/savekeputusanperolehandraf') }}" enctype="multipart/form-data">
            @csrf
            {{-- START KEPUTUSAN --}}
            <div class="card">
                <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Laporan Tender Dikemukakan ke Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" id="tarikh_laporan" name="tarikh_laporan" style="width: 50%;"  onchange="success()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Bil Mesyuarat Lembaga Perolehan</label>
                            <div>
                                <input class="form-control" type="text" id="bil_mesyuarat" name="bil_mesyuarat" style="width: 50%;" onchange="success()" >
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Mesyuarat Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_mesyuarat" name="tarikh_mesyuarat" onchange="success()" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Keputusan Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_keputusan" name="tarikh_keputusan" onchange="success()" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Terima Keputusan Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_terima" name="tarikh_terima" onchange="success()" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Edar Keputusan</label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_edar" name="tarikh_edar" onchange="success()" disabled>
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
                                <input type="number" class="form-control" id="no_rujukan_ep" name="no_rujukan_ep" min="1" onclick="success()"  style="width:10%; margin-left:10px; margin-right:5px;">
                                <input type="text" class="form-control" value="P.P.S (s) 15/2011 Jld. " style="font-size: 12px; font-weight: bolder; border: none; border-color: transparent; width:20%; margin-right:5px;" readonly>
                                <input type="number" class="form-control" id="no_rujukan_ep1" name="no_rujukan_ep1" min="1" onclick="success()" style="width:10%;" >
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold; ">Harga</label>
                            <div>
                                <span class="input-symbol-euro">
                                    <input class="form-control" type="text" id="harga" name="harga" onchange="success()" disabled>
                                </span>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top:10px;">Tempoh </label>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <input class="form-control" type="number" id="tempoh" name="tempoh" onchange="success()" disabled>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" type="text" id="bulan_minggu" name="bulan_minggu"  onchange="success()" disabled>
                                        <option value="">SILA PILIH</option>
                                        <option value="BULAN">BULAN</option>
                                        <option value="MINGGU">MINGGU</option>
                                    </select>
                                </div>
                            </div>
                            <label class="form-label" style="font-weight: bold;">Catatan PBM (Jika Ada)</label>
                            <div>
                                <textarea class="form-control" style="height: 120px;" name="catatan" id="catatan" ></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6" >
                            <label class=" form-label" for="alamat" name="alamat" style="font-weight: bold;">Alamat Syarikat</label>
                            <div style="margin-top:2%">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat 1" class="col-5" onkeyup="this.value = this.value.toUpperCase();" onchange="success_keputusan()" required >
                            </div>
                            <div style="margin-top:2%">
                                <input type="text" class="form-control" id="alamat2" name="alamat2" placeholder="Alamat 2" class="col-5" onkeyup="this.value = this.value.toUpperCase();" onchange="success_keputusan()"  required>
                            </div>
                            <div style="margin-top:2%">
                                <input type="text" class="form-control" id="alamat3" name="alamat3" placeholder="Alamat 3" class="col-5" onkeyup="this.value = this.value.toUpperCase();" onchange="success_keputusan()"  >
                            </div>
                            <div style="margin-top:4%">
                                <div>
                                <input type="text" class="form-control" id="bandar" name="bandar" placeholder="Bandar" onkeyup="this.value = this.value.toUpperCase();" onchange="success_keputusan()" required  >
                                </div>
                            </div>
                            <div style="display: inline-block; margin-top:4%">
                                <input type="text" class="form-control" id="poskod" name="poskod" placeholder="Poskod" type="number" minlength="5" maxlength="5" onkeypress="javascript:return isNumber(event)" onchange="success_keputusan()" required  >
                            </div>
                            <div style="display: inline-block; margin-top:4%;">
                                <select class="form-select" name="negeri" id="negeri" onchange="success_keputusan()" required>
                                <option value="" >Sila Pilih Negeri</option>
                                <option value="JOHOR" >JOHOR</option>
                                <option value="KEDAH" >KEDAH</option>
                                <option value="KELANTAN" >KELANTAN</option>
                                <option value="KUALA LUMPUR" >KUALA LUMPUR</option>
                                <option value="LABUAN" >LABUAN</option>
                                <option value="MELAKA" >MELAKA</option>
                                <option value="NEGERI SEMBILAN" >NEGERI SEMBILAN</option>
                                <option value="PAHANG" >PAHANG</option>
                                <option value="PULAU PINANG" >PULAU PINANG</option>
                                <option value="PERAK" >PERAK</option>
                                <option value="PERLIS" >PERLIS</option>
                                <option value="PUTRAJAYA" >PUTRAJAYA</option>
                                <option value="SABAH" >SABAH</option>
                                <option value="SARAWAK" >SARAWAK</option>
                                <option value="SELANGOR" >SELANGOR</option>
                                <option value="TERENGGANU" >TERENGGANU</option>
                                <option value="LAIN-LAIN" >LAIN-LAIN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-form">
                <button class="btn btn-primary" id="hantar" style="width: 10%;" type="submit" >Hantar</button>
                <button class="btn btn-success" id="draf" type="submit" value="draf" style="width: 10%;" >Simpan</button>
                <button class="btn btn-outline-primary"
                    style="width: 10%; margin-right: 10px; border: none; background: none; padding: 0; color: blue;"
                    onclick="history.back()">Kembali</button>
                <input class="form-control" type="text" id="status" name="status" style="display:none;">
                <input class="form-control" type="text" name="id_penilaian" value="{{ $dataPenilaian->id }}" style="display:none;">
                <input class="form-control" type="text" name="id" value="{{ $dataIklan->id }}" style="display:none;">
            </div>
        </form>
    </div>
</section>

<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
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
<script>
    var dataPenilaian = @json($dataPenilaian);

    $(document).ready(function () {

        if(dataPenilaian['tarikh_laporan_tender']){
            var tarikh_laporan = dataPenilaian['tarikh_laporan_tender'].split(" ")[0];
                tarikh_laporan = tarikh_laporan.split("-")[0] + '-' + tarikh_laporan.split("-")[1] + '-' + tarikh_laporan.split("-")[2];
            $('#tarikh_laporan').val(tarikh_laporan);
            $('#tarikh_mesyuarat').attr('min', tarikh_laporan);
            document.getElementById("tarikh_mesyuarat").removeAttribute("disabled");
        }

        if(dataPenilaian['tarikh_mesy_lembaga']){
            var tarikh_mesy_lembaga = dataPenilaian['tarikh_mesy_lembaga'].split(" ")[0];
                tarikh_mesy_lembaga = tarikh_mesy_lembaga.split("-")[0] + '-' + tarikh_mesy_lembaga.split("-")[1] + '-' + tarikh_mesy_lembaga.split("-")[2];
            $('#tarikh_mesyuarat').val(tarikh_mesy_lembaga);
            $('#tarikh_keputusan').attr('min', tarikh_mesy_lembaga);
            document.getElementById("tarikh_keputusan").removeAttribute("disabled");
        }


        if(dataPenilaian['tarikh_result']){
            var tarikh_result = dataPenilaian['tarikh_result'].split(" ")[0];
                tarikh_result = tarikh_result.split("-")[0] + '-' + tarikh_result.split("-")[1] + '-' + tarikh_result.split("-")[2];
            $('#tarikh_keputusan').val(tarikh_result);
            $('#tarikh_terima').attr('min', tarikh_result);
            document.getElementById("tarikh_terima").removeAttribute("disabled");
        }


        if(dataPenilaian['tarikh_terima_result'] ){
            var tarikh_terima_result = dataPenilaian['tarikh_terima_result'].split(" ")[0];
                tarikh_terima_result = tarikh_terima_result.split("-")[0] + '-' + tarikh_terima_result.split("-")[1] + '-' + tarikh_terima_result.split("-")[2];
            $('#tarikh_terima').val(tarikh_terima_result);
            $('#tarikh_edar').attr('min', tarikh_terima_result);
            document.getElementById("tarikh_edar").removeAttribute("disabled");
        }


        if(dataPenilaian['tarikh_edar_result']){
            var tarikh_edar_result = dataPenilaian['tarikh_edar_result'].split(" ")[0];
                tarikh_edar_result = tarikh_edar_result.split("-")[0] + '-' + tarikh_edar_result.split("-")[1] + '-' + tarikh_edar_result.split("-")[2];
            $('#tarikh_edar').val(tarikh_edar_result);
        }

        if(dataPenilaian['nama_syarikat']){
            $("#keputusan").val(dataPenilaian['nama_syarikat']);
            document.getElementById("tempoh").removeAttribute("disabled");
            document.getElementById("bulan_minggu").removeAttribute("disabled");
            document.getElementById("harga").removeAttribute("disabled");
        }

        if(dataPenilaian['tempoh'].split(" ")[0]){
            $('#tempoh').val(dataPenilaian['tempoh'].split(" ")[0]);
        }

        if(dataPenilaian['tempoh'].split(" ")[1]){
            $('#bulan_minggu').val(dataPenilaian['tempoh'].split(" ")[1]);
        }

        if(dataPenilaian['harga']){
            $('#harga').val(dataPenilaian['harga']);
        }

        if(dataPenilaian['no_rujukan']){
            let s =dataPenilaian['no_rujukan'];
            var rujukan1 = s.split(/[()]/);
            var rujukan2 = s.split(/[ ]/);

            $('#no_rujukan_ep').val(rujukan1[1]);
            $('#no_rujukan_ep1').val(rujukan2[rujukan2.length-1]);
        }


        $('#catatan').val(dataPenilaian['catatan']);
        $('#bil_mesyuarat').val(dataPenilaian['bil_mesy']);
        $('#alamat').val(dataPenilaian['alamat']);
        $('#alamat2').val(dataPenilaian['alamat2']);
        $('#alamat3').val(dataPenilaian['alamat3']);
        $('#bandar').val(dataPenilaian['bandar']);
        $('#poskod').val(dataPenilaian['poskod']);
        $('#negeri').val(dataPenilaian['negeri']);

    });

    function success() {
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
        var alamat = document.getElementById("alamat").value;
        var alamat2 = document.getElementById("alamat2").value;
        var alamat3 = document.getElementById("alamat3").value;
        var bandar = document.getElementById("bandar").value;
        var poskod = document.getElementById("poskod").value;
        var negeri = document.getElementById("negeri").value;

        if(tarikh_laporan && tarikh_mesyuarat && tarikh_keputusan && tarikh_terima && tarikh_edar && bil_mesyuarat && keputusan && harga && tempoh && bulan_minggu && alamat && alamat2 && alamat3 && bandar && poskod && negeri) {
            document.getElementById("hantar").removeAttribute("disabled");
        } else {
            document.getElementById('hantar').disabled = true;
        }
    }

    $('#draf').click(function() {
        event.preventDefault();
        var check = document.getElementById('draf').value;
        document.getElementById('status').value = check;
        Swal.fire({
                title: "Adakah anda pasti untuk menyimpan rekod keputusan?",
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
                }
            });
    });

    $('#hantar').click(function() {
        event.preventDefault();
        var check = document.getElementById('hantar').value;
        document.getElementById('status').value = check;
        Swal.fire({
                title: "Adakah anda pasti untuk menghantar rekod keputusan?",
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
                }
            });
    });

    $('#catatan').keyup(function(){
        this.value = this.value.toUpperCase();
        success();
    });

    $('#keputusan').keyup(function(){
        this.value = this.value.toUpperCase();
        success();
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
        document.getElementById('tarikh_mesyuarat').value = "";
        success();
    });

    $("#tarikh_mesyuarat").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_keputusan').attr('min', selected);
        document.getElementById("tarikh_keputusan").removeAttribute("disabled");
        document.getElementById('tarikh_keputusan').value = "";
        success();
    });

    $("#tarikh_keputusan").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_terima').attr('min', selected);
        document.getElementById("tarikh_terima").removeAttribute("disabled");
        document.getElementById('tarikh_terima').value = "";
        success();
    });

    $("#tarikh_terima").on("change",function(){
        var selected = $(this).val();
        $('#tarikh_edar').attr('min', selected);
        document.getElementById("tarikh_edar").removeAttribute("disabled");
        document.getElementById('tarikh_edar').value = "";
        success();
    });


    var data = @json($data);
    var date = data['tarikh_jangka_iklan'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_laporan = year + '-' + month + '-' + day;

    $('#tarikh_laporan').attr('min', tarikh_laporan);

    // untuk keputusan
    $('#harga').mask('0, 000, 000, 000, 000, 000, 000.00', {
        reverse: true
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
