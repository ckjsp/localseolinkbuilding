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
                <img src="{{ asset_url('img/illustrations/auth-forgot-password-illustration-light.png') }}" alt="auth-forgot-password-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-forgot-password-illustration-light.png" data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png" />

                <img src="{{ asset_url('img/illustrations/bg-shape-image-light.png') }}" alt="auth-forgot-password-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Forgot Password -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="index.html" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
                            </svg>
                        </span>
                    </a>
                </div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <!-- /Logo -->
                <h3 class="mb-1 fw-bold">{{ __('Forgot Password?') }} 🔒</h3>
                <p class="mb-4">{{ __("Enter your email and we'll send you instructions to reset your password") }}</p>
                <form method="POST" class="mb-3" action="{{ route('password.email') }}" id="forgot-password-form">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email" autofocus>
                        <div class="invalid-feedback"><strong>Please enter a valid email</strong></div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Send Password Reset Link') }}</button>
                </form>
                <div class="text-center d-flex justify-content-between">
                    <a href="{{ route('login') }}">
                        <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                        <span class="align-middle">{{ __('Back to login') }}</span>
                    </a>
                    <a href="mailto:{{ env('SUPPORT_MAIL') }}" class="d-flex align-items-center">
                        <i class="fa-solid fa-headset me-2"></i>
                        <span class="align-middle">{{ __('Support') }}</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Forgot Password -->
    </div>
</div>
<!-- / Content -->
@endsection


@push('script')
<script>
    $('#forgot-password-form').submit(function() {
        var $email = $('#email').val() == undefined ? '' : ($('#email').val()).trim();

        var $flag = 0;
        if ($email != '' && IsEmail($email) == true) {
            $('#email').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#email').addClass('is-invalid').removeClass('is-valid');
        }
        if ($flag == 0) {
            return true;
        } else {
            return false;
        }
    });

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }
</script>
@endpush