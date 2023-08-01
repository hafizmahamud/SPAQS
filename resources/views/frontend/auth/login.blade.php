@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
<main style="background: url(spaqs/assets/img/login_background.png) no-repeat center center fixed;background-size: cover;">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center">
                            <a href="" class="logo d-flex align-items-center w-auto">
                                <img src="spaqs/assets/img/Logo_JPS.png" alt="">
                            </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="title-login text-center">JABATAN PENGAIRAN DAN SALIRAN MALAYSIA</span>
                        </div>

                        <div class="mb-3">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title-login text-center">SISTEM PENGURUSAN APLIKASI QUANTITY
                                        SURVEYING <br>[SPAQS]</h5>
                                </div>
                                @if(session()->get('success'))
                                    <input type="text" name="success" id="success" value="{{ session()->get('success') }}" hidden>
                                @endif
                                <x-forms.post :action="route('frontend.auth.login')" class="row g-3 needs-validation" autocomplete="off">
                                    <div class="col-12">
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control-login" id="email"
                                                placeholder="E-mel Pengguna" autocomplete="off" required title=" ">
                                            <div class="invalid-feedback">Sila masukkan id pengguna. {{Request::route()->getName()}}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group-login">
                                            <input type="password" name="password" id="password"
                                                class="form-control-login" placeholder="Kata Laluan"
                                                aria-label="password" aria-describedby="basic-addon1"
                                                style="border-radius: 5px 0px 0px 5px;" autocomplete="off" title=" ">
                                            <span class="input-group-text-login" onclick="show('password')"
                                                id="display1"><i class="ri-eye-fill"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }} hidden>
                                            <label class="form-check-label" for="remember" style="color: white;" hidden>Ingat
                                                Saya</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <x-utils.link :href="route('frontend.auth.password.request')"
                                            style="padding-left: 20%; color: white;"
                                            :text="__('Lupa Kata Laluan?')" />
                                    </div>

                                    @if(config('boilerplate.access.captcha.login'))
                                    <div class="row">
                                        <div class="col">
                                            @captcha
                                            <input type="hidden" name="captcha_status" value="true" />
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-12">
                                        <button class="btn btn-warning w-100" type="submit">@lang('Login')</button>
                                    </div>
                                    <div class="col-12 text-center">
                                        <x-utils.link :href="route('frontend.auth.register')"
                                            :active="activeClass(Route::is('frontend.auth.register'))"
                                            :text="__('Daftar Pengguna')" class="text-center" style="color: white;" />

                                    </div>
                                    <div class="text-center" style="margin-top: -50px; width: 100%">
                                        @include('includes.partials.messages')
                                    </div>
                                </x-forms.post>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <div class="footer">
        @lang('Copyright') &copy; JPS (SPAQS) 2021
    </div>
</main>

@endsection

<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        color: white;
        text-align: center;
        border: none !important;
    }
    ::-ms-reveal {
        display: none;
    }

    ::placeholder {
        color: #2F4F4F !important;
    }

    .form-control-login {
        background-color: #F5FFFA !important;
        color:#2F4F4F !important;
    }

    .alert-danger{
        position: absolute !important;
    }
    .alert-success{
        position: absolute !important;
    }
    .alert-warning{
        position: absolute !important;
    }

    .alert.header-message {
        margin-top: 60px !important;
        width: 90% !important;
    }
</style>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>

<script>

    function show(password) {
        var a = document.getElementById(password);
        if (a.type === "password") {
            a.type = "text";

        } else {
            a.type = "password";

        }
    }

    $( document ).ready(function() {
        var suc = document.getElementById('success').value;
        if( suc ){
            Swal.fire({
                icon: 'success',
                text: suc,
                showCancelButton: false, // There won't be any cancel button
                showConfirmButton: false, // There won't be any confirm button
                allowOutsideClick: false,
                timer: 2000,
                width: 350
            })
        }
    });
</script>
