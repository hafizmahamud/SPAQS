<!doctype html>
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
        <link href={{ url("spaqs/assets/sidebar/style_sidebar.css") }} rel="stylesheet">
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
        <script src={{ url("spaqs/assets/sidebar/script_sidebar.js") }}></script>

        <!-- Template Main JS File -->
        <script src={{ url("spaqs/assets/js/main.js") }}></script>
        <link rel="stylesheet" href={{ Module::asset('sisdant:css/style.css') }}>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <main id="main-sisdant" class="main">
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
    </body>
    <footer class="mt-auto footer">
        <div class="copyright">
            @lang('Copyright') &copy; JPS (SPAQS) 2021
        </div>
    </footer>

</html>

