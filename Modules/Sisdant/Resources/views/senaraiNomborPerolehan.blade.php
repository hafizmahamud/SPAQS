<!DOCTYPE HTML>
@extends('sisdant::layouts.master')


@section('content')
    <div class="pagetitle">
    <h1>Senarai Nombor Perolehan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
        @include('frontend.includes.partials.breadcrumbs')
    @endif
    </div>

    <section class="section">
        <div style="display: flex;">
            <h5 class="card-title">Senarai Nombor Perolehan</h5>
        </div>

        <div class="card">
            <div class="card-body">
                <b>Carian Mengikut Projek:</b>
                <livewire:frontend.senarai-nombor-perolehan-table />
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
            var url = "/sisdant/senarai_nombor_perolehan";
            $('.link[href="'+url+'"]').addClass('active');
        });
    </script>
@endsection
