<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Butiran Penilaian</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
<section class="section">
    <div class="spanner">
        <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
        </div>
    </div>
    <ul style="width: 30%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 " id="home-tab" data-bs-toggle="tab"  style="width: 50%;"
                data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                aria-selected="true">Penilaian</button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"  style="width: 50%;"
                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                aria-selected="false">Keputusan</button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabjustifiedContent">
        <div class="tab-pane fade" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
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
        <div class="tab-pane fade  show active" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
            <form id="myForm" autocomplete="off" method="post" novalidate action="{{ url('/awas/savekeputusan') }}"
            enctype="multipart/form-data">
            @csrf
                <div class="card" id="card_syor" >
                    <label class="form-label" style="font-weight: bold;">Pengesyoran </label>
                        <div>
                            <select class="form-select" type="text" id="syor" style="width:50%; display: inline;">
                                <option >SILA PILIH</option>
                                    @foreach( $jadualHarga as $jd )
                                        <option value={{$jd->syarikat_id}}>{{ $jd->syarikat['nama_syarikat'] }}</option>
                                    @endforeach
                            </select>
                            <span style="color: Dodgerblue; margin-left: 10px; pointer-events:none; opacity:0.5;" id="add_syor" onclick="addSyor()">
                                <i class="fas fa-plus" style="font-size: 20px;"></i>
                            </span>
                        </div>
                    <label class="form-label" style="font-weight: bold; margin-top:10px;">Senarai Pengesyoran :</label>
                    <ol id="senarai_syor">
                        @foreach( $syor as $syor)
                            @php($id =  $syor->syarikat)
                            @php($value =  $syor->syrikt['nama_syarikat'])
                            <li id="ul_{{$syor->syarikat}}">{{ $syor->syrikt['nama_syarikat']}}
                                <label id="label_{{$syor->syarikat}}" style="margin-bottom: 0px;"  onclick=removeSyor({{$id}});>
                                    <i id="{{$syor->syarikat}}" class="mdi mdi-minus-circle" style="color: red; font-size: 22px; margin-left: 20px;"></i>
                                </label>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div class="card">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Laporan Tender Dikemukakan ke Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" id="tarikh_laporan" name="tarikh_laporan" onchange="success()" style="width: 50%;" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Bil Mesyuarat Lembaga Perolehan</label>
                            <div>
                                <input class="form-control" type="text" id="bil_mesyuarat" name="bil_mesyuarat" style="width: 50%;" onchange="success()">
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Mesyuarat Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_mesyuarat" name="tarikh_mesyuarat" onchange="success()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Keputusan Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_keputusan" name="tarikh_keputusan" onchange="success()">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Terima Keputusan Lembaga Perolehan </label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_terima" name="tarikh_terima" onchange="success()">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tarikh Edar Keputusan</label>
                            <div>
                                <input class="form-control" type="date" style="width: 50%;" id="tarikh_edar" name="tarikh_edar" onchange="success()">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;"> Keputusan Lembaga Perolehan </label>
                            <div>
                                <select class="form-select" type="text" id="keputusan" name="keputusan" style="width:50%; display: inline;" onchange="success()">
                                    <option value="">SILA PILIH</option>
                                    <option value="-1">TIADA SYARIKAT DIPILIH</option>
                                    @foreach( $syor1 as $syor )
                                        <option value={{$syor->syarikat}}>{{ $syor->syrikt['nama_syarikat'] }}</option>
                                    @endforeach
                                </select>


                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top:10px;">Harga</label>
                            <div>
                                <span class="input-symbol-euro">
                                    <input class="form-control" type="text" id="harga" name="harga" onchange="success()">
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
                            {{-- <label class="form-label" style="font-weight: bold; margin-top:10px;">Tempohxx </label>
                            <div>
                                <input class="form-control" type="text" id="tempoh" name="tempoh" style="width:50%;" onchange="success()">
                            </div> --}}
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Catatan PBM (Jika Ada)</label>
                            <div>
                                <textarea class="form-control" style="height: 180px;" name="catatan" id="catatan"></textarea>
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
                    <input class="form-control" type="text" name="pengesyoran_array" id="pengesyoran_array" style="display:none;">
                </div>
            </form>
        </div>
    </div>

