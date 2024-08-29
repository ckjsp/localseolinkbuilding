@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset_url('css/pages/page-auth.css') }}" />
@endpush

@section('auth-content')
<!-- Content -->
<!-- $data['identity'] = ($data['role'] == 3) ? 'in-house team' : 'individual link builder';
        return lslbUser::create([
            'name' => $data['name'],
            'role_id' => $data['role'],
            'email' => $data['email'],
            'identity' => $data['identity'],
            'password' => Hash::make($data['password']),
        ]); -->

<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="{{ asset_url('img/illustrations/auth-register-illustration.png') }}" alt="auth-register-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-register-illustration.png"
                    data-app-dark-img="illustrations/auth-register-illustration.png" />
                <img src="{{ asset_url('img/illustrations/bg-shape-image-light.png') }}" alt="auth-register-cover"
                    class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Register -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="index.html" class="app-brand-link gap-2">
                        <img src="{{ asset_url('img/logo.svg') }}" alt="Logo" class="w-100">
                    </a>
                </div>
                <!-- /Logo -->
                <h3 class="mb-1 fw-bold">Adventure starts here 🚀</h3>
                <p class="mb-4">Make your app management easy and fun!</p>

                <form method="POST" class="mb-3" action="{{ route('register') }}" id="user-register-form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" placeholder="Enter your username" value="{{ old('name') }}" required
                            autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email" name="email" value="{{ old('email') }}" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <div class="input-group input-group-merge">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" required autocomplete="new-password">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            <span class="invalid-feedback"><strong class="pass-msg"></strong></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                        <div class="input-group input-group-merge">
                            <input id="password-confirm" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" required autocomplete="new-password">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="d-block form-label">{{ __('User Role') }}</label>
                        <div class="col-5 form-check custom-option custom-option-basic checked mx-4">
                            <label class="form-check-label custom-option-content" for="role-publisher">
                                <input type="radio" id="role-publisher" name="role" value="2" checked
                                    class="form-check-input role" required="">
                                <span class="custom-option-header">
                                    <span class="h6 mb-0">Publisher</span>
                                </span>
                            </label>
                        </div>
                        <div class="col-5 form-check custom-option custom-option-basic">
                            <label class="form-check-label custom-option-content" for="role-advertiser">
                                <input type="radio" id="role-advertiser" name="role" value="3"
                                    class="form-check-input role" required="">
                                <span class="custom-option-header">
                                    <span class="h6 mb-0">Advertiser</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" id="identity" name="identity" value="individual link builder">
                    <!-- <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions">
                                I agree to
                                <a href="javascript:void(0);">privacy policy & terms</a>
                            </label>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary d-grid w-100">{{ __('Register') }}</button>

                </form>
                <p class="text-center">OR</p>
                <div class="row mb-3">
                    <label class="d-block form-label">{{ __('User Role') }}</label>
                    <div class="col-5 form-check custom-option custom-option-basic mx-4">
                        <label class="form-check-label custom-option-content" for="g-role-publisher">
                            <input type="radio" id="g-role-publisher" name="g-role" value="2"
                                class="form-check-input role" required="">
                            <span class="custom-option-header">
                                <span class="h6 mb-0">Publisher</span>
                            </span>
                        </label>
                    </div>
                    <div class="col-5 form-check custom-option custom-option-basic">
                        <label class="form-check-label custom-option-content" for="g-role-advertiser">
                            <input type="radio" id="g-role-advertiser" name="g-role" value="3"
                                class="form-check-input role" required="">
                            <span class="custom-option-header">
                                <span class="h6 mb-0">Advertiser</span>
                            </span>
                        </label>
                    </div>
                </div>
                <form method="GET" action="{{ route('login.google') }}" id="google-form">
                    <input type="hidden" name="selected_role" id="selected_role">
                    <a href="{{ route('login.google') }}" class="btn btn-primary  d-grid w-100 mb-3">Sign in with
                        Google</a>
                </form>
                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}">
                        <span>{{ __('Sign in instead') }}</span>
                    </a>
                </p>

                <!-- <div class="divider my-4">
                    <div class="divider-text">or</div>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                        <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                        <i class="tf-icons fa-brands fa-google fs-5"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                        <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                    </a>
                </div> -->
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>

<!-- / Content -->
@endsection

@push('script')
    <script src="{{ asset_url('js/pages-auth.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {
            var validator = $('#user-register-form').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                    role: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your username",
                        minlength: "Your username must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Your password must be at least 8 characters long",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    role: {
                        required: "Please select a role"
                    }
                },
                errorClass: "is-invalid",
                validClass: "is-valid",
                errorElement: "div",
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "role") {
                        error.insertAfter(element.closest(".row"));
                    } else {
                        error.addClass("invalid-feedback");
                        element.closest(".mb-3").append(error);
                    }
                },
                highlight: function (element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });

            $('#password').on('keyup', function () {
                validator.element('#password');  // Validate the password field on keyup
            });

            $('#google-form').on('submit', function (event) {
                var selectedRole = $('input[name="g-role"]:checked').val();
                if (!selectedRole) {
                    event.preventDefault();
                    alert('Please select a role before signing in with Google.');
                } else {
                    $('#selected_role').val(selectedRole);
                }
            });

        });
    </script>
@endpush