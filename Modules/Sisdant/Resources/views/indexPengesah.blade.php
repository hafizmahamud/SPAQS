<!DOCTYPE HTML>
@extends('sisdant::layouts.master')

@section('content')

      <div class="pagetitle">
        <h1>Senarai Pengesahan Nombor Perolehan</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

      </div><!-- End Page Title -->



      <section class="section">


          <div style="display: flex; justify-content:space-between;">
              <h5 class="card-title">Senarai Pengesahan Nombor Perolehan</h5>
          </div>
          <div class="card">
            <div class="card-body">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-nombor-perolehan-sisdant-table />
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
              var url = "/sisdant/pengesah";
          $('.link[href="'+url+'"]').addClass('active');
        });
      </script>
@endsection
