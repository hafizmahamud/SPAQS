<!DOCTYPE HTML>
@extends('sisdant::layouts.master')
@section('title', __('Permohonan Nombor Perolehan'))
@section('content')

      <div class="pagetitle">
        <h1>Permohonan Nombor Perolehan</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

      </div><!-- End Page Title -->

      <section class="section">
        <ul style="width: 60%; background: white;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
            <li class="nav-item flex-fill" role="presentation" style="width: 30%;">
                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                    aria-selected="true">Senarai Permohonan
                    @if(in_array('PELAKSANA KEMASKINI', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                  </button>
            </li>
            <li class="nav-item flex-fill" role="presentation" style="width: 30%;">
                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Draf Permohonan</button>
            </li>
            <li class="nav-item flex-fill" role="presentation" style="width: 30%;">
              <button class="nav-link w-100" id="iklan-tab" data-bs-toggle="tab"
                  data-bs-target="#iklan-justified" type="button" role="tab" aria-controls="profile"
                  aria-selected="false">Senarai Permohonan Telah Iklan</button>
          </li>

        </ul>
        <a class="btn btn-primary" href="/sisdant/permohonanbaru" role="button" style="height: fit-content; padding: 10px; float: right; margin-top: -50px; ">Permohonan Baharu</a>

        <div class="tab-content pt-2" id="myTabjustifiedContent">
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
              <div class="card">
                <div class="card-body">
                  <b>Carian Mengikut Projek:</b>
                  <livewire:frontend.senarai-no-perolehan-permohonan-table :id="$user->id"/>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
              <div class="card">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-no-perolehan-permohonan-draf-table :id="$user->id"/>
              </div>
            </div>
            <div class="tab-pane fade" id="iklan-justified" role="tabpanel" aria-labelledby="iklan-tab">
              <div class="card">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-no-perolehan-permohonan-iklan-table :id="$user->id"/>

              </div>
            </div>
        </div>
      </section>
        <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            $('.nav-list a').removeClass('active');
          }, false);

          $("document").ready(function(){
            $('.nav-list a').removeClass('active');
          });

          $("document").ready(function(){
                var local = window.location.origin;
                var url = "/sisdant";
            $('.link[href="'+url+'"]').addClass('active');
          });
        </script>
        <script>

          function deletelist(id) {
              $.ajax({
                url: '/sisdant/getmaklumatpadam/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){
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
            .table{
              font-size: 15px;
            }

            #badge{
              width: 100%;
              padding-top: 10px;
              padding-bottom: 10px;
              text-transform: uppercase;
              font-size: 12px;
            }

          </style>

@endsection
