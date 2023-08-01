@extends('frontend.layouts.app')

@section('title', __('Reset Password'))

@section('content')
<main style="background: url(/spaqs/assets/img/login_background.png) no-repeat center center fixed;background-size: cover;">
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center">
                            <i class="bi bi-exclamation-circle" style="font-size: 8.75em; color: red;"></i>
                        </div>
                        <!-- End Logo -->

                        <div class="mb-3">

                            <div class="card-body justify-content-center" style="padding: 0 10px 80px 10px;">
                                <div>
                                    <div>
                                        <h5 class="card-title-login text-center">LUPA KATA LALUAN</h5>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span class="title-forgotpage d-none d-lg-block">Sila masukan alamat e-mel rasmi
                                            yang berdaftar dengan SPAQS. </span>
                                    </div>
                                </div>


                                <x-forms.post :action="route('frontend.auth.password.email')"
                                    class="row g-3 needs-validation">

                                    <div class="col-12">
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control-login" id="email"
                                                placeholder="E-mel" title=" " required>
                                            <div class="invalid-feedback">Sila masukan e-mel anda.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-warning w-100" type="submit">Hantar</button>
                                    </div>

                                    <div class="col-12 text-center">
                                        <x-utils.link :href="route('frontend.auth.login')"
                                            :active="activeClass(Route::is('frontend.auth.login'))"
                                            :text="__('Kembali')" class="text-center" style="color: white;" />

                                    </div>

                                    @if(Session::has('status'))
                                    <div class="form-group">
                                        <div class="alert alert-success">
                                            <ul>
                                                <li>{{ Session::get('status') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                    @if(count($errors))
                                    <div class="form-group">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </x-forms.post>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main>
@endsection

<style>
     ::placeholder {
        color: #2F4F4F !important;
    }

    .form-control-login {
        background-color: #F5FFFA !important;
        color:#2F4F4F !important;
    }
</style>
