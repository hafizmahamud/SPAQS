<!DOCTYPE HTML>
@extends('tunas::layouts.master')

@section('content')
      <div class="pagetitle">
        <h1>Senarai Iklan Telah Tutup</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif
      </div><!-- End Page Title -->
      <div class="container">
          <div class="row height d-flex justify-content-center align-items-center">
              <div class="col-12">
                  <i class="bi bi-question-circle-fill"></i>
                  <span class="tooltip-text" style="font-weight: bold;">
                    <a class="text-center" style="font-size: 12px; font-weight: bold; border-radius: 10px; width: 120px; background: white; color: #5e9efd; border-color: #5e9efd; border-style: solid; display: inline-block; cursor: pointer; margin-bottom: 2px">Untuk Tindakan</a><br>
                    <a class="text-center" style="font-size: 12px; font-weight: bold; border-radius: 10px; width: 120px; background: #9aa1a9; color: black; display: inline-block; cursor: pointer; margin-bottom: 2px ">Draf Jadual Harga</a><br>
                    <a class="text-center" style="font-size: 12px; font-weight: bold; border-radius: 10px; width: 120px; background: #5e9efd; color: white; display: inline-block; cursor: pointer;">Iklan Jadual Harga</a><br>
									</span>
              </div>
          </div>
      </div>
      <section class="section">
          <div class="card">
            <div class="card-body">
                  <b>Carian Mengikut Projek:</b>
                  <livewire:tunas::iklan-telah-tutup.iklan-telah-tutup/>
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
                var url = local + "/tunas/iklan-telah-tutup";
            $('.link[href="'+url+'"]').addClass('active');
          });
      </script>
      <style>
        .text-muted {
          margin-left: 10px;
        }
        .bi-question-circle-fill::before {
            float: right;
            margin-right: -4%;
            margin-bottom: 20px;
            margin-top: 30px;
        }
      </style>
@endsection



