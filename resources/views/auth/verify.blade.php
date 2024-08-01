@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset_url('css/pages/page-auth.css') }}" />
@endpush

@section('auth-content')
<!-- Content -->

<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset_url('img/illustrations/auth-verify-email-illustration.png') }}" alt="auth-verify-email-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-verify-email-illustration.png" data-app-dark-img="illustrations/auth-verify-email-illustration.png" />
                <img src="{{ asset_url('img/illustrations/bg-shape-image-light.png') }}" alt="auth-verify-email-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <!-- /Left Text -->

        <!--  Verify email -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
            <div class="w-px-400 mx-auto">
                <div class="app-brand mb-4">
                    <a href="index.html" class="app-brand-link gap-2">
                        <img src="{{ asset_url('img/logo.svg') }}" alt="Logo" class="w-100">
                    </a>
                </div>
                <h3 class="mb-1">{{ __('Verify Your Email Address') }} ✉️</h3>
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
                @endif
                <p class="text-start mt-4">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                </p>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary d-grid w-100 mb-3 waves-effect waves-light">{{ __('click here to request another') }}</button>
                </form>
                <div class="text-center">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                        <span class="align-middle">{{ __('Back to login') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
        <!-- / Verify email -->
    </div>
</div>
<!-- / Content -->
@endsection