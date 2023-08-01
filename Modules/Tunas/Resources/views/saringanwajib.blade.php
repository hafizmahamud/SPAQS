
<!DOCTYPE html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Plisca')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <link href={{ url("spaqs/assets/vendor/bootstrap-icons/bootstrap-icons.css") }} rel="stylesheet">
    <link rel="stylesheet" href={{ Module::asset('sisdant:css/style.css') }}>
    <livewire:styles />
    @stack('after-styles')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{ url("spaqs/assets/vendor/bootstrap/css/bootstrap.min.css") }} rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href={{ url("spaqs/assets/css/style.css") }} rel="stylesheet">
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</head>
    <div style="background-color:white; padding:5px;">
        <img id="logo" src="/img/Logo_JPS.png" alt="" style="display:block; margin-left:auto; margin-right:auto; width:10%;"><br>
        <p id="text-logo" style=" text-align:center; font-size:30px; ">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA
        </p>
    </div>

<body>
  <main id="main-template" class="main-template" >
    <section class="section">
        <div style="padding-bottom: 10px;">
            <h5 class="saringanwajib-title" >TAJUK PROJEK : {{$no_perolehan->tajuk_perolehan}}</h5>
            <h4 class="saringanwajib-text" style="font-weight: bolder;">NOMBOR PEROLEHAN PROJEK : {{$no_perolehan->no_perolehan}}</h4>
            <h4 class="saringanwajib-text" >Arahan:</h4>
            <h4 class="saringanwajib-text" >1. Borang Hadir Tapak ini perlu diisi oleh kontraktor yang berminat untuk menyertai tender dan hanya satu borang dibenarkan untuk diisi bagi setiap syarikat.</h4>
            @if ($iklan_perolehan->lawatan_tapak!='TIDAK_WAJIB') {{--tutup sebelum 12 tengah malam--}}
            <h4 class="saringanwajib-text" >2. Tarikh tutup pengisian borang adalah pada {{ $tarikhLawatanTapak }} sebelum jam 12.00 tengah malam.</h4>
            @else
            <h4 class="saringanwajib-text" >2. Tarikh tutup pengisian borang adalah pada {{ $tarikhTutup }} sebelum jam 12.00 tengah malam.</h4>
            @endif
        </div>
        <div style="padding: 20px 0 10px 0; ">
            <h4 style="font-weight:bold;">Borang Saringan Wajib</h4>
        </div>
        <div class="spanner">
            <div id="wait">
              <img src={{url('spaqs/assets/img/loader.gif')}} width="100%" /><br>
            </div>
        </div>
        <form id="myForm" autocomplete="off" method="post" action="{{ url('/savesaringanwajib') }}" enctype="multipart/form-data" >
            @csrf
            @if(config('boilerplate.access.captcha.saringan_wajib'))
            <div class="row">
                <div class="col">
                @captcha
                <input type="hidden" class="g-recaptcha" name="captcha_status" value="true" />
                </div>
            </div>
            @endif
            <input type="hidden"  name="tajuk_perolehan" value="{{$no_perolehan->tajuk_perolehan}}">
            <input type="hidden"  name="no_perolehan" value="{{$no_perolehan->no_perolehan}}">

            <div class="card" style="border-radius: 25px;">
                <div class="card-body">
                    <div class="card-body-template">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">Nama Syarikat Petender</label>
                                <div>
                                    <input type="text" class="form-control" id="nama_syarikat" name="nama_syarikat" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label">No. Telefon</label>
                                <div>
                                    <input type="text" class="form-control" id="notelefon_syarikat" name="notelefon_syarikat" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                        <div class="col-lg-6" >
                            <label class=" form-label">Nama Pegawai Syarikat Yang Ditauliahkan</label>
                            <div>
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6" >
                            <label class=" form-label">No Faks</label>
                            <div>
                                <input type="text" class="form-control" id="nofaks_syarikat" name="nofaks_syarikat" readonly>
                            </div>
                        </div>
                        </div>

                        <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class=" form-label">Jawatan</label>
                            <div>
                                <input type="text" class="form-control" id="jawatan_pegawai" name="jawatan_pegawai" readonly>
                            </div>
                            <br>
                            <label class="form-label">E-mel Rasmi</label>
                            <div>
                                <input type="text" class="form-control" id="email_syarikat" name="email_syarikat" readonly>
                            </div>
                        </div>
                            <div class="col-lg-6" >
                                <label for="inputPassword" class=" form-label">Alamat Syarikat</label>
                                {{-- <div>
                                    <textarea class="form-control" style="height: 140px" id="alamat" name="alamat" readonly></textarea>
                                </div> --}}
                                <div style="margin-top:1%">
                                    <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                                </div>
                                <div style="margin-top:1%">
                                <input type="text" class="form-control" id="alamat2" name="alamat2" readonly>
                                </div>
                                <div style="margin-top:1%">
                                <input type="text" class="form-control" id="alamat3" name="alamat3" readonly>
                                </div>
                                <div style="margin-top:1%">
                                <input type="text" class="form-control" id="alamat4" name="alamat4" readonly>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="card-body-template" id="mof" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">No. Sijil Pendaftaran Kementerian Kewangan (MOF)</label><a style="color: red;">*</a>
                                <div>
                                    <input type="text" name="no_MOF" class="form-control"  onkeyup="success()">
                                </div>
                            </div>

                            <div class="col-lg-6" >
                                <label class=" form-label">Tarikh Tamat Pendaftaran MOF</label><a style="color: red;">*</a>
                                <div>
                                    <input type="date" name="tarikh_MOF" id="tarikh_MOF" class="form-control" onchange="success()">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-lg-6">
                                <label class=" form-label">Kod dan Subbidang</label><a style="color: red;">*</a>
                                <div>
                                    @foreach ($getbidang as $indexKey =>$d)
                                        <input type="checkbox" name="subbidang{{$indexKey}}" value="{{$d->id}}" onchange="success()">
                                        <label for="subbidang{{$indexKey}}">{{$d->kod}} - {{$d->sub_bidang}}</label><br>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Sijil Pendaftaran MOF</label><a style="color: red;">*</a>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <input for="upload_MOF" type="button" class="btn btn-outline-primary" value="Muat Naik" onclick="document.getElementById('upload_MOF').click();" style="width: 100%;" />
                                        <input class="form-control" type="file" id="upload_MOF" name="upload_MOF" style="display:none;" accept=".pdf" onchange="success()">
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="fail_MOF" name="fail_MOF"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card-body-template" id="cidb" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">No. Sijil Pendaftaran CIDB</label><a style="color: red;">*</a>
                                <div>
                                    <input type="text" name="no_CIDB" id="no_CIDB" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6" >
                                <label class=" form-label">Tarikh Tamat Pendaftaran CIDB</label><a style="color: red;">*</a>
                                <div>
                                    <input type="date" name="tarikh_CIDB" id="tarikh_CIDB" class="form-control" onchange="success()">
                                </div>
                            </div>


                        </div>

                        <div class="row mb-3">

                            <div class="col-lg-6">
                                <label class=" form-label" style="font-weight: bold;">Gred</label>
                                <select class="form-select" name="gred" id="gred">
                                    <option value="">Sila Pilih</option>
                                    @foreach ($grade as $gred)
                                    <option value="{{ $gred->id }}">{{ $gred->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Sijil Pendaftaran CIDB</label><a style="color: red;">*</a>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <input for="upload_CIDB" type="button" class="btn btn-outline-primary" value="Muat Naik" onclick="document.getElementById('upload_CIDB').click();" style="width: 100%;" />
                                        <input class="form-control" type="file" id="upload_CIDB" name="upload_CIDB" style="display:none;" accept=".pdf" onchange="success()">
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="fail_CIDB" name="fail_CIDB"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-lg-6">
                                <label class=" form-label">Kelas dan Pengkhususan CIDB</label>
                                <div>
                                    @foreach ($getkelas as $indexKey =>$d)
                                        <input type="checkbox"  name="pengkhususan{{$indexKey}}" value="{{$d->id}}" onchange="success()">
                                        <label for="pengkhususan{{$indexKey}}">{{$d->kod}} - {{$d->pengkhususan}}</label><br>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-lg-6">
                                    <div>
                                        <label class=" form-label">Sijil Kebenaran Khas</label>
                                        <i class="bi bi-info-circle-fill"></i>
                                        <span class="tooltip-text" style="font-weight: bold; right:100px;">
                                            <a style="font-size: 12px; font-weight: bold; border-radius: 10px; color: black;display: inline-block; cursor: pointer; text-align: left;">
                                                Sila muat naik jika gred dan kelas/pengkhususan CIDB tidak berkaitan .</a>
                                        </span>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <input for="upload_KK" type="button" class="btn btn-outline-primary" value="Muat Naik"onclick="document.getElementById('upload_KK').click();" style="width: 100%;" />
                                            <input class="form-control" type="file" id="upload_KK" name="upload_KK" style="display:none;" accept=".pdf" onchange="success()" >
                                        </div>
                                        <div class="col-lg-8">
                                            <div id="fail_KK" name="fail_KK"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card-body-template" id="spkk" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">No. Sijil Pendaftaran Perolehan Kerja Kerajaan (SPKK)</label><a style="color: red;">*</a>
                                <div>
                                    <input type="text" name="no_SPKK" class="form-control" onkeyup="success()">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class=" form-label">Sijil Pendaftaran SPKK</label><a style="color: red;">*</a>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <input for="upload_SPKK" type="button" class="btn btn-outline-primary" value="Muat Naik"onclick="document.getElementById('upload_SPKK').click();" style="width: 100%;" />
                                        <input class="form-control" type="file" id="upload_SPKK" name="upload_SPKK" style="display:none;" accept=".pdf" onchange="success()" >
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="fail_SPKK" name="fail_SPKK"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">Tarikh Tamat Pendaftaran SPKK</label><a style="color: red;">*</a>
                                <div>
                                    <input type="date" name="tarikh_SPKK" id="tarikh_SPKK" class="form-control" onchange="success()">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-body-template" id="pukonsa" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">No. Sijil Pendaftaran PUKONSA</label><a style="color: red;">*</a>
                                <div>
                                    <input type="text" name="no_PUKONSA" class="form-control" onkeyup="success()">
                                </div>
                            </div>

                            <div class="col-lg-6" >
                                <label class=" form-label">Tarikh Tamat Pendaftaran Pukonsa</label><a style="color: red;">*</a>
                                <div>
                                    <input type="date" name="tarikh_PUKONSA" id="tarikh_PUKONSA" class="form-control" onchange="success()">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class=" form-label">Kelas dan Pengkhususan Pukonsa</label>
                                <div>
                                    @foreach ($getPukonsa as $indexKey =>$d)
                                        <input type="checkbox"  name="pukonsa{{$indexKey}}" value="{{$d->id}}" onchange="success()">
                                        <label for="pukonsa{{$indexKey}}" style="display: contents;"> {{$d->tajuk_besar}} - {{$d->tajuk_kecil}}</label><br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class=" form-label">Sijil Pendaftaran PUKONSA</label><a style="color: red;">*</a>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <input for="upload_PUKONSA" type="button" class="btn btn-outline-primary" value="Muat Naik"onclick="document.getElementById('upload_PUKONSA').click();" style="width: 100%;" />
                                        <input class="form-control" type="file" id="upload_PUKONSA" name="upload_PUKONSA" style="display:none;" accept=".pdf" onchange="success()">
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="fail_PUKONSA" name="fail_PUKONSA"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-body-template" id="upkj" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">No. Sijil Pendaftaran UPKJ</label><a style="color: red;">*</a>
                                <div>
                                    <input type="text" name="no_UPKJ" class="form-control" onkeyup="success()">
                                </div>
                            </div>
                            <div class="col-lg-6" >
                                <label class=" form-label">Tarikh Tamat Pendaftaran UPKJ</label><a style="color: red;">*</a>
                                <div>
                                    <input type="date" name="tarikh_UPKJ" id="tarikh_UPKJ" class="form-control" onchange="success()">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label class=" form-label">Kelas dan Pengkhususan UPKJ</label>
                                <div>
                                    @foreach ($getUpkj as $indexKey =>$d)
                                        <input type="checkbox"  name="upkj{{$indexKey}}" value="{{$d->id}}" onchange="success()">
                                        <label for="upkj{{$indexKey}}" style="display: contents;"> {{$d->tajuk_besar}} - {{$d->tajuk_kecil}}</label><br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class=" form-label">Sijil Pendaftaran UPKJ</label><a style="color: red;">*</a>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <input for="upload_UPKJ" type="button" class="btn btn-outline-primary" value="Muat Naik"onclick="document.getElementById('upload_UPKJ').click();" style="width: 100%;" />
                                        <input class="form-control" type="file" id="upload_UPKJ" name="upload_UPKJ" style="display:none;" accept=".pdf" onchange="success()">
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="fail_UPKJ" name="fail_UPKJ"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-body-template" id="taraf_bumiputera" style="display:none;">
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">No. Sijil Pendaftaran Taraf Bumiputera</label><a style="color: red;">*</a>
                                <div>
                                    <input type="text" name="no_taraf" class="form-control" onkeyup="success()">
                                </div>
                            </div>

                            <div class="col-lg-6" >
                                <label class=" form-label">Tarikh Tamat pendaftaran Sijil Taraf Bumiputera</label><a style="color: red;">*</a>
                                <div>
                                    <input type="date" name="tarikh_TB" id="tarikh_TB" class="form-control" onchange="success()">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6" >
                                <label class=" form-label">Sijil Taraf Bumiputera</label><a style="color: red;">*</a>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <input for="upload_TB" type="button" class="btn btn-outline-primary" value="Muat Naik"  onclick="document.getElementById('upload_TB').click();" style="width: 100%;" />
                                        <input class="form-control" type="file" id="upload_TB" name="upload_TB" style="display:none;" accept=".pdf" onclick="success()" >
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="fail_TB" name="fail_TB"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin: 10px;">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe" onchange="success()">
                            <label class="form-check-label" for="rememberMe" style="color: black; text-align: justify;">
                                <b>PENGAKUAN:</b> Kami mengaku bahawa semua maklumat dan data yang kami berikan melalui Borang  ini adalah semuanya benar dan kami telah mengambil maklum dan sedar akan tindakan yang boleh diambil oleh Kerajaan terhadap kami dan/atau tender kami, sekiranya mana-mana maklumat dan data yang kami berikan itu didapati tidak benar dan palsu.
                            </label>
                            <input class="form-control" type="text" name="iklan_perolehan_id" value="{{$iklan_perolehan->id}}" style="display:none;">
                            <input class="form-control" type="text" name="no_syarikat" id="no_syarikat" style="display:none;">
                            <input class="form-control" type="text" name="kehadiran_lawatan_tapak_id" id="kehadiran_lawatan_tapak_id" style="display:none;">
                            <input class="form-control" type="text" name="no_siri" id="no_siri" style="display:none;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="button-form" style="margin-bottom: 100px;">
                <button class="btn btn-primary" id="hantar" name="hantar" type="submit"  style="width: 10%;" disabled>Hantar</button>
            </div>
        </form>
      </section>


  </main><!-- End #main -->

</body>
@stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <livewire:scripts />
@stack('after-scripts')
<script>
    var bahagian_1 = @json($borang_daftar->bahagian_1);
    var bahagian_2 = @json($borang_daftar->bahagian_2);
    var bahagian_3 = @json($borang_daftar->bahagian_3);
    var bahagian_4 = @json($borang_daftar->bahagian_4);
    var bahagian_5 = @json($borang_daftar->bahagian_5);
    var bahagian_6 = @json($borang_daftar->bahagian_6);
    var bahagian_7 = @json($borang_daftar->bahagian_7);
    var status = @json($status);

    $( document ).ready(function() {

        var no = @json($iklan_perolehan->id);
        var tarikh_jangka_iklan = @json($date_asal);
        var tarikh_harini = @json($date_today);
        var jenisLawatanTapak = @json($iklan_perolehan->lawatan_tapak);
        var tarikhLawatanTapak = @json($tarikhLawatanTapak);
        var todayYmd = @json($todayYmd);
        var todayNow = @json($todayNow);
        var todayDT = todayYmd + " " + todayNow;
        var starttime = @json($waktuLaporHI);
        var tarikhMula = @json($tarikhMula)+ " " + starttime;
        var tarikhTutup = @json($tarikhTutup)+ " " + "23:59";
        var data_syarikat = '';
        var today = new Date();
            today = new Date(today.setDate(today.getDate())).toISOString().split('T')[0];

        if( bahagian_1 == true) {
            document.getElementById("spkk").style.display = "block";
            document.getElementsByName("tarikh_SPKK")[0].setAttribute('min', today );
        }

        if( bahagian_2 == true) {
            document.getElementById("taraf_bumiputera").style.display = "block";
            document.getElementsByName("tarikh_TB")[0].setAttribute('min', today );
        }

        if( bahagian_3 == true) {
            document.getElementById("pukonsa").style.display = "block";
            document.getElementsByName("tarikh_PUKONSA")[0].setAttribute('min', today );
        }

        // if( bahagian_4 == true) {
        //     document.getElementById("mof").style.display = "block";
        //     document.getElementsByName("tarikh_MOF")[0].setAttribute('min', today );
        // }

        if( bahagian_5 == true) {
            document.getElementById("cidb").style.display = "block";
            document.getElementsByName("tarikh_CIDB")[0].setAttribute('min', today );
        }


        if( bahagian_7 == true) {
            document.getElementById("upkj").style.display = "block";
            document.getElementsByName("tarikh_UPKJ")[0].setAttribute('min', today );
        }

        if (jenisLawatanTapak != "TIDAK_WAJIB") { // LAWATAN TAPAK : WAJIB | ONLINE
            if (tarikhLawatanTapak == todayYmd && todayNow < '23:59'){
                Swal.fire({
                title: 'Borang Saringan Wajib',
                html: "<br><label class='form-label'>Nombor Siri Borang Lawatan Tapak/Taklimat Tender :</label><br><input type='text' id='no_lawatan' onkeyup='this.value = this.value.toUpperCase();' class='form-control'><br><label class='form-label'>Nombor CIDB Syarikat :</label><br><input type='text' id='no_mof' class='form-control' onkeyup='this.value = this.value.toUpperCase();'><br>",
                confirmButtonText: 'Semak',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                footer: '<a>Sila rujuk e-mel bagi mendapatkan no. siri Borang Lawatan Tapak</a>',
                preConfirm: function (login) {
                    if (document.getElementById('no_lawatan').value && document.getElementById('no_mof').value) {
                        var no_lawatan = document.getElementById('no_lawatan').value;
                        var no_mof = document.getElementById('no_mof').value;
                        return new Promise(function (resolve) {
                        $.ajax({
                            url: '/checknosiri',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method: 'post',
                            data:{id:no, nosiri:no_lawatan, mof:no_mof},
                        })
                        // in case of successfully understood ajax response
                            .done(function (myAjaxJsonResponse) {
                                if(myAjaxJsonResponse.length == 1) {
                                    if(myAjaxJsonResponse[0] == false) {
                                        Swal.hideLoading()
                                        Swal.showValidationMessage(
                                        'Nombor Siri Lawatan atau No Pendaftaran CIDB tidak tepat'
                                        )
                                    }
                                    else {
                                        Swal.hideLoading()
                                        Swal.showValidationMessage(
                                        'Anda sudah menghantar borang saringan wajib'
                                        )

                                    }
                                } else {
                                    document.getElementById("no_syarikat").value = myAjaxJsonResponse[1].no_syarikat;
                                    document.getElementById("no_CIDB").value = myAjaxJsonResponse[1].no_syarikat;
                                    document.getElementById("no_siri").value = myAjaxJsonResponse[1].no_siri;
                                    document.getElementById("kehadiran_lawatan_tapak_id").value = myAjaxJsonResponse[1].id;
                                    document.getElementById("nama_syarikat").value = myAjaxJsonResponse[1].name_syarikat;
                                    document.getElementById("notelefon_syarikat").value = myAjaxJsonResponse[1].notel;
                                    document.getElementById("nama_pegawai").value = myAjaxJsonResponse[1].nama_pegawai_ditauliah;
                                    document.getElementById("nofaks_syarikat").value = myAjaxJsonResponse[1].nofax;
                                    document.getElementById("jawatan_pegawai").value = myAjaxJsonResponse[1].jawatan;
                                    document.getElementById("alamat").value = myAjaxJsonResponse[1].alamat;
                                    document.getElementById("alamat2").value = myAjaxJsonResponse[1].alamat2;
                                    document.getElementById("alamat3").value = myAjaxJsonResponse[1].alamat3;
                                    document.getElementById("alamat4").value = myAjaxJsonResponse[1].poskod + ', ' + myAjaxJsonResponse[1].bandar + ' ' + myAjaxJsonResponse[1].negeri;
                                    document.getElementById("email_syarikat").value = myAjaxJsonResponse[1].emel;
                                    Swal.close();
                                }
                            })

                        })
                    } else {
                        Swal.showValidationMessage('Isi nombor lawatan')
                    }
                },
            })
            } else {
                Swal.fire({
                icon: 'error',
                text: 'Pengisian Borang Ditutup',
                showCancelButton: false, // There won't be any cancel button
                showConfirmButton: false, // There won't be any confirm button
                allowOutsideClick: false
                })
            }
        } else { // LAWATAN TAPAK : TIDAK WAJIB
            if (todayDT < tarikhMula) {
                Swal.fire({
                    text: 'Pengisian Borang Belum Bermula.',
                    icon: 'error',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });
            } else if (todayDT >= tarikhTutup) {
                Swal.fire({
                text: 'Pengisian Borang Telah Ditutup.',
                icon: 'error',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false
                });
            } else {
                Swal.fire({
                title: 'Borang Saringan Wajib',
                html: "<br><label class='form-label'>Nombor Siri Borang Lawatan Tapak/Taklimat Tender :</label><br><input type='text' id='no_lawatan' onkeyup='this.value = this.value.toUpperCase();' class='form-control'><br><label class='form-label'>Nombor CIDB Syarikat :</label><br><input type='text' id='no_mof' class='form-control' onkeyup='this.value = this.value.toUpperCase();'><br>",
                confirmButtonText: 'Semak',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                footer: '<a>Sila rujuk e-mel bagi mendapatkan no. siri Borang Lawatan Tapak</a>',
                preConfirm: function (login) {
                    if (document.getElementById('no_lawatan').value && document.getElementById('no_mof').value) {
                        var no_lawatan = document.getElementById('no_lawatan').value;
                        var no_mof = document.getElementById('no_mof').value;
                        return new Promise(function (resolve) {
                        $.ajax({
                            url: '/checknosiri',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            method: 'post',
                            data:{id:no, nosiri:no_lawatan, mof:no_mof},
                        })
                        // in case of successfully understood ajax response
                            .done(function (myAjaxJsonResponse) {
                                if(myAjaxJsonResponse.length == 1) {
                                    if(myAjaxJsonResponse[0] == false) {
                                        Swal.hideLoading()
                                        Swal.showValidationMessage(
                                        'Nombor Siri Lawatan atau No Pendaftaran CIDB tidak tepat'
                                        )
                                    }
                                    else {
                                        Swal.hideLoading()
                                        Swal.showValidationMessage(
                                        'Anda sudah menghantar borang saringan wajib'
                                        )

                                    }
                                } else {
                                    document.getElementById("no_syarikat").value = myAjaxJsonResponse[1].no_syarikat;
                                    document.getElementById("no_CIDB").value = myAjaxJsonResponse[1].no_syarikat;
                                    document.getElementById("no_siri").value = myAjaxJsonResponse[1].no_siri;
                                    document.getElementById("kehadiran_lawatan_tapak_id").value = myAjaxJsonResponse[1].id;
                                    document.getElementById("nama_syarikat").value = myAjaxJsonResponse[1].name_syarikat;
                                    document.getElementById("notelefon_syarikat").value = myAjaxJsonResponse[1].notel;
                                    document.getElementById("nama_pegawai").value = myAjaxJsonResponse[1].nama_pegawai_ditauliah;
                                    document.getElementById("nofaks_syarikat").value = myAjaxJsonResponse[1].nofax;
                                    document.getElementById("jawatan_pegawai").value = myAjaxJsonResponse[1].jawatan;
                                    document.getElementById("alamat").value = myAjaxJsonResponse[1].alamat;
                                    document.getElementById("alamat").value = myAjaxJsonResponse[1].alamat;
                                    document.getElementById("alamat2").value = myAjaxJsonResponse[1].alamat2;
                                    document.getElementById("alamat3").value = myAjaxJsonResponse[1].alamat3;
                                    document.getElementById("alamat4").value = myAjaxJsonResponse[1].poskod + ', ' + myAjaxJsonResponse[1].bandar + ' ' + myAjaxJsonResponse[1].negeri;
                                    document.getElementById("email_syarikat").value = myAjaxJsonResponse[1].emel;
                                    Swal.close();
                                }
                            })

                        })
                    } else {
                        Swal.showValidationMessage('Isi nombor lawatan')
                    }
                },
            })
            }
        }
    });

        function success() {
            var inputs_text, index;
            var count = 0;

            if( bahagian_1 == true) {
                inputs_text = document.querySelectorAll('#spkk input');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( bahagian_2 == true) {
                inputs_text = document.querySelectorAll('#taraf_bumiputera input');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( bahagian_3 == true) {
                inputs_text = document.querySelectorAll('#pukonsa input');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            // if( bahagian_4 == true) {
            //     inputs_text = document.querySelectorAll('#mof input');
            //     for (index = 0; index < inputs_text.length; ++index) {
            //         if(inputs_text[index].value == '') {
            //             count++;
            //         }
            //     }

            //     inputs_cb = document.querySelectorAll('#mof input[type=checkbox]:checked');
            //     var check = document.querySelectorAll('#mof input[type=checkbox]').length;
            //         if(inputs_cb.length != check) {
            //             count++;
            //         }
            //  }

            if( bahagian_5 == true) {
                var tar_cidb = document.getElementById("tarikh_CIDB").value;
                var file_cidb = document.getElementById("upload_CIDB").value;
                if(tar_cidb== '' ) {
                    count++;
                }
                if( file_cidb== '') {
                    count++;
                }

            }

            if( bahagian_7 == true) {
                inputs_text = document.querySelectorAll('#upkj input');
                for (index = 0; index < inputs_text.length; ++index) {
                    if(inputs_text[index].value == '') {
                        count++;
                    }
                }
            }

            if( document.getElementById("rememberMe").checked == false) {
                count++;
            }

            if( count > 0 ){
                document.getElementById('hantar').disabled = true;
            } else {
                document.getElementById('hantar').disabled = false;
            }
        }

        // show file name MOF
        // var MOF = "";
        // document.addEventListener("DOMContentLoaded", init_MOF, false);

        // function init_MOF() {
        // document.querySelector('#upload_MOF').addEventListener('change', handleFileSelect_MOF, false);
        // MOF = document.querySelector("#fail_MOF");
        // }

        // function handleFileSelect_MOF(e) {
        // var ul=document.createElement('ul');
        // if(!e.target.files) return;
        // MOF.innerHTML = "";
        // var files = e.target.files;
        // for(var i=0; i<files.length; i++) {
        //     var count = i;
        //     var li=document.createElement('li');
        //     li.setAttribute('id','mof'+i);
        //     var f = files[i];
        //     li.innerHTML= f.name;
        //     ul.appendChild(li);
        // }
        // document.getElementById('fail_MOF').appendChild(ul);
        // }
        // end file

        // show file name CIDB
        var CIDB = "";
        document.addEventListener("DOMContentLoaded", init_CIDB, false);

        function init_CIDB() {
          document.querySelector('#upload_CIDB').addEventListener('change', handleFileSelect_CIDB, false);
          CIDB = document.querySelector("#fail_CIDB");
        }

        function handleFileSelect_CIDB(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          CIDB.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','cidb'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('fail_CIDB').appendChild(ul);
        }
        // end file

        // show file name SPKK
        var SPKK = "";
        document.addEventListener("DOMContentLoaded", init_SPKK, false);

        function init_SPKK() {
          document.querySelector('#upload_SPKK').addEventListener('change', handleFileSelect_SPKK, false);
          SPKK = document.querySelector("#fail_SPKK");
        }

        function handleFileSelect_SPKK(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          SPKK.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','SPKK'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('fail_SPKK').appendChild(ul);
        }
        // end file

        // show file name PUKONSA
        var PUKONSA = "";
        document.addEventListener("DOMContentLoaded", init_PUKONSA, false);

        function init_PUKONSA() {
          document.querySelector('#upload_PUKONSA').addEventListener('change', handleFileSelect_PUKONSA, false);
          PUKONSA = document.querySelector("#fail_PUKONSA");
        }

        function handleFileSelect_PUKONSA(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          PUKONSA.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','PUKONSA'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('fail_PUKONSA').appendChild(ul);
        }
        // end file

        // show file name UPKJ
        var UPKJ = "";
        document.addEventListener("DOMContentLoaded", init_UPKJ, false);

        function init_UPKJ() {
          document.querySelector('#upload_UPKJ').addEventListener('change', handleFileSelect_UPKJ, false);
          UPKJ = document.querySelector("#fail_UPKJ");
        }

        function handleFileSelect_UPKJ(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          UPKJ.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','UPKJ'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('fail_UPKJ').appendChild(ul);
        }
        // end file

        // show file name KK
        var KK = "";
        document.addEventListener("DOMContentLoaded", init_KK, false);

        function init_KK() {
          document.querySelector('#upload_KK').addEventListener('change', handleFileSelect_KK, false);
          KK = document.querySelector("#fail_KK");
        }

        function handleFileSelect_KK(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          KK.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','KK'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('fail_KK').appendChild(ul);
        }
        // end file

        // show file name TB
        var TB = "";
        document.addEventListener("DOMContentLoaded", init_TB, false);

        function init_TB() {
          document.querySelector('#upload_TB').addEventListener('change', handleFileSelect_TB, false);
          TB = document.querySelector("#fail_TB");
        }

        function handleFileSelect_TB(e) {
          var ul=document.createElement('ul');
          if(!e.target.files) return;
          TB.innerHTML = "";
          var files = e.target.files;
          for(var i=0; i<files.length; i++) {
            var count = i;
            var li=document.createElement('li');
            li.setAttribute('id','TB'+i);
            var f = files[i];
            li.innerHTML= f.name;
            ul.appendChild(li);
          }
          document.getElementById('fail_TB').appendChild(ul);
        }
        // end file
    $( "form" ).submit(function( event ) {
        $("#wait").css("display", "block");
        $("div.spanner").addClass("show");
    });

</script>

<style>
    .form-label{
        font-weight:bold;
    }

    .grecaptcha-badge {
        /* right: 0 !important; */
        bottom: 200 !important;
        type: hidden;
    }

    @media only screen and (max-width: 600px) {
        #logo{
            width:25% !important;
        }

        #text-logo{
            font-size: 20px !important;
        }

        #hantar{
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 900px) {


        #hantar{
            width: 100% !important;
        }
    }
<style>


</html>
