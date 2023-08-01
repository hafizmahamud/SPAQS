<!DOCTYPE HTML>
@extends('awas::layouts.master')
@section('title', __('Penilaian Perolehan'))
@section('content')

<div class="pagetitle">
        <h1>Penilaian Perolehan</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

      </div><!-- End Page Title -->
      <section class="section">
        <i class="bi bi-question-circle-fill" style="float: right; margin-top: -50px; margin-left:-25px; "></i>
        <span class="tooltip-text" style="font-weight: bold; margin-top:50px; right: 3%; top: -30px;">
          <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 170px; background: white; color: #5e9efd; border-color: #5e9efd; border-style: solid; display: inline-block; cursor: pointer; margin-bottom: 2px">Menunggu Penilaian</a><br>
          <a class="text-center" style="font-weight: bold; border-radius: 10px; width: 170px; background: #9aa1a9; color: black; display: inline-block; cursor: pointer; margin-bottom: 2px; ">Draf Penilaian</a><br>
        </span>
        <div class="card">
          <div class="card-body-tabs">
            <div class="tab-content pt-2" id="myTabjustifiedContent">
              <div class="tab-pane fade show active" id="profile-justified" role="tabpanel" aria-labelledby="home-tab">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-iklan-tutup-awas-portal-table />
              </div>
              {{-- <div class="tab-pane fade" id="home-justified" role="tabpanel" aria-labelledby="profile-tab">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-iklan-tutup-awas-table />
              </div> --}}
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
        var url = "/awas";
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
