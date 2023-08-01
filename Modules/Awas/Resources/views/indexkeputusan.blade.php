<!DOCTYPE HTML>
@extends('awas::layouts.master')
@section('title', __('Keputusan'))
@section('content')

<div class="pagetitle">
        <h1>Keputusan</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

      </div><!-- End Page Title -->
      <section class="section">
        <ul style="width: 30%; background: white;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
            <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
                <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Portal JPS
                    @if(in_array('KEPUTUSAN PORTAL', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                  </button>
            </li>
            <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
                <button class="nav-link w-100" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                    aria-selected="true">ePerolehan
                    @if(in_array('KEPUTUSAN EP', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                  </button>
            </li>
        </ul>
        <i class="bi bi-question-circle-fill" style="float: right; margin-top: -50px; margin-left:-25px; "></i>
        <span class="tooltip-text" style="font-weight: bold; margin-top:50px; right: 3%; top: -30px;">
          <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 170px; background: white; color: #5e9efd; border-color: #5e9efd; border-style: solid; display: inline-block; cursor: pointer; margin-bottom: 2px">Menunggu Keputusan</a><br>
          <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 170px; background: #9aa1a9; color: black; display: inline-block; cursor: pointer; margin-bottom: 2px; ">Draf Keputusan</a><br>
          <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 170px; background: #5e9efd; color: white; display: inline-block; cursor: pointer;  margin-bottom: 2px;">Selesai</a><br>
        </span>
        <div class="card">
          <div class="card-body-tabs">
            <div class="tab-content pt-2" id="myTabjustifiedContent">
              <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="home-tab">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-keputusan-portal-table />
              </div>
              <div class="tab-pane fade" id="home-justified" role="tabpanel" aria-labelledby="profile-tab">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-iklan-tutup-awas-table />
              </div>
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
        var local = window.location.origin;
        var url = "/awas/keputusan";
		$('.link[href="'+url+'"]').addClass('active');
	});
</script>
<style>
  .bi-question-circle-fill::before {
    float: right;
    margin-right: -4%;
    margin-bottom: 20px;
    margin-top: 20px;
    }

</style>
@endsection
