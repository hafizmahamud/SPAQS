@extends('frontend.layouts.app')

@section('title', __('Verify Your E-mail Address'))

@section('content')
<main style="background-image: url('/spaqs/assets/img/login_background.png');">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="mb-3">
                        <div class="card-body">
                            <div>
                                <h5 class="card-title-login text-center">@lang('Verify Your E-mail Address')</h5>
                            </div>
                            <br>
                            <label>@lang('Before proceeding, please check your email for a verification link.')</label>
                            <label>@lang('If you did not receive the email')</label>
                            <br>
                            <form action="{{ route('frontend.auth.verification.resend') }}" class="d-inline" method="POST">
                                @csrf
                                <button class="btn btn-link p-0 m-0 align-baseline" type="submit">@lang('click here to request another').</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
