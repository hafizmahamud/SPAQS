<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')

      <div class="pagetitle">
        <h1>Senarai Petender Berjaya</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

      </div><!-- End Page Title -->
      <section class="section">
          <div style="display: flex;">
              <h5 class="card-title">Senarai Petender Berjaya</h5>
          </div>

          <div class="container">
          <div class="row height d-flex justify-content-center align-items-center">
              <div class="col-12">
                  <i class="bi bi-question-circle-fill"></i>
                  <span class="tooltip-text" style="font-weight: bold;">
                    <a class="text-center" style="font-size: 12px; font-weight: bold; border-radius: 10px; width: 120px; background: white; color: #5e9efd; border-color: #5e9efd; border-style: solid; display: inline-block; cursor: pointer; margin-bottom: 2px">Petender Berjaya</a><br>
                    <a class="text-center" style="font-size: 12px; font-weight: bold; border-radius: 10px; width: 120px; background: #9aa1a9; color: black; display: inline-block; cursor: pointer; margin-bottom: 2px ">Draf</a><br>
                    <a class="text-center" style="font-size: 12px; font-weight: bold; border-radius: 10px; width: 120px; background: #5e9efd; color: white; display: inline-block; cursor: pointer;">Hantar</a><br>
                  </span>
              </div>
          </div>
        </div>

          <div class="card">
              <div class="card-body">
                <b>Carian Mengikut Projek:</b>
              <livewire:frontend.senarai-petender-berjaya-table />
              </div>
          </div>
      </section>
<style>
  .bi-question-circle-fill::before {
    float: right;
    margin-right: -4%;
    margin-bottom: 20px;
    margin-top: 20px;
    }

  .btn-outline-primary {
      width: 28% !important;
      background-color: #fff;
  }

</style>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
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
  function butiran(id){
    $("#wait").css("display", "block");
    $("div.spanner").addClass("show");

    $.ajax({
        url: '/awas/getiklan/'+id,
        type: 'get',
        dataType: 'json',
        success: function(response){
          $("#wait").css("display", "none");
          $("div.spanner").removeClass("show");
          var jenis_tender = response[0].iklan_perolehan.mohon_no_perolehan.matrik_iklan.jenis_tender.nama;
          var no_tender = response[0].iklan_perolehan.mohon_no_perolehan.no_perolehan;
          var tajuk_projek = response[0].iklan_perolehan.mohon_no_perolehan.tajuk_perolehan;
          var lawatan_tapak = response[0].borang_daftar_minat;
          if(lawatan_tapak == 'null') {
            var petender_berjaya = response[0].borang_daftar_minat.lawatan_tapak.name_syarikat;
          } else {
            var petender_berjaya = response[0].nama_syarikat;
          }
          var harga = response[0].harga;
          var tempoh_kontrak = response[0].tempoh;
          var bulan = response[0].bulan_minggu;
          var dokumen_sst = response[0].dokumen_s_s_t;
          var dokumen_kontrak = response[0].iklan_perolehan.dokumen_kontrak;
          if(dokumen_sst.length != 0) {
            var dokumen_sst_path = response[0].dokumen_s_s_t[0].fail;
            var dokumen_sst_name = response[0].dokumen_s_s_t[0].nama_fail;
          }

          html = '<div class="container" style="margin-top: 20px">';
          html = html + '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">Kategori Tender</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                              '<p class="text-left">'+ jenis_tender + '</p>' +
                            '</div>' +
                          '</div>' +
                          '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">No. Tender</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                            ' <p class="text-left">' + no_tender +'</p>' +
                            '</div>' +
                          '</div>' +
                          '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">Tajuk Projek</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                              '<p class="text-left">'+ tajuk_projek +'</p>' +
                          ' </div>' +
                          '</div>' +
                          '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">Petender Berjaya</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                              '<p class="text-left">'+ petender_berjaya +'</p>' +
                            '</div>' +
                          '</div>' +
                          '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">Harga (RM)</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                              '<p class="text-left">' + harga + '</p>' +
                            '</div>' +
                          '</div>' +
                          '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">Tempoh Kontrak</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                              '<p class="text-left">'+ tempoh_kontrak +'</p>' +
                            '</div>' +
                          '</div>';
          if(dokumen_sst.length != 0 ) {
            html = html + '<div class="row">' +
                            '<div class="col-5">' +
                              '<p class="text-right" style="font-weight:bold">Dokumen SST</p>' +
                            '</div>' +
                            '<div class="col-7">' +
                              '<p class="text-left"><a href="/' + dokumen_sst_path +
                                        '" target="_blank">' + dokumen_sst_name + '</a></p>' +
                            '</div>' +
                          '</div>';
          }

          html = html +'</div>';
          html = html + '<div class="container" style="margin-top: 20px">';
          if(dokumen_sst.length == 0 ) {
            html = html + '<button type="button" id="butiran_sst" class="btn btn-cons btn-outline-primary" style="width: 130px !important;">' +
                          'Butiran SST ' +
                          '<i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>' +
                          '</button>';
          } else {
            html = html + '<button type="button" id="butiran_sst" class="btn btn-cons btn-outline-primary" style="width: 130px !important;">' +
                          'Butiran SST' +
                          '</button>';
          }

          if(dokumen_kontrak.length == 0 || dokumen_kontrak[0].status == 'draf') {
            html = html + '<button type="button" role="button" id="dokumen_kontrak" class="btn btn-primary">' +
                          'Dokumen Kontrak ' +
                          '<i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>' +
                          '</button>' +
                          '</div>';
          } else {
            html = html + '<button type="button" role="button" id="dokumen_kontrak" class="btn btn-primary">' + 'Dokumen Kontrak' + '</button>' +
                    '</div>';
          }

          Swal.fire({
              html: html,
              showCancelButton: false,
              showConfirmButton: false,
              showCloseButton: true
          });

          $('#butiran_sst').click( function() {
            window.location.href = '/awas/butiran-sst/' +id;
          });

          $('#dokumen_kontrak').click( function() {
            window.location.href = '/awas/dokumen_kontrak/' +id;
          });
        }
      });
  }
</script>

@endsection
