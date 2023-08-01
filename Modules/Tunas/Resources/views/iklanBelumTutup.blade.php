<!DOCTYPE HTML>
@extends('tunas::layouts.master')

@section('content')
      <div class="pagetitle">
        <h1>Senarai Iklan Belum Tutup</h1>
        @if (config('boilerplate.frontend_breadcrumbs'))
          @include('frontend.includes.partials.breadcrumbs')
        @endif

      </div><!-- End Page Title -->

        <section class="section">
          <div style="display: flex;">
              <h5 class="card-title">Senarai Iklan Belum Tutup</h5>
          </div>

          <div class="card">
              <div class="card-body">
                  <b>Carian Mengikut Projek:</b>
                  <livewire:frontend.senarai-iklan-belum-tutup-table />
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
        var url = "/tunas/senaraiiklanbelumtutup";
		$('.link[href="'+url+'"]').addClass('active');
	});
</script>
<script>
  function view(id) {
      Swal.fire({
          title: 'Adakah anda pasti untuk kemaskini ?',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak',
          reverseButtons: true,
          icon: 'warning'
      }).then((result) => {
          if (result.value) {
            //   window.location.href="tunas/viewiklan/" + id;
          }
      });
  }
</script>

@endsection

