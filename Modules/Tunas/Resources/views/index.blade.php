<!DOCTYPE HTML>
@extends('tunas::layouts.master')
@section('title', __('Senarai Permohonan Iklan'))
@section('content')
      <div class="pagetitle">
        <h1>Senarai Permohonan Iklan</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

        <div style="display: flex;">
          <h5 class="card-title">Senarai Permohonan Iklan</h5>
        </div>
      </div><!-- End Page Title -->

      <section class="section" style="margin-top:-30px">
          <ul style="width: 30%; margin-top:3%; background: white;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist" >
            <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                    aria-selected="true">Senarai Menunggu Iklan</button>
            </li>
            <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Iklan Dibatalkan</button>
            </li>
          </ul>
          <!-- Default Tabs -->
          <i class="bi bi-question-circle-fill" style="float: right; margin-top: -50px; margin-left:-25px; "></i>
          <span class="tooltip-text" style="font-weight: bold; right: 3%; top: 100px;">
            <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 150px; background: white; color: #5e9efd; border-color: #5e9efd; border-style: solid; display: inline-block; cursor: pointer; margin-bottom: 2px">Permohonan Baharu</a><br>
            <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 150px; background: #9aa1a9; color: black; display: inline-block; cursor: pointer; margin-bottom: 2px ">Draf Iklan</a><br>
            <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 150px; background: #5e9efd; color: white; display: inline-block; cursor: pointer;">Telah Diiklankan</a><br>
          </span>
          <div class="tab-content pt-2" id="myTabjustifiedContent">
              <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                <div class="card">
                  <div class="card-body">
                    <b>Carian Mengikut Projek:</b>
                      <livewire:frontend.senarai-nombor-perolehan-tunas-table />
                  </div>
              </div>
              </div>
              <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                      <div class="card">
                          <div class="card-body">
                            <b>Carian Mengikut Projek:</b>
                              <livewire:frontend.senarai-nombor-perolehan-batal-table />
                          </div>
                      </div>

                  </div>
                </div>
          </div><!-- End Default Tabs -->
          <div class="spanner">
            <div id="wait"
                style="display:none; position:absolute; top:25%; left:35%; padding:2px; z-index: 1000;"><img
                    src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
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
        var url = "/tunas";
		$('.link[href="'+url+'"]').addClass('active');
	});
</script>
<script>
  function lihatJustifikasi(id) {
    $("#wait").css("display", "block");
    $("div.spanner").addClass("show");
      $.ajax({
        url: '/tunas/justifikasi/'+id,
        type: 'get',
        dataType: 'json',
        success: function(response){
          $("#wait").css("display", "none");
          $("div.spanner").removeClass("show");
          if(response[0][0].dokumen_batal) {
            Swal.fire({
              title: "Justifikasi Pembatalan",
              html: "<label class='form-label'>Justifikasi :</label><br><textarea class='form-control' id='input_justifikasi' style='height: 120px' readonly>" + response[0][0].justifikasi_batal + "</textarea><br><a href='/"+response[0][0].dokumen_batal+"' target='_blank'> Dokumen Justifikasi Pembatalan </a></div>",
              showCancelButton: true,
              cancelButtonText: 'Kembali'
            });
          } else {
            Swal.fire({
              title: "Justifikasi Pembatalan",
              html: "<label class='form-label'>Justifikasi :</label><br><textarea class='form-control' id='input_justifikasi' style='height: 120px' readonly>" + response[0][0].justifikasi_batal + "</textarea></div>",
              showCancelButton: true,
              cancelButtonText: 'Kembali'
            });
          }
        }
    });
  }
</script>
<style>
  .bi-question-circle-fill::before {
    float: right;
    margin-right: -4%;
    margin-bottom: 20px;
    margin-top: 30px;
    }

</style>
@endsection
