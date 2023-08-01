<!DOCTYPE html>
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
    <form autocomplete="off" id="fileUploadForm" method="post" action="{{ url('/saveresit') }}" enctype="multipart/form-data" style="padding: 10px;">
        <input class="form-control" type="file"  name="dokumen"  id="dokumen" accept=".pdf" style="display:none;">
    </form >
@stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <livewire:scripts />
@stack('after-scripts')
<script>
    $("document").ready(function(){

        var getBorangDaftar = @json($getBorangDaftar);
        Swal.fire({
                html: "<br><embed src='{{ config('app.url').'/'.$getBorangDaftar->resit_path }}' download='test.pdf' type='application/pdf' frameBorder='0' scrolling='auto' height='500px' width='100%'/>"+
                        '<button type="button" role="button" tabindex="0" class="SwalBtn2 customSwalBtn-batal">' + 'Tak Sah' + '</button>'+
                        '<button type="button" role="button" tabindex="0" class="SwalBtn1 customSwalBtn">' + 'Sah' + '</button>' ,
                width: '80%',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false
            })

            $(document).on('click', '.SwalBtn1', function() {
            Swal.fire({
                title: 'Adakah Anda Pasti Untuk Mengesahkan Resit Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Loading...",
                        text: "Sila tunggu",
                        showConfirmButton: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    })
                    var id = getBorangDaftar['id'];
                    var iklan_id = getBorangDaftar['iklan_perolehan_id'];
                    $.ajax({
                        url: '/tunas/saveresitstatus',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        dataType: 'json',
                        data: {'id': id, 'status': "sah"},
                        success: function(response){
                            Swal.fire(
                                '',
                                'Resit Telah Disahkan.',
                                'success'
                            ).then(function() {
                                window.location.href="/tunas/viewiklanbelumtutup/"+iklan_id+"?data2=2"
                            });
                        }
                    });
                } else {
                    var iklan_id = getBorangDaftar['iklan_perolehan_id'];
                    window.location.href="/tunas/viewiklanbelumtutup/"+iklan_id+"?data2=2"
                }
            })
        });
        $(document).on('click', '.SwalBtn2', function() {
            Swal.fire({
                title: 'Adakah Anda Pasti Untuk Membatalkan Resit Ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Loading...",
                        text: "Sila tunggu",
                        showConfirmButton: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    })
                    var id = getBorangDaftar['id'];
                    var iklan_id = getBorangDaftar['iklan_perolehan_id'];
                    $.ajax({
                        url: '/tunas/saveresitstatus',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        dataType: 'json',
                        data: {'id': id, 'status': "gagal"},
                        success: function(response){
                            Swal.fire(
                                '',
                                'Resit Telah Dibatalkan.',
                                'success'
                            ).then(function() {
                                window.location.href="/tunas/viewiklanbelumtutup/"+iklan_id+"?data2=2"
                            });
                        }
                    });
                } else {
                    var iklan_id = getBorangDaftar['iklan_perolehan_id'];
                    window.location.href="/tunas/viewiklanbelumtutup/"+iklan_id+"?data2=2"
                }
            })
        });

    });

</script>

<style>
    .customSwalBtn{
		background-color: #0d6efd;
        border-left-color: #0d6efd;
        border-right-color: #0d6efd;
        border: 0;
        border-radius: 3px;
        box-shadow: none;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        font-weight: 500;
        margin: 30px 5px 0px 5px;
        padding: 10px 32px;
	}

    .customSwalBtn-batal{
		background-color: #fd0d0d;
        border-left-color: #fd0d0d;
        border-right-color: #fd0d0d;
        border: 0;
        border-radius: 3px;
        box-shadow: none;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        font-weight: 500;
        margin: 30px 5px 0px 5px;
        padding: 10px 32px;
	}
</style>

