<!DOCTYPE HTML>
@extends('tunas::layouts.masterIklan')

@section('content')
<div class="spanner">
  <div id="wait"><img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
  </div>
</div>
  <div class="container">
      <div class="pagetitle">
        <div class="row">
          <div class="col-11">
            <img src="/spaqs/assets/img/Logo_JPS.png" width="150" height="110" style="display:block; margin-left:auto; margin-right:auto;">
          </div>
        </div>
        <div class="row">
          <div class="col-9">
            <h5 class="text-right" style="color:#696969; font-size:30px; margin-top: 10px; font-weight:bold">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA</h5>
          </div>
        </div>
        <h1 style="color:black; font-size:20px; margin-top:30px">Senarai Petender Berjaya</h1>
      </div>
      <section class="section">
          <div class="card">
            <div class="card-body">
              <livewire:awas::laporan.senarai-petender-berjaya />
            </div>
          </div>
      </section>
  </div>
  <style>
    .spanner, .overlay {
        opacity: 100!important;
      }
  </style>
  <script>
    function butiran(id){

      $.ajax({
          url: '/awas/getiklan/'+id,
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
          success: function(response){
            var jenis_tender = response[0].penilaian_perolehan.iklan_perolehan.mohon_no_perolehan.matrik_iklan.jenis_tender.nama;
            var no_tender = response[0].penilaian_perolehan.iklan_perolehan.mohon_no_perolehan.no_perolehan;
            var tajuk_projek = response[0].penilaian_perolehan.iklan_perolehan.mohon_no_perolehan.tajuk_perolehan;
            var petender_berjaya = response[0].syrikt.lawatan_tapak.name_syarikat;
            var harga = response[0].penilaian_perolehan.harga;
            var tempoh = response[0].penilaian_perolehan.tempoh;

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
                                '<p class="text-left">'+ tempoh +'</p>' +
                              '</div>' +
                            '</div>';
            html = html +'</div>';

            Swal.fire({
                html: html,
            });

          }
        });
    }
  </script>
@endsection
