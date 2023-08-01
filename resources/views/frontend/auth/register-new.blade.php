@extends('frontend.layouts.app')

@section('title', __('Register'))

@section('content')
<main style="background: url(/img/login_background.png) no-repeat center center fixed;background-size: cover;">
    <div class="container" >

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center" style="width: 45%;">

              <div class="d-flex justify-content-center">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="/img/Logo_JPS.png" alt="">
                </a>
              </div>
              <div class="d-flex justify-content-center">
                <span class="title-login d-none d-lg-block">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA</span>
              </div>
              <!-- End Logo -->

              <div class="mb-3">

                <div class="card-body">

                  <div>
                    <h5 class="card-title-login text-center">PENDAFTARAN</h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>
                    
                        <div class="col-12">
                            <div class="input-group has-validation">
                              <input type="text" name="username" class="form-control-login" id="fullname" placeholder="Nama Penuh" required>
                              <div class="invalid-feedback">Sila Masukkan Nama Penuh Anda.</div>
                            </div>
                          </div>
                    
                        <div class="col-6">
                            <div class="input-group has-validation">
                              <input type="text" name="nokp" class="form-control-login" id="Nokp" placeholder="No Kad Pengenalan" required>
                              <div class="invalid-feedback">Sila Masukkan No Kad Pengenalan Anda.</div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="input-group has-validation">
                              <input type="text" name="email" class="form-control-login" id="email" placeholder="E-mel" required>
                              <div class="invalid-feedback">Sila Masukkan E-mel Anda.</div>
                            </div>
                          </div>

                            <div class="col-6">
                            <div class="input-group-login">
                                <input type="password" class="form-control-login" placeholder="Kata Laluan" aria-label="password" aria-describedby="basic-addon1" style="border-radius: 5px 0px 0px 5px;">
                                <span class="input-group-text-login" id="basic-addon1"><i class="ri-eye-fill"></i></span>
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group-login">
                                <input type="password" class="form-control-login" placeholder=" Pengesahan Kata Laluan" aria-label="password" aria-describedby="basic-addon1" style="border-radius: 5px 0px 0px 5px;">
                                <span class="input-group-text-login" id="basic-addon1"><i class="ri-eye-fill"></i></span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div>
                                    <select class="form-select form-control-login" aria-label="Default select example" placeholder="Bahagian">
                                    <option selected>Bahagian</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    </select>
                                </div>
                              </div>
                    <div class="col-12">
                      <a href="#"><button class="btn btn-warning w-100" type="submit">Daftar</button></a>
                    </div>
                    
                  </form>

                </div>
              </div>




            </div>
          </div>
        </div>
      </section>
    </div>
</main>

@endsection