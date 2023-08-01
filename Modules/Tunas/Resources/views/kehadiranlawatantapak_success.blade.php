
<!DOCTYPE html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Plisca')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <livewire:styles />
    @stack('after-styles')

           <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href={{ url("spaqs/assets/vendor/bootstrap/css/bootstrap.min.css") }} rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href={{ url("spaqs/assets/css/style.css") }} rel="stylesheet">
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</head>

<body>

  <main id="main-template" class="main-template" >


  </main><!-- End #main -->

</body>
@stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <livewire:scripts />
@stack('after-scripts')
<script>

    var status = @json($donesuccess);

    $( document ).ready(function() {

        if( status == "true"){
            Swal.fire({
                title: 'Borang Lawatan Tapak/Taklimat Tender Berjaya Dihantar. Sila semak emel untuk mengisi Borang Saringan Wajib.',
                icon: 'success',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        } else if (status == "trueTIDAKWAJIB") {
            Swal.fire({
                title: 'Borang Pendaftaran Kontraktor Berjaya Dihantar. Sila semak emel untuk mengisi Borang Saringan Wajib.',
                icon: 'success',
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                text: 'Permohonan Gagal Dihantar',
                showCancelButton: false, // There won't be any cancel button
                showConfirmButton: false, // There won't be any confirm button
                allowOutsideClick: false
            })
        }
    });



</script>
</html>