</section>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
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


    var ul = document.getElementById("senarai_syor");
    var card_syor = document.getElementById("card_syor");
    document.getElementById("harga").disabled = "true";
    document.getElementById("tempoh").disabled = "true";

    const array_syor = [];
    var data_syor = @json($syor_array);
    var dataPenilaian = @json($dataPenilaian);


    $(document).ready(function () {
        var selectobject = document.getElementById("syor");
        for (var i=0; i<selectobject.length; i++) {
            for (var x=0; x<data_syor.length; x++) {
                if (selectobject.options[i].value == data_syor[x].syarikat)
                    selectobject.remove(i);
            }
        }

        for (var x=0; x<data_syor.length; x++) {
            array_syor.push(data_syor[x].syarikat);
            document.getElementById("pengesyoran_array").value = array_syor;
        }

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

        if(dataPenilaian['tempoh']){
            var tempoh = dataPenilaian['tempoh'].split(" ");
            $('#tempoh').val(tempoh[0]);
            $('#bulan_minggu').val(tempoh[1]);
            document.getElementById("tempoh").removeAttribute("disabled");
            document.getElementById("bulan_minggu").removeAttribute("disabled");
        }

        if(dataPenilaian['harga']){
            $('#harga').val(dataPenilaian['harga']);
            document.getElementById("harga").removeAttribute("disabled");
        }

        $('#catatan').val(dataPenilaian['catatan']);
        $('#bil_mesyuarat').val(dataPenilaian['bil_mesy']);

        if(dataPenilaian['keputusan_akhir']){
            $("#keputusan").val(dataPenilaian['keputusan_akhir']);
            document.getElementById("tempoh").removeAttribute("disabled");
            document.getElementById("harga").removeAttribute("disabled");
            document.getElementById("bulan_minggu").removeAttribute("disabled");
        }

        success();

    });

    function success() {
        var tarikh_laporan = document.getElementById("tarikh_laporan").value;
        var tarikh_mesyuarat = document.getElementById("tarikh_mesyuarat").value;
        var tarikh_keputusan = document.getElementById("tarikh_keputusan").value;
        var tarikh_terima = document.getElementById("tarikh_terima").value;
        var tarikh_edar = document.getElementById("tarikh_edar").value;
        var bil_mesyuarat = document.getElementById("bil_mesyuarat").value;
        var keputusan = document.getElementById("keputusan").value;

        if(tarikh_laporan && tarikh_mesyuarat && tarikh_keputusan && tarikh_terima && tarikh_edar && bil_mesyuarat && keputusan && $('#senarai_syor li').length > 0 ) {
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

    $("#syor").on('change',function(){
        $("#add_syor").css("pointer-events", "auto");
        $("#add_syor").css("opacity", "1");
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

    function addSyor() {
        card_syor.style.display = "block";

        var syor_value = $( "#syor option:selected" ).text();
        var value = document.getElementById("syor").value;
        $('#syor option:selected').remove();
        var li = document.createElement("li");
        li.id = "ul_"+value;
        li.appendChild(document.createTextNode(syor_value));
        ul.appendChild(li);

        var btnRemove = document.createElement("LABEL");
        btnRemove.id = "label_"+value;

        btnRemove.onclick = function () {
            removeSyor(value, syor_value)
        };

        li.appendChild(btnRemove);

        var btn_i = document.createElement("i");
        btn_i.id = value;

        btnRemove.appendChild(btn_i);
        var i_remove = document.getElementById(value);
        var label = document.getElementById("label_"+value);

        i_remove.classList.add("mdi");
        i_remove.classList.add("mdi-minus-circle");
        i_remove.style.color = "red";
        i_remove.style.fontSize = "22px";
        i_remove.style.marginLeft = "20px";
        label.style.marginBottom = "0px";


        $("#add_syor").css("pointer-events", "none");
        $("#add_syor").css("opacity", "0.5");

        //add data in dropdown keputusan
        $('#keputusan').append(new Option(syor_value, value));

        // remove disable
        document.getElementById("keputusan").removeAttribute("disabled");

        array_syor.push(value);
        document.getElementById("pengesyoran_array").value = array_syor;
        success();

    }

    function removeSyor(val) {
        $('#ul_'+val).remove();
        $.ajax({
                url: '/awas/checksyarikat/'+val,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#syor').append(new Option( response[1][0].syarikat['nama_syarikat'], val));
                }
            });

        if ( $('#senarai_syor li').length == 0 ) {
            document.getElementById("keputusan").disabled = "true";
            document.getElementById("harga").disabled = "true";
            document.getElementById("bulan_minggu").disabled = "true";
            document.getElementById("tempoh").disabled = "true";
        }

        // remove data from dropdown keputusan
        var selectobject = document.getElementById("keputusan");
        for (var i=0; i<selectobject.length; i++) {
            if (selectobject.options[i].value == val)
                selectobject.remove(i);
        }

        document.getElementById("harga").value =  "";
        document.getElementById("tempoh").value =  "";
        document.getElementById("bulan_minggu").value =  "";

        const index = array_syor.indexOf(val);
        if (index > -1) {
            array_syor.splice(index, 1);
        }
        document.getElementById("pengesyoran_array").value = array_syor;

    }

    // dropdown keputusan
    $('#keputusan').change(function(){

        var id_syarikat = $(this).val();
        if( id_syarikat != "-1") {
            $.ajax({
                url: '/awas/checksyarikat/'+id_syarikat,
                type: 'get',
                dataType: 'json',
                success: function(response){
                    document.getElementById("harga").removeAttribute("disabled");
                    document.getElementById("tempoh").removeAttribute("disabled");
                    document.getElementById("bulan_minggu").removeAttribute("disabled");
                    document.getElementById("harga").value =  response[0][0].harga;
                    document.getElementById("tempoh").value =  response[0][0].tempoh;
                    document.getElementById("bulan_minggu").value = response[0][0].bulan_minggu;
                }
            });
        } else {
            document.getElementById("harga").value =  "";
            document.getElementById("tempoh").value =  "";
            document.getElementById("harga").disabled = "true";
            document.getElementById("tempoh").disabled = "true";
            document.getElementById("bulan_minggu").value =  "";
            document.getElementById("bulan_minggu").disabled = "true";
        }

    });
    // end dropdown keputusan

    var data = @json($data);
    var date = data['tarikh_jangka_iklan'].split(" ")[0];
    var year = date.split("-")[0];
    var month = date.split("-")[1];
    var day = date.split("-")[2];
    var tarikh_laporan = year + '-' + month + '-' + day;

    $('#tarikh_laporan').attr('min', tarikh_laporan);
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
