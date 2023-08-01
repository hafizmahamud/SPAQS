<!DOCTYPE HTML>
@extends('awas::layouts.masterPetenderBerjaya')


<div style="background-color:white; padding:5px;">
    <img id="logo" src="/img/Logo_JPS.png" alt="" style="display:block; margin-left:auto; margin-right:auto; width:10%;"><br>
    <p id="text-logo" style=" text-align:center; font-size:30px; ">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA
    </p>
</div>
<body>
    <main id="main-template" class="main-template" >
        <section class="section">
            <div style="display: flex;">
                <h5 class="card-title">Senarai Petender Berjaya</h5>
            </div>

            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    <livewire:frontend.senarai-petender-berjaya-public-table />
                    <br>
                    <br>
                </div>
            </div>
        </section>
    </main>
</body>
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




<script>
  function butiran(id){

    $.ajax({
        url: '/awas/getiklan/'+id,
        type: 'get',
        dataType: 'json',
        success: function(response){
          var jenis_tender = response[0].penilaian_perolehan.iklan_perolehan.mohon_no_perolehan.matrik_iklan.jenis_tender.nama;
          var no_tender = response[0].penilaian_perolehan.iklan_perolehan.mohon_no_perolehan.no_perolehan;
          var tajuk_projek = response[0].penilaian_perolehan.iklan_perolehan.mohon_no_perolehan.tajuk_perolehan;
          var petender_berjaya = response[0].syrikt.lawatan_tapak.name_syarikat;
          var harga = response[0].syrikt.jadualharga[0].harga;
          var tempoh_kontrak = response[0].syrikt.jadualharga[0].tempoh;
          var bulan = response[0].syrikt.jadualharga[0].bulan_minggu;
          var dokumen_sst = response[0].penilaian_perolehan.dokumen_s_s_t;
          if(dokumen_sst.length != 0) {
            var dokumen_sst_path = response[0].penilaian_perolehan.dokumen_s_s_t[0].fail;
            var dokumen_sst_name = response[0].penilaian_perolehan.dokumen_s_s_t[0].nama_fail;
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
                              '<p class="text-left">'+ tempoh_kontrak + ' ' + bulan +'</p>' +
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

          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
              html: html,
              showCancelButton: false,
              confirmButtonText: 'Tutup',
            });
        }
      });
  }
</script>

