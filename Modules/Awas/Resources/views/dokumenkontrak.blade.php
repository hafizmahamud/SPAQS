<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')

<div class="pagetitle">
        <h1>Dokumen Kontrak</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

</div><!-- End Page Title -->

<section class="section">
          <div style="display: flex;">
              <h5 class="card-title">Dokumen Kontrak</h5>
          </div>

        <div class="tab-content pt-2" id="myTabjustifiedContent">
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">

            <form id="myForm" autocomplete="off" method="post" novalidate action="{{ url('/awas/savedokumenkontrak') }}"
            enctype="multipart/form-data" style="padding: 10px;">
            @csrf
            <div class="card">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">No Kontrak</label>
                        <div>
                            <input class="form-control" type="text" value="{{$data->iklanPerolehan->mohonNoPerolehan->no_perolehan}}"
                                name="no_perolehan" id="no_perolehan" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Nama Projek</label>
                        <div>
                        <textarea class="form-control" name="nama_projek" value="{{$data->iklanPerolehan->mohonNoPerolehan->tajuk_perolehan}}"
                                readonly>{{$data->iklanPerolehan->mohonNoPerolehan->tajuk_perolehan}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Tutup Tender</label>
                        <div>
                        @if($data->iklanPerolehan->status_iklan_id == 7)
                                <input type="date" name="tarikh_tutup_tender" id="tarikh_tutup_tender" class="form-control" onclick="successmodal()" 
                                value="{{ date('Y-m-d', strtotime($data->iklanPerolehan->tarikh_akhir_jual)) }}"
                                required>
                                @else
                                <input type="date" name="tarikh_tutup_tender" id="tarikh_tutup_tender" class="form-control" onclick="successmodal()" 
                                value="{{ date('Y-m-d', strtotime($data->iklanPerolehan->tarikh_akhir_jual)) }}"
                                readonly>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Surat Setuju Terima (SST)<a style="color: red;">*</a></label>
                        <div>
                                <input type="date" name="tarikh_surat_setuju_terima_sst" id="tarikh_surat_setuju_terima_sst" class="form-control" 
                                value="{{ date('Y-m-d', strtotime($data->tarikh_result)) }}" required>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label" style="font-weight: bold;">Tarikh Sah Laku Tender Terkini</label>
                        <div>
                        @if($data->iklanPerolehan->status_iklan_id == 7)
                                <input type="date" name="tarikh_sah_laku_tender_terkini" id="tarikh_sah_laku_tender_terkini"
                                class="form-control"
                                value="{{ date('Y-m-d', strtotime($data->tarikh_sah_laku)) }}"
                                required>
                        @else
                                <input type="date" name="tarikh_sah_laku_tender_terkini" id="tarikh_sah_laku_tender_terkini"
                                class="form-control"
                                value="{{ date('Y-m-d', strtotime($data->tarikh_sah_laku)) }}"
                                readonly>
                        @endif
                        </div>
                    </div>
                </div>
            </div><!-- end card -->

            <div class="card">
                    <h4 style="font-weight:bold; background: #eaeff8; width: max-content; padding: 10px;">Maklumat Petender Berjaya</h4>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Nama</label>

                                <div>
                                @if($data->borangDaftarMinat == NULL)
                                    <input class="form-control" type="text" name="nama" value="{{$data['nama_syarikat']}}" readonly>
                                @else
                                    <input class="form-control" type="text" name="nama" value="{{$data->borangDaftarMinat->lawatanTapak['name_syarikat']}}" readonly>
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Harga (RM)</label>
                                <div>
                                    <input class="form-control" type="text" name="harga" value="{{$data['harga']}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                            <label class="form-label" style="font-weight: bold;">Tempoh</label>
                                <div>
                                    <input class="form-control" type="text" name="tempoh" value="{{$data['tempoh']}}" readonly>
                                </div>
                            </div>
                        </div>
            </div><!-- end card -->

            <div class="card">
                        <div class="row mb-3">
                                <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Surat Setuju Terima (SST) Ditandatangani Kontraktor<a style="color: red;">*</a></label>
                                    <div>
                                    <input type="date" name="tarikh_sign_sst" id="tarikh_sign_sst" class="form-control" onclick="successmodal()" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <label class="form-label" style="font-weight: bold;">Tarikh Akhir Dokumen Kontrak Patut Ditandatangani<a style="color: red;">*</a></label>
                                    <div>
                                    <input type="date" name="tarikh_sign_dokumen_kontrak" id="tarikh_sign_dokumen_kontrak" class="form-control" onclick="successmodal()" required>
                                    </div>
                                </div>
                        </div>
            </div><!-- end card -->

            <!-- <div class="button-form">
                <button class="btn btn-primary" id="hantar" name="hantar" type="submit" value="hantar" style="width: 10%;" disabled>Hantar</button>
                <button class="btn btn-success" id="draf" name="draf" type="submit" value="draf" style="width: 10%;" disabled>Simpan</button>
            </div> -->

            <div class="button-form">
            <button class="btn btn-primary" id="hantar" name="hantar" type="submit"  value="hantar"style="width: 10%;" disabled>Hantar</button>
              <button class="btn btn-success" id="draf" name="simpan" type="submit" value="draf" style="width: 10%;" disabled>Simpan</button>
              <button class="btn btn-outline-primary"  style="width: 10%; margin-right: 10px;" onclick="history.back()">Kembali</button>
              <input class="form-control" type="text" id="status" name="status" style="display:none;">
            </div>

            </form><!-- end form -->
            </div><!-- end tab-pane -->
        </div><!-- end myTabjustifiedContent -->
</section>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script src={{ Module::asset('awas:js/3_3_1_jquery.min.js') }}></script>
    <script src={{ Module::asset('awas:js/jquery.mask.min.js') }}></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.nav-list a').removeClass('active');
            }, false);

        $("document").ready(function(){
                var local = window.location.origin;
                var url = "/awas/senarai_petender_berjaya";
                $('.link[href="'+url+'"]').addClass('active');
            });
    </script>
    <script>
        function successmodal() {
        var tarikh_surat_setuju_terima_sst = document.getElementById("tarikh_surat_setuju_terima_sst").value;
        var tarikh_sign_sst = document.getElementById("tarikh_sign_sst").value;
        var tarikh_sign_dokumen_kontrak = document.getElementById("tarikh_sign_dokumen_kontrak").value;
            if (tarikh_surat_setuju_terima_sst && tarikh_sign_sst && tarikh_sign_dokumen_kontrak) {
            document.getElementById('hantar').disabled = false;
            document.getElementById('draf').disabled = false;
            } else {
            document.getElementById('hantar').disabled = true;
            document.getElementById('draf').disabled = true;
            }
        }
    </script>
    <script type="text/javascript">
        function simpandokumenkontrak() {
        var check = document.getElementById('hantar').value;
        document.getElementById('status').value = check;
        }

        $("#myForm").submit(function (event) {
        event.preventDefault();
        if (document.activeElement.value == 'hantar') { // kalau hantar
            document.getElementById('status').value = document.activeElement.value;
            var check = document.getElementById('hantar').value;
            document.getElementById('status').value = check;
            Swal.fire({
                title: "Adakah Anda Pasti Untuk Hantar Dokumen Kontrak?",
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
                title: "Adakah Anda Pasti Untuk Simpan Dokumen Kontrak?",
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


        data1 = @json($tarikh_sign_sst);

        if(data1 == null) {
            //empty
        } else {
            //tarikh_sign_sst
            var date = data1['tarikh_sign_sst'].split(" ")[0];
            var year = date.split("-")[0];
            var month = date.split("-")[1];
            var day = date.split("-")[2];
            var tarikh_sign_sst = year + '-' + month + '-' + day;
            $('#tarikh_sign_sst').val(tarikh_sign_sst);
            document.getElementsByName("tarikh_sign_sst")[0].setAttribute('min', tarikh_sign_sst);
        }


        data2 = @json($tarikh_sign_dokumen_kontrak);

        if(data2 == null) {
            //empty
        } else {
            //tarikh_sign_dokumen_kontrak
            var date = data2['tarikh_sign_dokumen_kontrak'].split(" ")[0];
            var year = date.split("-")[0];
            var month = date.split("-")[1];
            var day = date.split("-")[2];
            var tarikh_sign_dokumen_kontrak = year + '-' + month + '-' + day;
            $('#tarikh_sign_dokumen_kontrak').val(tarikh_sign_dokumen_kontrak);
            document.getElementsByName("tarikh_sign_dokumen_kontrak")[0].setAttribute('min', tarikh_sign_dokumen_kontrak);
        }
    </script>

@endsection
