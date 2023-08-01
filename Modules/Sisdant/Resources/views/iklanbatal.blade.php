<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Iklan Dibatalkan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
<div class="spanner">
    <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
    </div>
</div>
    <section class="section">
        <div class="tab-content pt-2" id="myTabjustifiedContent">
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                {{-- first  --}}
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
                                <textarea class="form-control" name="tajuk" id="tajuk" style="height: 100px" onkeyup="
                                var start = this.selectionStart;
                                var end = this.selectionEnd;
                                this.value = this.value.toUpperCase();
                                this.setSelectionRange(start, end);" readonly>{{ $mohon->tajuk_perolehan }} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- second --}}
                <div class="card">
                    <h5 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Lembaga Pembangunan Industri Pembinaan Malaysia (CIDB)</h5>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Kategori</label>
                            {{-- <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;" onclick="AddDropDownList()">
                                <i class="fas fa-plus"></i>
                            </span> --}}
                            <div id="kategori_kelas"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Pengkhususan</label>
                            <div id="kelas_pengkhususan"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div id="dvContainerKelas">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class=" form-label" style="font-weight: bold;">Gred</label>
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
                                <label class="form-label" style="font-weight: bold;">Kod Bidang</label>
                                {{-- <span style="font-size: 25px; color: Dodgerblue;margin-top: 50px; margin-left:30px;" onclick="AddDropDownList()">
                                    <i class="fas fa-plus"></i>
                                </span> --}}
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Sub bidang</label>
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
                                <label class="form-label" style="font-weight: bold;">Tajuk PUKONSA</label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tajuk Kecil PUKONSA</label>
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
                            <label class="form-label" style="font-weight: bold;">Tajuk UPKJ</label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tajuk Kecil UPKJ</label>
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
                            <label class="form-label" style="font-weight: bold;">Tarikh Jangka Iklan</label>
                            <div>
                                <input type="text" name="tarikh_jangka_iklan" id="tarikh_jangka_iklan" value="{{\Carbon\Carbon::parse($mohon->tarikh_jangka_iklan)->format('d/m/Y')}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Tarikh Keluar Iklan</label>
                            <div>
                            <input type="text" name="tarikh_keluar_iklan" id="tarikh_keluar_iklan" value="{{\Carbon\Carbon::parse($data->tarikh_keluar_iklan)->format('d/m/Y')}}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Tarikh Jual Mulai Dari</label>
                            <div>
                            <input type="text" name="tarikh_mula_jual" id="tarikh_mula_jual" value="{{\Carbon\Carbon::parse($data->tarikh_mula_jual)->format('d/m/Y')}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="inputDate" class="form-label" style="font-weight: bold;">Tarikh Akhir Jual</label>
                            <div>
                                <input type="text" name="tarikh_akhir_jual" id="tarikh_akhir_jual" value="{{\Carbon\Carbon::parse($data->tarikh_akhir_jual)->format('d/m/Y')}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Cara Bayaran</label>
                            <div>
                                <input type="text" name="cara_bayar" id="cara_bayar" value="{{ $data->carabayar['nama'] }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Harga Dokumen Tender</label>
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
                            <label class="form-label" style="font-weight: bold;">Pejabat Pamer Dan Jual</label>
                            <div>
                                <input type="text" name="pejabat_pamer" id="pejabat_pamer" value="{{ $data->pejabat_pamer_jual }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Bayar Kepada</label>
                            <div>
                                <input type="text" name="bayar_kepada" id="bayar_kepada"  value="{{ $data->bayarkepada['nama'] }}" class="form-control" readonly>
                            </div>
                        </div>


                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Taklimat Tender<a style="color: red;padding-top: 15px;">*</a></label>
                            <div>
                                <input type="text" name="taklimat_tender" id="taklimat_tender"   value="{{ $data->taklimat_tender }}" class="form-control" readonly>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Lawatan Tapak</label>
                            <div>
                                <input type="text" name="lawatan_tapak" id="lawatan_tapak"  value="{{ $data->lawatan_tapak}}" class="form-control" readonly>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Pejabat Lapor</label>
                            <div>
                                <input type="text" name="pejabat_lapor" id="pejabat_lapor" value="{{ $data->pejabatlapor['alamat'] }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: bold;">Tarikh Taklimat Tender</label>
                            <div>
                                <input type="text" name="tarikh_taklimat_tender" id="tarikh_taklimat_tender" value="{{\Carbon\Carbon::parse($data->tarikh_taklimat_tender)->format('d/m/Y')}}"
                                    class="form-control" readonly>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Tarikh Lawatan Tapak</label>
                            <div>
                                <input type="text" name="tarikh_lawatan_tapak" id="tarikh_lawatan_tapak" value="{{\Carbon\Carbon::parse($data->tarikh_lawatan_tapak)->format('d/m/Y')}}" class="form-control" readonly>
                            </div>
                            <label class="form-label" style="font-weight: bold; margin-top: 15px;">Waktu Lapor</label>
                            <div>
                                <input type="time" name="waktu_lapor" class="form-control"
                                    value="{{ $data->waktu_lapor }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Lokasi Tapak</label>
                            <div>
                                <textarea class="form-control" name="lokasi" id="lokasi" style="height: 110px" onkeyup="
                                    var start = this.selectionStart;
                                    var end = this.selectionEnd;
                                    this.value = this.value.toUpperCase();
                                    this.setSelectionRange(start, end);" readonly>{{ $data->lokasi_tapak }}</textarea>
                            </div>
                        </div>


                    </div>

                    <div class="row mb-3">

                        <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Muat Naik Dokumen Iklan</label>
                            <div class="col-lg-8">
                                <a href='/{{ $mohon->dokumen_muatnaik }}'
                                    target="_blank">{{ $mohon->nama_dokumen }}</a>
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
            </div>


        </div>
        <div class="button-form">
            <button class="btn btn-outline-primary" style="width: 10%;"
                onclick="history.back()">Kembali</button>
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
        var url = "/tunas";
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
    butangBatal = @json($butangBatal);
    butangBatal = @json($butangBatal);
    statusIklan = @json($data->status_iklan_id);



    $(document).ready(

        function () {

            document.getElementById('gred').value = data.grade_id;
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
                            colKelas.style.cssText = 'margin-top:20px; margin-bottom:10px;';
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
                            // dvContainerKelas.appendChild(row_k);
                            // counter kelas + khusus
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


@endsection
