<!DOCTYPE HTML>
@extends('sisdant::layouts.master')


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
    <h1>Laporan Daftar Perolehan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
        @include('frontend.includes.partials.breadcrumbs')
    @endif
    </div>

    <section class="section">
        <div style="display: flex;">
            <h5 class="card-title">Laporan Daftar Perolehan</h5>
        </div>
        <div id="myNav" class="overlay">
            <div class="overlay-content">
                <div class="filter-search">
                    <a>Sila pilih untuk carian terperinci</a>
                    <form class="filterform" autocomplete="off" method="POST" action="{{ url('/sisdant/laporan_daftar_perolehan_filter') }}">
                        @csrf
                        <div class="filterbox">
                            <div class="filter" style="width: 350px!important;">
                                <a class="tajuk">NEGERI</a>
                                <select class="js-example-basic-multiple" name="negeri" id="negeri">
                                <option value="" disabled>Sila Pilih</option>
                                @foreach ($negeri as $ne)
                                    <option value="{{ $ne->id }}">{{ $ne->negeri }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="filter">
                                <a class="tajuk">BAHAGIAN</a>
                                <select class="js-example-basic-multiple" name="bahagian" id="bahagian">
                                    <option value="" disabled>Sila Pilih</option>
                                </select>
                            </div>
                            <div class="filter">
                                <a class="tajuk">JENIS IKLAN</a>
                                <select class="js-example-basic-multiple" name="jenisiklan" id="jenis_iklan">
                                    <option value="" disabled>Sila Pilih</option>
                                @foreach ($jenisiklan as $ji)
                                    <option value="{{ $ji->id }}">{{ $ji->nama }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="filter">
                                <a class="tajuk">KATEGORI PEROLEHAN</a>
                                <select class="js-example-basic-multiple" name="kategoriperolehan" id="kategori_perolehan">
                                    <option value="" disabled>Sila Pilih</option>
                                </select>
                            </div>
                            <div class="filter">
                                <a class="tajuk">JENIS PEROLEHAN</a>
                                <select class="js-example-basic-multiple" name="jenisperolehan" id="jenis_perolehan">
                                    <option value="" disabled>Sila Pilih</option>
                                </select>
                            </div>
                            <div class="filter">
                                <a class="tajuk">STATUS</a>
                                <select class="js-example-basic-multiple" name="status" id="status">
                                    <option value="" disabled>Sila Pilih</option>
                                    <option value="sah">SAH</option>
                                    <option value="batal">BATAL</option>
                                    <option value="draf-iklan">DRAF-IKLAN</option>
                                    <option value="iklan">IKLAN</option>
                                </select>
                            </div>
                            <div class="filter">
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
                <button class="btn1 btn-filter" onclick="openNav()"><i class="fas fa-regular fa-filter"></i> Filter</button>
                <br>
                <br>
                @if(!session('data'))
                    <livewire:frontend.laporan-daftar-perolehan-table/>
                @else
                    @livewire('frontend.laporan-daftar-perolehan-table-filtered',['post' => session('data')])
                @endif
                <br>
                <br>
                <div class="spanner">
                    <div id="wait"
                        style="display:none; position:absolute; top:25%; left:35%; padding:2px; z-index: 1000;"><img
                            src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br></div>
                </div>

            </div>
        </div>
    </section>
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
            var url = "/sisdant/laporan_daftar_perolehan";
            $('.link[href="'+url+'"]').addClass('active');
        });

    </script>
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
        var modal = document.getElementById("myNav");
        window.onclick = function(event) {
            if (event.target == modal) {
                closeNav();
            }
        }
    </script>
    <script>
    $(document).ready(
        function () {
            $("head").append($(
                "<link rel='stylesheet' href='{{ Module::asset('sisdant:css/select2.css') }}' type='text/css' media='screen' />"
            ));
            $.getScript("{{ Module::asset('sisdant:js/1_11_1_jquery.min.js') }}", function () {
                $.getScript("{{ Module::asset('sisdant:js/select2.min.js') }}",
                    function () {
                        if (!$('#jenis_iklan').hasClass("select2-hidden-accessible")) {
                            $('#jenis_iklan').select2();
                            $('#jenis_iklan').val('').trigger('change');
                            if(@JSON(session('data')) != null)
                            {
                                var filter_j_iklan = @JSON(session('data')).j_iklan;
                                if(filter_j_iklan != null)
                                {
                                    $('#jenis_iklan').val(filter_j_iklan).trigger('change');;
                                }
                            }
                        } else {
                            $('#jenis_iklan').val('').trigger('change');

                        }

                        if (!$('#negeri').hasClass("select2-hidden-accessible")) {
                            $('#negeri').select2();
                            $('#negeri').val('').trigger('change');
                            if(@JSON(session('data')) != null)
                            {
                                var filter_negeri = @JSON(session('data')).negeri;
                                if(filter_negeri != null)
                                {
                                    $('#negeri').val(filter_negeri).trigger('change');;
                                }
                            }
                        } else {
                            $('#negeri').val('').trigger('change');

                        }

                        if (!$('#bahagian').hasClass("select2-hidden-accessible")) {
                            $('#bahagian').select2();
                            $('#bahagian').val('').trigger('change');
                        } else {
                            $('#bahagian').val('').trigger('change');

                        }

                        if (!$('#status').hasClass("select2-hidden-accessible")) {
                            $('#status').select2();
                            $('#status').val('').trigger('change');
                            if(@JSON(session('data')) != null)
                            {
                                var filter_status = @JSON(session('data')).status;
                                if(filter_status != null)
                                {
                                    $('#status').val(filter_status).trigger('change');;
                                }
                            }
                        } else {
                            $('#status').val('').trigger('change');
                        }

                        if (!$('#kategori_perolehan').hasClass("select2-hidden-accessible")) {
                                $('#kategori_perolehan').select2();
                                $('#kategori_perolehan').val('').trigger('change');
                        } else {
                            $('#kategori_perolehan').val('').trigger('change');

                        }

                        if (!$('#jenis_perolehan').hasClass("select2-hidden-accessible")) {
                                $('#jenis_perolehan').select2();
                                $('#jenis_perolehan').val('').trigger('change');
                        } else {
                            $('#jenis_perolehan').val('').trigger('change');

                        }

                    })
            })

        }

    );
    var negeriSelect = document.getElementById("negeri");
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
    negeriSelect.onchange = function () {
        if (JSON.stringify($('#negeri').select2('data')) !== '[]')
        {
            if($('#negeri').select2('data')[0]['text'] !== "Sila Pilih")
            {
                var negeriselected = $('#negeri').select2('data');
                var result = [];
                for(var i = 0; i < negeriselected.length; i++)
                {
                    result.push(parseInt(negeriselected[i].id));
                }
                $.ajax({
                    url: '/sisdant/bahagian',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'result' : result},
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        $("#wait").css("display", "block");
                        $("div.spanner").addClass("show");
                    },
                    complete: function () {
                        $("#wait").css("display", "none");
                        $("div.spanner").removeClass("show");
                    },
                    success: function(response){
                        document.getElementById("bahagian").disabled = false;
                        $('#bahagian').empty();
                        $('#bahagian').append("<option value='' disabled>Sila Pilih</option>");
                        for (var i = 0; i < response.length; i++) {
                            $('#bahagian').append("<option value='" + response[i].id + "'>"+ response[i].bahagian +"</option>");
                        }
                        if (!$('#bahagian').hasClass(
                                "select2-hidden-accessible")) {
                            $('#bahagian').select2();
                            $('#bahagian').val('').trigger('change');

                        } else {
                            $('#bahagian').val('').trigger('change');
                            if(@JSON(session('data')) != null)
                            {
                                var filter_bahagian = @JSON(session('data')).bahagian;
                                if(filter_bahagian != null)
                                {
                                    $('#bahagian').val(filter_bahagian).trigger('change');
                                }
                            }
                        }

                    }
                });
            } else {
                document.getElementById("bahagian").disabled = true;
            }
        } else {
            document.getElementById("bahagian").disabled = true;
        }
    };
    if(@JSON(session('data')) != null)
    {
        var filter_tarikhmula = @JSON(session('data')).tarikhmula;
        var filter_tarikhakhir = @JSON(session('data')).tarikhakhir;
        if(@JSON(session('data')).tarikhmula != '')
        {
            $('#tarikh').val(moment(filter_tarikhmula).format('DD/MM/YYYY') + ' - ' + moment(filter_tarikhakhir).format('DD/MM/YYYY'));
        }
    }
    $('#reset').on("click", function () {
        document.getElementById("status").value = '';
        $('#status').trigger('change');
        document.getElementById("negeri").value = '';
        $('#negeri').trigger('change');
        document.getElementById("bahagian").value = '';
        $('#bahagian').trigger('change');
        document.getElementById("jenis_iklan").value = '';
        $('#jenis_iklan').trigger('change');
        document.getElementById("kategori_perolehan").value = '';
        $('#kategori_perolehan').trigger('change');
        document.getElementById("jenis_perolehan").value = '';
        $('#jenis_perolehan').trigger('change');
        document.getElementById("tarikh").value = '';
        $('#tarikh').trigger('change');
    });
    var JenisIklan = document.getElementById("jenis_iklan");
    JenisIklan.onchange = function () {
        if (JSON.stringify($('#jenis_iklan').select2('data')) !== '[]')
        {
            if ($('#jenis_iklan').select2('data')[0]['text'] !== "Sila Pilih")
            {
                var jenisIklanSelected = $('#jenis_iklan').select2('data');
                var result = [];
                for(var i = 0; i < jenisIklanSelected.length; i++)
                {
                    result.push(parseInt(jenisIklanSelected[i].id));
                }
                $.ajax({
                    url: '/tunas/getKategori',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'result' : result},
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        $("#wait").css("display", "block");
                        $("div.spanner").addClass("show");
                    },
                    complete: function () {
                        $("#wait").css("display", "none");
                        $("div.spanner").removeClass("show");
                    },
                    success: function(response){
                        document.getElementById("kategori_perolehan").disabled = false;
                        $('#kategori_perolehan').empty();
                        $('#kategori_perolehan').append("<option value='' disabled>Sila Pilih</option>");
                        for (var i = 0; i < response.length; i++) {
                            $('#kategori_perolehan').append("<option value='" + response[i].id + "'>"+ response[i].nama +"</option>");
                        }
                        if (!$('#kategori_perolehan').hasClass(
                                "select2-hidden-accessible")) {
                            $('#kategori_perolehan').select2();
                            $('#kategori_perolehan').val('').trigger('change');

                        } else {
                            $('#kategori_perolehan').val('').trigger('change');
                            if(@JSON(session('data')) != null)
                            {
                                var filter_kategoriperolehan = @JSON(session('data')).k_perolehan;
                                if(filter_kategoriperolehan != null)
                                {
                                    $('#kategori_perolehan').val(filter_kategoriperolehan).trigger('change');;
                                }
                            }
                        }

                    }
                });
            } else {
                document.getElementById("kategori_perolehan").disabled = true;
                document.getElementById("jenis_perolehan").disabled = true;
            }
        } else {
            document.getElementById("kategori_perolehan").disabled = true;
            document.getElementById("jenis_perolehan").disabled = true;
        }
    };
    var k_perolehan = document.getElementById("kategori_perolehan");
    k_perolehan.onchange = function () {
        if (JSON.stringify($('#kategori_perolehan').select2('data')) !== '[]')
        {
            if ($('#kategori_perolehan').select2('data')[0]['text'] !== "Sila Pilih")
            {
                var k_perolehanSelected = $('#kategori_perolehan').select2('data');
                var result = [];
                var jenisIklanSelected = $('#jenis_iklan').select2('data');
                var result2 = [];
                for(var i = 0; i < k_perolehanSelected.length; i++)
                {
                    result.push(parseInt(k_perolehanSelected[i].id));
                }
                for(var i = 0; i < jenisIklanSelected.length; i++)
                {
                    result2.push(parseInt(jenisIklanSelected[i].id));
                }
                $.ajax({
                    url: '/tunas/getJenisPerolehan',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'jns_iklan' : result2, 'kategori' : result},
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        $("#wait").css("display", "block");
                        $("div.spanner").addClass("show");
                    },
                    complete: function () {
                        $("#wait").css("display", "none");
                        $("div.spanner").removeClass("show");
                    },
                    success: function(response){
                        document.getElementById("jenis_perolehan").disabled = false;
                        $('#jenis_perolehan').empty();
                        $('#jenis_perolehan').append("<option value='' disabled>Sila Pilih</option>");
                        for (var i = 0; i < response.length; i++) {
                            $('#jenis_perolehan').append("<option value='" + response[i].id + "'>"+ response[i].nama +"</option>");
                        }
                        if (!$('#jenis_perolehan').hasClass(
                                "select2-hidden-accessible")) {
                            $('#jenis_perolehan').select2();
                            $('#jenis_perolehan').val('').trigger('change');

                        } else {
                            $('#jenis_perolehan').val('').trigger('change');
                            if(@JSON(session('data')) != null)
                            {
                                var filter_jenisperolehan = @JSON(session('data')).j_perolehan;
                                if(filter_jenisperolehan != null)
                                {
                                    $('#jenis_perolehan').val(filter_jenisperolehan).trigger('change');;
                                }
                            }
                        }

                    }
                });
            }

        }
    };
</script>
@endsection
