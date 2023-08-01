
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
<body>
    <form autocomplete="off" id="fileUploadForm" method="post" action="{{ url('/saveresit') }}" enctype="multipart/form-data" style="padding: 10px;">
        <input class="form-control" type="file"  name="dokumen"  id="dokumen" accept=".pdf" style="display:none;">
    </form >
</body>
@stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/backend.js') }}"></script>
    <livewire:scripts />
@stack('after-scripts')
<script>
function upload() {
    document.getElementById('dokumen').click();

}
var selDiv = "";
    document.addEventListener("DOMContentLoaded", init, false);

function init() {
    document.querySelector('#dokumen').addEventListener('change', handleFileSelect, false);
    selDiv = document.querySelector("#selectedFiles_dokumen");

}
function handleFileSelect(e) {
    if(!e.target.files) return;
    document.getElementById('selectedFiles_dokumen').innerHTML = "";
    var files = e.target.files;
    for(var i=0; i<files.length; i++) {
        var count = i;
        var li=document.createElement('a');
        li.setAttribute('id','file'+i);
        var f = files[i];
        li.innerHTML= f.name;
    }
    document.getElementById('selectedFiles_dokumen').appendChild(li);

}
    $( document ).ready(function() {

        var id_petender = @json($rekodPetender->id);
        var status_resit = @json($rekodPetender->status_resit);
        var no_perolehan = @json($no_perolehan->no_perolehan);
        var tarikh_jangka_iklan = @json($date_asal);
        var tarikh_harini = @json($date_today);
        var tajuk = @json($no_perolehan->tajuk_perolehan);

        if( tarikh_harini > tarikh_jangka_iklan ) {
            Swal.fire({
                icon: 'error',
                text: 'Pautan Telah Tamat Tempoh',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
            })
        } else if( status_resit == 'sah'){
            Swal.fire({
                icon: 'info',
                text: 'Resit Bayaran Sebelumnya Telah Disahkan',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
            })
        } else if( tarikh_harini < tarikh_jangka_iklan ) {
            Swal.fire({
                title: 'RESIT BAYARAN',
                html:"<br><label class='form-label'></label>"+tajuk+"<br><label class='form-label'> <br>"+no_perolehan+ "</label> <br><br><input type='button' class='btn btn-outline-primary' value='Muat Naik Resit' onclick='upload()' style='width:100%;'/><br><div id='selectedFiles_dokumen' name='selectedFiles_dokumen' style='width:100%; margin-top:3%;'>",
                confirmButtonText: 'Muat Naik',
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                customClass: 'swal-wide',
                preConfirm: function (file) {
                    file = document.getElementById('dokumen').value;
                    if(file == ''){
                        Swal.showValidationMessage('Sila Pilih Fail')
                    } else {
                        var form = $('#fileUploadForm')[0];
                        var data = new FormData(form);
                        var objArr = [];
                        objArr.push({"no_perolehan": no_perolehan, "id_petender": id_petender});
                        data.append('objArr', JSON.stringify( objArr ));
                        return new Promise(function (resolve) {
                        $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            method: 'post',
                            enctype: 'multipart/form-data',
                            url: '/saveresit',
                            data: data,
                            processData: false,
                            contentType: false,
                        })
                        .done(function (resp) {
                            if(resp.result == true){
                                Swal.hideLoading()
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Resit Berjaya Di Muat Naik',
                                    text: 'Anda akan menerima emel selepas resit disahkan oleh pentadbir',
                                    allowOutsideClick: false,
                                    })
                                .then(function() {
                                    window.close();
                                    // setTimeout (window.close, 5000);
                                });
                            } else {
                                Swal.hideLoading()
                                Swal.fire({ type: 'error', title: 'Oops...', text: 'Sila Cuba Semula!' })
                            }
                        })
                        })
                    }
                }
            })
        }
    });


</script>

<style>
    .swal-wide{
    width:850px !important;
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
<style>
</html>
