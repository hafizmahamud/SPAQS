<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
        <title>{{ appName() }} | @yield('title')</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Plisca')">
        @yield('meta')

        @stack('before-styles')
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
        <link rel="stylesheet" href={{ Module::asset('sisdant:css/style.css') }}>
        <link href={{ url("spaqs/assets/sidebar/style_sidebar.css") }} rel="stylesheet">
        <link rel="stylesheet" href={{ Module::asset('tunas:css/style.css') }}>
        <script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
        <script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
        <livewire:styles />
        @stack('after-styles')

        <!-- Google Fonts -->
        <link href={{ url('spaqs/assets/css/font.css') }} rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href={{ url("spaqs/assets/vendor/bootstrap/css/bootstrap.min.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/bootstrap-icons/bootstrap-icons.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/boxicons/css/boxicons.min.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/quill/quill.snow.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/quill/quill.bubble.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/remixicon/remixicon.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/simple-datatables/style.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/line-awesome/css/line-awesome.min.css") }} rel="stylesheet">
        <link href={{ url("spaqs/assets/vendor/mdi/css/materialdesignicons.min.css") }} rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href={{ url("spaqs/assets/css/style.css") }} rel="stylesheet">
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src={{ url("spaqs/assets/vendor/apexcharts/apexcharts.min.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/chart.js/chart.min.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/echarts/echarts.min.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/quill/quill.min.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/simple-datatables/simple-datatables.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/tinymce/tinymce.min.js") }}></script>
        <script src={{ url("spaqs/assets/vendor/php-email-form/validate.js") }}></script>

        <!-- Template Main JS File -->
        <script src={{ url("spaqs/assets/js/main.js") }}></script>
    </head>
    {{-- navbar --}}
    @auth
    @if ($logged_in_user)
    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('frontend.includes.nav')
    </header>
    @endif
    @endauth
    {{-- end navbar --}}

    <body class="d-flex flex-column min-vh-100">
        <div class="sidebarAWAS">
            <div class="logo-details">
            <img src={{ url("spaqs/assets/img/Logo_JPS.png") }} alt="" style="width: 12%;margin: 7px;">
                <div class="logo_name">AWAS</div>
                <i class='bx bx-menu' id="btn" ></i>
            </div>
            <ul class="nav-list">
            <li>
                <a href="/dashboard">
                    <i class="las la-home"></i>
                    <span class="links_name">Menu Utama</span>
                </a>
                <span class="tooltip">Menu Utama</span>
            </li>
            @if(in_array('PENDAFTAR PENILAI', $peranan))
            <li>
                <a href="/awas" class="link">
                    <i class="las la-edit"></i>
                    <span class="links_name">Penilaian
                    @if(in_array('PENILAIAN', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                    </span>
                </a>
                <span class="tooltip">Penilaian
                    @if(in_array('PENILAIAN', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                </span>
            </li>
            <li>
            <a href="/awas/suratPerakuan" class="link">
                <i class="la la-file-text-o"></i>
                <span class="links_name">Surat Perakuan
                    @if(in_array('SURAT KE KASA', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                </span>
            </a>
            <span class="tooltip">Surat Perakuan
                @if(in_array('SURAT KE KASA', $status))
                    <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                @endif
            </span>
            </li>
            <li>
            <a href="/awas/suratLanjutan" class="link">
                <i class="la la-file-text-o"></i>
                <span class="links_name">Surat Lanjutan</span>
            </a>
            <span class="tooltip">Surat Lanjutan</span>
            </li>
            @endif
            @if(in_array('PENDAFTAR KEPUTUSAN LP', $peranan))
            <li>
                <a href="/awas/keputusan" class="link">
                    <i class="las la-file"></i>
                    <span class="links_name">Keputusan
                    @if(in_array('KEPUTUSAN PORTAL', $status) || in_array('KEPUTUSAN EP', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                    </span>
                </a>
                <span class="tooltip">Keputusan
                    @if(in_array('KEPUTUSAN PORTAL', $status) || in_array('KEPUTUSAN EP', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                </span>
            </li>
            @endif
            @if(in_array('PENYEDIA DOKUMEN', $peranan))
            <li>
                <a href="/awas/senarai_petender_berjaya" class="link">
                    <i class="las la-trophy"></i>
                    <span class="links_name">Senarai Petender Berjaya
                    @if(in_array('DOKUMEN SST', $status) || in_array('DOKUMEN KONTRAK', $status))
                        <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                    @endif
                    </span>
                </a>
                <span class="tooltip">Senarai Petender Berjaya
                @if(in_array('DOKUMEN SST', $status) || in_array('DOKUMEN KONTRAK', $status))
                    <i class="bi bi-exclamation-circle-fill" style="color:red; font-size:13px"></i>
                @endif
                </span>
            </li>
            @endif
            <li>
            <a href="/awas/laporan_pemantauan_tender" class="link">
            <i class="las la-file-image"></i>
                <span class="links_name">Laporan Pemantauan Tender</span>
            </a>
            <span class="tooltip">Laporan Pemantauan Tender</span>
            </li>
            </ul>
        </div>

        <main id="main-sisdant" class="main" style="margin-top: 30px">
            @include('includes.partials.messages')
            <div id="app"></div>
            @yield('content')
        </main>

        @stack('before-scripts')
            <script src="{{ mix('js/manifest.js') }}"></script>
            <script src="{{ mix('js/vendor.js') }}"></script>
            <script src="{{ mix('js/frontend.js') }}"></script>
            <script src="{{ mix('js/backend.js') }}"></script>
            <livewire:scripts />
            @stack('after-scripts')
            <script src={{ url('spaqs/assets/sidebar/script_sidebar.js') }}></script>
    </body>
    <footer class="mt-auto footer">
        <div class="copyright">
            @lang('Copyright') &copy; JPS (SPAQS) 2021
        </div>
    </footer>
</html>
