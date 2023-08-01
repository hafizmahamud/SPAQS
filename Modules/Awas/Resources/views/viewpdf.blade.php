<!DOCTYPE HTML>
@extends('awas::layouts.master')

@section('content')

<div class="pagetitle">
    <h1>Memo Pelantikan</h1>
    @if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
    @endif

</div><!-- End Page Title -->
<section class="section">
    <div class="card">
        <div class="card-body-tabs">
            <!-- Default Tabs -->
            <ul style="width: 80%;" class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#home-justified" type="button" role="tab" aria-controls="home"
                        aria-selected="true" href="{{ url('/awas/generateBorangTindakan') }}">Memo</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang Lantikan</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile1-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang Pengarah 1</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile2-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang Pengarah 2</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile3-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang KPP 1</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile4-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang KPP 2</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile5-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang PP 1</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile6-tab" data-bs-toggle="tab" style="height: 50px;"
                        data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">Borang PP 2</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="myTabjustifiedContent">
                {{-- START IKLAN --}}
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                    <div>
                        <iframe src="{{ asset('/public/Memo_Lantikan_Penilai.pdf') }}" style="width:100%;height:700px;"></iframe>
                    </div>
                </div>
                {{-- END IKLAN --}}
                {{-- START BORANG SARINGAN WAJIB --}}
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                    <div>
                        <iframe src="{{ asset('/public/Memo_Lantikan_Penilai.pdf') }}" style="width:100%;height:700px;"></iframe>
                    </div>
                </div>
                {{-- END BORANG SARINGAN WAJIB --}}
            </div><!-- End Default Tabs -->
        </div>

    </div><!-- End Default Tabs -->
    </div>
    </div>
</section>
<script src={{ Module::asset('sisdant:js/3_3_1_jquery.min.js') }}></script>
<script src={{ Module::asset('sisdant:js/jquery.mask.min.js') }}></script>
<link rel="stylesheet" href={{ Module::asset('tunas:css/style.css') }}>


@endsection
