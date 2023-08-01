<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')
<style>
.filter-search{
    width: max-content;
    height: max-content;
    padding-left: 20px;
    background-color: rgb(255, 255, 255);
    padding: 10 0 10 18;
    border-radius: 5px;
    box-shadow: 0px 0 30px rgb(1 41 112 / 30%);
}
.filter-search h3{
    font-weight: 600;
    font-family: "Outfit" , sans-serif;
    color: rgb(0, 0, 0);
}
.tajuk{
    font-weight: 600;
}
.filter{

}
.filterbox span.select2.select2-container.select2-container--default.select2-container{
    width: 330px!important;
}
.filterbox span.select2-selection.select2-selection--multiple{
    width: 330px!important;
}
.filterbox input{
    width: 330px!important;
}
.submitButton{
    margin-top: 10px;
    float: right;
    margin-right: 20px;
}
.btn .btn-primary{
    margin-left: 0!important;
}
.filterform{
    overflow: hidden;
}
.overlay {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 3;
    top: 0;
    left: 0;
    /* background-color: rgba(0,0,0, 0.6); */
    overflow-y: hidden;
    transition: 0.5s!important;
}

.overlay-content {
    position: relative;
    top: 22%;
    left: 11%;
    width: max-content;
}

.overlay a {
    padding: 8px;
    text-decoration: none;
    /* font-size: 36px; */
    color: #818181;
    display: block;
    transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
.overlay {overflow-y: auto;}
.overlay a {font-size: 20px}
.overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
}
}
.spanner, .overlay {
    opacity: 100!important;
}
.btn1 {
    display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
@media (prefers-reduced-motion: reduce) {
.btn1 {
    transition: none;
}
}
.btn1:hover {
color: #212529;
}
.btn-filter {
    color: #6c757d;
    background-color: rgb(236, 236, 236);
    border-color: rgb(236, 236, 236);
}
.btn-filter:hover {
    color: #5c636a;
    background-color: rgb(180, 180, 180);
    border-color: rgb(180, 180, 180);
}
.btn-clear {
    color: #141414;
    background-color: rgb(255, 255, 255);
    border-color: rgb(255, 255, 255);
}
.btn-clear:hover {
    color: #000000;
    background-color: rgb(228, 228, 228);
    border-color: rgb(255, 255, 255);
}
</style>
<div class="pagetitle">
    <h1>Laporan Pemantauan Tender</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif
</div><!-- End Page Title -->
<section class="section">
    <ul style="width: 30%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist" style="background: white!important;">
        <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                aria-selected="true">Laporan Petender</button>
        </li>
        <li class="nav-item flex-fill" role="presentation" style="width: 50%;">
            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                aria-selected="false">Laporan Penilai</button>
        </li>
    </ul>
    <div class="tab-content pt-2" id="myTabjustifiedContent" style="padding-top: 0px!important;">
        <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
        <div class="card">
            <div class="card-body">
                    <br>
                    <livewire:awas::laporan.laporan-petender />
                <div class="spanner">
                    <div id="wait"
                        style="display:none; position:absolute; top:25%; left:35%; padding:2px; z-index: 1000;"><img
                            src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br></div>
                </div>

            </div>
        </div>
        </div>
        <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
            <div id="myNav2" class="overlay">
                <div class="overlay-content">
                    <div class="filter-search">
                        <a>Sila pilih untuk carian terperinci</a>
                        <form class="filterform" autocomplete="off" method="POST" action="{{ url('/awas/laporan_penilai_filter') }}">
                            @csrf
                            <div class="filterbox">
                                <div class="filter"  style="width: 350px!important;">
                                    <a class="tajuk">TARIKH</a>
                                    <input type="text" class="form-control"  name="tarikh" id="tarikh" placeholder="Sila Pilih">
                                </div>
                            </div>
                            <div class="submitButton">
                                <button type="button" id="reset" class="btn1 btn-clear">Padam</button>
                                <button class="btn btn-primary" id="hantar" name="hantar" type="submit"  value="hantar"style="width: 150px;">Hantar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn1 btn-filter" onclick="openNav2()"><i class="fas fa-regular fa-filter"></i> Filter</button>
                    <br>
                    <br>
                    @if(!session('data2'))
                    <livewire:awas::laporan.laporan-penilai />
                    @else
                        @livewire('awas::laporan.laporan-penilai-filtered',['post' => session('data2')])
                    @endif
                    <br>
                    <br>
                    <div class="spanner">
                        <div id="wait2"
                            style="display:none; position:absolute; top:25%; left:35%; padding:2px; z-index: 1000;"><img
                                src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .bi-question-circle-fill::before {
        float: right;
        margin-right: -4%;
        margin-bottom: 20px;
        margin-top: 30px;
    }
</style>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/moment.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/daterangepicker.min.js') }}></script>
<link rel="stylesheet" href={{ Module::asset('sisdant:css/style.css') }}>
<link rel="stylesheet" href={{ Module::asset('tunas:css/style.css') }}>
<link rel="stylesheet" href={{ Module::asset('sisdant:css/daterangepicker.css') }}>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.nav-list a').removeClass('active');
    }, false);

    $("document").ready(function(){
        var local = window.location.origin;
        var url = "/awas/laporan_pemantauan_tender";
        $('.link[href="'+url+'"]').addClass('active');
    });
</script>
<script>
    var modal2 = document.getElementById("myNav2");
    window.onclick = function(event) {
        if (event.target == modal2) {
            closeNav2();
        }
    }
    function openNav2() {
    document.getElementById("myNav2").style.width = "100%";
    }

    function closeNav2() {
    document.getElementById("myNav2").style.width = "0%";
    }

</script>
<script>
    $(document).ready(
        function () {
            if(@JSON(session('data2')) != null)
                {
                    document.getElementById("profile-tab").click();
                    var filter_tarikhmula = @JSON(session('data2')).tarikhmula;
                    var filter_tarikhakhir = @JSON(session('data2')).tarikhakhir;
                    console.log(filter_tarikhmula + " " + filter_tarikhakhir);
                    if(@JSON(session('data2')).tarikhmula != '')
                    {
                        $('#tarikh').val(moment(filter_tarikhmula).format('DD/MM/YYYY') + ' - ' + moment(filter_tarikhakhir).format('DD/MM/YYYY'));
                    }
                }
        }
    );
    $('#tarikh').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        drops: 'auto',
        locale: {
            cancelLabel: 'Clear'
        }
    });
    $('#tarikh').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });
    $('#tarikh').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    });
    $('#reset').on("click", function () {
        document.getElementById("tarikh").value = '';
        $('#tarikh').trigger('change');
    });
</script>
@endsection
