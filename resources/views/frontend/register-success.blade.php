@extends('frontend.layouts.app')

@section('title', __('Register-Success'))

@section('content')
<main style="background: url(spaqs/assets/img/login_background.png) no-repeat center center fixed;background-size: cover;">
<div class="container" >

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  
</section>
</div>
</main>




<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    Swal.fire({
      title: 'Pendaftaran Berjaya!',
      text: 'Pendaftaran anda telah berjaya dihantar kepada Pentadbir Sistem.',
      icon: 'success',
      confirmButtonText: 'Log Masuk',
      timer: 10000
    }).then((result) => {
      window.location='/login'
    });
</script>