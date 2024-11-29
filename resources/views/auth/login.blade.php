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
                <img src="{{ asset_url('img/illustrations/auth-login-illustration.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration.png" data-app-dark-img="illustrations/auth-login-illustration.png" />
                <img src="{{ asset_url('img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>

        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                @if (session('verified'))
                <div class="alert alert-success" role="alert">{{ session('verified') }}</div>
                @endif
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="{{ url('/') }}" class="app-brand-link gap-2">
                        <img src="{{ asset_url('img/logo.svg') }}" alt="Logo" class="w-100">
                    </a>
                </div>
                <!-- /Logo -->
                <h3 class="mb-1 fw-bold">Welcome to Links Farmer! 👋</h3>
                <p class="mb-4">Please sign-in to your account and start the adventure</p>

                <form class="mb-3" method="POST" action="{{ route('login') }}" id="user-login-form">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter your email or username" autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-row-reverse">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>{{ __('Forgot Your Password?') }}</small>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Sign in') }}</button>
                </form>

                <p class="text-center">
                    <span>New on our platform?</span>
                    <a href="{{ route('register') }}">
                        <span>{{ __('Create an account') }}</span>
                    </a>
                </p>
            </div>
        </div>

        <!-- /Login -->

    </div>
</div>

<!-- / Content -->

@endsection

@push('script')

<script src="{{ asset_url('js/pages-auth.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize validation
        var validator = $('#user-login-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                email: {
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Your password must be at least 8 characters long",
                    minlength: "Your password must be at least 8 characters long"
                }
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest(".mb-3").append(error);
            },
            highlight: function(element) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });

        // Trigger validation on keyup for the password field
        $('#password').on('keyup', function() {
            validator.element('#password'); // Validate the password field on keyup
        });
    });
</script>

@endpush