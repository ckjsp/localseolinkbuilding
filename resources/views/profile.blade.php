@push('css')
<link rel="stylesheet" href="{{ asset_url('css/pages/page-profile.css') }}" />
<!-- intlTelInput CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<style>
    #change-password-form label.error {
        position: absolute;
        top: 35px;
    }

    #change-password-form .input-group {
        margin-bottom: 10px
    }

    .firstlogin-popup {
        background-image: url('{{ asset("public/img/pages/firstloginbg.png") }}');
        background-repeat: no-repeat;
        background-size: cover;
        border-top-right-radius: 12px;
        background-position: bottom;
        border-top-left-radius: 12px;
    }

    #advertiserModal {
        display: block;
    }

    #advertiserModal .modal-dialog {
        background-color: transparent;
        height: auto;
        width: 100%;
        max-width: 400px;
    }

    #advertiserModal .modal-content {
        background-color: transparent;
        height: inherit;
        padding: 0;
    }

    #advertiserModal .firstlogin_price {
        color: #1C8ADB;
    }

    .mt-negative-15 {
        margin-top: -15px;
    }
</style>
@endpush

<?php
$page = 'publisher.sidebar';
if (Auth::user()->role->name === 'Advertiser')
    $page = 'advertiser.menu';
if (Auth::user()->role->name === 'Admin')
    $page = 'lslbadmin.sidebar';
?>
@extends($page)
@section('sidebar-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row">
        <div class="col-md-10 m-auto">
            @if(session('success'))
            <div class="alert alert-primary remove-msg"><span>{{ session('success') }}</span></div>
            @endif
            @if(session('errorMsg'))
            <div class="alert alert-danger remove-msg"><span>{{ session('errorMsg') }}</span></div>
            @endif
            @if($errors->any())
            <div class="alert alert-danger remove-msg">
                @foreach($errors->all() as $error)
                <span>{{ $error }}</span>
                @endforeach
            </div>
            @endif
            @if(session('success') || session('errorMsg') || $errors->any())
            <script>
                $(document).ready(function() {
                    setTimeout(function() {
                        $('.remove-msg').remove();
                    }, 6000);
                });
            </script>
            @endif
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset_url('img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top"
                        style="height:70px" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="<?= (!empty($user->image)) ? url('storage/app/' . $user->image) : asset_url('img/avatars/1.png'); ?>"
                            alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $user->name }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item d-flex gap-1">
                                        <i class="ti ti-color-swatch"></i> {{ $user->role->name }}
                                    </li>
                                    @if($user->country != '')
                                    <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i>
                                        {{ $user->country }}
                                    </li>
                                    @endif
                                    <!-- <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-calendar"></i> Joined April 2021
                                        </li> -->
                                </ul>
                            </div>
                            <div>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#change-password-pop" id="changePasswordBtn"
                                    class="btn btn-primary">
                                    <i class="ti ti-lock-cog me-1"></i>Change Password
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#edit-user-detail-pop" id="editUserDetailBtn"
                                    class="btn btn-primary">
                                    <i class="ti ti-user-edit me-1"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        @if(!empty($user->name))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Full
                                Name:</span> <span>{{ $user->name }}</span>
                        </li>
                        @endif
                        @if($user->status != '')
                        <!-- <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">Status:</span> <span>{{ ($user->status == 1) ? 'Active' : 'Inactive'}}</span>
                                                <span></span>
                                            </li> -->
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check text-heading"></i>
                            <span class="fw-medium mx-2 text-heading">Status:</span>
                            <span>{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</span>
                            <span class="{{ ($user->status == 1) ? 'active-dot' : 'inactive-dot' }}"></span>
                        </li>
                        @endif
                        @if(!empty($user->role->name))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-crown text-heading"></i><span
                                class="fw-medium mx-2 text-heading">Role:</span> <span>{{ $user->role->name }}</span>
                        </li>
                        @endif
                        @if(!empty($user->country))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-world-pin text-heading"></i><span
                                class="fw-medium mx-2 text-heading">Country:</span> <span>{{ $user->country }}</span>
                        </li>
                        @endif
                        @if(!empty($user->identity))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-id-badge-2 text-heading"></i><span class="fw-medium mx-2 text-heading">Who
                                are you?:</span> <span>{{ $user->identity }}</span>
                        </li>
                        @endif
                        @if(!empty($user->company_website_url))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-world-www text-heading"></i><span
                                class="fw-medium mx-2 text-heading">Company Website:</span>
                            <span>{{ $user->company_website_url }}</span>
                        </li>
                        @endif
                        <!-- <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-file-description text-heading"></i><span class="fw-medium mx-2 text-heading">Languages:</span> <span>English</span>
                            </li> -->
                    </ul>
                </div>
            </div>
            <!--/ About User -->
        </div>
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        @if(!empty($user->phone_number))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span>
                            <span>{{ $user->dial_code }} {{ $user->phone_number }}</span>
                        </li>
                        @endif
                        @if(!empty($user->email))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                            <span>{{ $user->email }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">Payment Information</small>
                    <ul class="list-unstyled mb-0 mt-3">
                        @if(!empty($user->country))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-world-pin text-info me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span
                                    class="fw-medium me-2 text-heading">Country:</span><span>{{ $user->country }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->preferred_method))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-wallet text-info me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Preferred
                                    Method:</span><span>{{ $user->preferred_method }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->payment_email))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-mail-dollar text-info me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Preferred
                                    Email:</span><span>{{ $user->payment_email }}</span>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @if($user->role->name == 'Advertiser')
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">Billing Information</small>
                    <ul class="list-unstyled mb-0 mt-3">
                        @if(!empty($user->business_name))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-id-badge text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Business
                                    Name:</span><span>{{ $user->business_name }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->registration_number))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-certificate text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Registration
                                    Number:</span><span>{{ $user->registration_number }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->billing_address))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-map-pins text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Billing
                                    Address:</span><span>{{ $user->billing_address }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->billing_city))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-building-skyscraper text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Billing
                                    City:</span><span>{{ $user->billing_city }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->billing_country))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-world-pin text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Billing
                                    Country:</span><span>{{ $user->billing_country }}</span>
                            </div>
                        </li>
                        @endif
                        @if(!empty($user->postal_code))
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-map-pin-code text-primary me-2"></i>
                            <div class="d-flex flex-wrap">
                                <span class="fw-medium me-2 text-heading">Postal
                                    Code:</span><span>{{ $user->postal_code }}</span>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--/ User Profile Content -->

</div>

<div class="modal fade" id="change-password-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Change Password') }}</h3>
                </div>
                @if(session('error'))
                <div class="alert alert-danger"><span>{{ session('error') }}</span></div>
                @endif
                <form method="POST" action="{{ route('password.change.update') }}" id="change-password-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <div class="row">
                        <div class="mb-3 col-md-12 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="currentPassword">Current Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input class="form-control" type="password" name="current_password" id="currentPassword"
                                    placeholder="············">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="newPassword">New Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input class="form-control" type="password" id="newPassword" name="password"
                                    placeholder="············">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>

                        <div class="mb-3 col-md-12 form-password-toggle fv-plugins-icon-container">
                            <label class="form-label" for="confirmPassword">Confirm New Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="confirmPassword" placeholder="············">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 m-auto text-center">
                        <!-- <div class="col-12 mb-4">
                                <h6>Password Requirements:</h6>
                                <ul class="ps-3 mb-0">
                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                    <li class="mb-1">At least one lowercase character</li>
                                    <li>At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div> -->
                        <div>
                            <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Change
                                Password</button>
                            <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-user-detail-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Edit User Detail') }}</h3>
                </div>
                @if(session('error'))
                <div class="alert alert-danger">
                    <ul class="m-auto">
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('user.update', $user->id) }}" class="needs-validation"
                    id="user-update-form" novalidate enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="user_role" name="user_role" value="{{ $user->role->name }}">
                    <input type="hidden" id="user_role_id" name="user_role_id" value="{{ $user->role->id }}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" id="dial_code" name="dial_code"
                        value="{{ !empty($user->dial_code) ? $user->dial_code : '+91' }}">
                    <div class="row">
                        <?php if (isset($user->image) && !empty($user->image)) { ?>
                            <div class="mb-3 col-12 col-md-12 fv-plugins-icon-container text-center">
                                <img src="{{ url('/storage/app/' . $user->image) }}" alt="Profile Image" class="text-center"
                                    width="100">
                            </div>
                        <?php } ?>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputImage">Upload Profile Image</label>
                            <input class="form-control" type="file" name="image" id="inputImage"
                                placeholder="Upload Image">
                            <div class="invalid-feedback">Please select valid profile image ex. JPG,JPEG,PNG</div>
                            <input type="hidden" id="old_image" name="old_image" value="{{ $user->image }}">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputName">Name</label>
                            <input class="form-control" type="text" name="name" id="inputName" value="{{ $user->name }}"
                                placeholder="Enter Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputEmail">Email Address</label>
                            <input class="form-control" type="text" name="email" id="inputEmail"
                                value="{{ $user->email }}" placeholder="Enter Email">
                            <div class="invalid-feedback">Please Enter Valid Email Address</div>
                        </div>

                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPhoneNumber">Phone Number</label>
                            <input type="text" id="inputPhoneNumber" name="phone_number"
                                value="{{ $user->phone_number }}" class="form-control inputPhoneNumber"
                                placeholder="9856485236">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label"
                                for="inputIdentity">{{ $user->role->name == 'Advertiser' ? 'Identity' : 'Who are you?' }}</label>
                            <select name="identity" id="inputIdentity" class="form-select">
                                <option value="individual link builder" {{ $user->identity == 'individual link builder' ? 'selected' : '' }}>Individual Link Builder</option>
                                <option value="in-house team" {{ $user->identity == 'in-house team' ? 'selected' : '' }}>
                                    In-House Team</option>
                                <option value="agency" {{ $user->identity == 'agency' ? 'selected' : '' }}>Agency</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputCompanyWebsite">Company Website</label>
                            <input class="form-control" type="text" name="company_website_url"
                                value="{{ $user->company_website_url }}" id="inputCompanyWebsite"
                                placeholder="Company Website">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputCountry">Country</label>
                            <select name="country" id="inputCountry" class="form-select"
                                data-val="{{ !empty($user->country) ? $user->country : 'india' }}">
                            </select>
                            <!-- <option value="india" {{ $user->country == 'india' ? 'selected' : '' }}>india</option> -->
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPreferredMethod">Preferred Method</label>
                            <select name="preferred_method" id="inputPreferredMethod" class="form-select">
                                <option value="paypal" {{ $user->preferred_method == 'paypal' ? 'selected' : '' }}>PayPal
                                </option>
                                <option value="stripe" {{ $user->preferred_method == 'stripe' ? 'selected' : '' }}>Stripe
                                </option>
                                <option value="razorpay" {{ $user->preferred_method == 'razorpay' ? 'selected' : '' }}>
                                    Razorpay</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPaymentEmail">Payment Email</label>
                            <input class="form-control" type="text" name="payment_email"
                                value="{{ $user->payment_email }}" id="inputPaymentEmail"
                                placeholder="Enter Payment Email">
                        </div>

                        @if($user->role->name == 'Advertiser')
                        <div class="mb-3 col-12 col-md-12">
                            <input type="checkbox" id="whatsapp_msg" name="whatsapp_msg" {{ $user->whatsapp_msg ? 'checked' : '' }} />
                            <label for="whatsapp_msg">Send me the order updates and the best offers and discount on my
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    fill="#25D366" height="15px" width="15px" version="1.1" id="Layer_1"
                                    viewBox="0 0 308 308" xml:space="preserve" stroke="#25D366">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <g id="XMLID_468_">
                                            <path id="XMLID_469_"
                                                d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156 c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687 c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887 c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153 c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348 c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802 c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922 c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0 c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458 C233.168,179.508,230.845,178.393,227.904,176.981z" />
                                            <path id="XMLID_470_"
                                                d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716 c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396 c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188 l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677 c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867 C276.546,215.678,222.799,268.994,156.734,268.994z" />
                                        </g>
                                    </g>
                                </svg>whatsapp number.</label>
                        </div>

                        <div class="mb-3 col-12 col-md-12">
                            <label for="how_hear_about_us" class="mb-2">How did you hear about us?<span
                                    style="color: red;">*</span></label>
                            <div id="how_hear_about_us" class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="radio" id="search_engine" name="how_hear_about_us"
                                            value="Search Engine" class="form-check-input" {{ $user->how_hear_about_us == 'Search Engine' ? 'checked' : '' }} />
                                        <label for="search_engine" class="form-check-label">Search Engine</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="word_of_mouth" name="how_hear_about_us"
                                            value="Word of Mouth" class="form-check-input" {{ $user->how_hear_about_us == 'Word of Mouth' ? 'checked' : '' }} />
                                        <label for="word_of_mouth" class="form-check-label">Word of Mouth</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="social_media_ads" name="how_hear_about_us"
                                            value="Social Media Ads" class="form-check-input" {{ $user->how_hear_about_us == 'Social Media Ads' ? 'checked' : '' }} />
                                        <label for="social_media_ads" class="form-check-label">Social Media Ads</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="chrome_extension" name="how_hear_about_us"
                                            value="Chrome Extension" class="form-check-input" {{ $user->how_hear_about_us == 'Chrome Extension' ? 'checked' : '' }} />
                                        <label for="chrome_extension" class="form-check-label">Chrome Extension</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="event_specify" name="how_hear_about_us"
                                            value="Event (please specify)" class="form-check-input" {{ $user->how_hear_about_us == 'Event (please specify)' ? 'checked' : '' }} />
                                        <label for="event_specify" class="form-check-label">Event (please
                                            specify)</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="other_specify" name="how_hear_about_us"
                                            value="Other (please specify)" class="form-check-input" {{ $user->how_hear_about_us == 'Other (please specify)' ? 'checked' : '' }} />
                                        <label for="other_specify" class="form-check-label">Other (please
                                            specify)</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="radio" id="social_media" name="how_hear_about_us"
                                            value="Social Media" class="form-check-input" {{ $user->how_hear_about_us == 'Social Media' ? 'checked' : '' }} />
                                        <label for="social_media" class="form-check-label">Social Media</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="google_ads" name="how_hear_about_us" value="Google Ads"
                                            class="form-check-input" {{ $user->how_hear_about_us == 'Google Ads' ? 'checked' : '' }} />
                                        <label for="google_ads" class="form-check-label">Google Ads</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="third_party_review_site" name="how_hear_about_us"
                                            value="Third-Party Review Site" class="form-check-input" {{ $user->how_hear_about_us == 'Third-Party Review Site' ? 'checked' : '' }} />
                                        <label for="third_party_review_site" class="form-check-label">Third-Party Review
                                            Site</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-12 col-md-12" id="additional_info_container">
                            <label for="additional_info">Additional Information:</label>
                            <textarea id="additional_info" name="additional_info" class="form-control" rows="3"
                                placeholder="Enter any additional information here...">{{ $user->additional_info }}</textarea>
                        </div>

                        <div class="mb-3 col-12 col-md-12 text-center"><strong>Billing Information</strong></div>

                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBusinessName">Business Name</label>
                            <input class="form-control" type="text" name="business_name"
                                value="{{ $user->business_name }}" id="inputBusinessName"
                                placeholder="Enter Business Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputRegistrationNumber">Registration Number</label>
                            <input class="form-control" type="text" name="registration_number"
                                value="{{ $user->registration_number }}" id="inputRegistrationNumber"
                                placeholder="Enter Registration Number">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBillingAddress">Billing Address</label>
                            <input class="form-control" type="text" name="billing_address"
                                value="{{ $user->billing_address }}" id="inputBillingAddress"
                                placeholder="Enter Billing Address">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBillingCity">Billing City</label>
                            <input class="form-control" type="text" name="billing_city"
                                value="{{ $user->billing_city }}" id="inputBillingCity"
                                placeholder="Enter Billing City">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBillingCountry">Billing Country</label>
                            <select name="billing_country" id="inputBillingCountry" class="form-select"
                                data-val="{{ !empty($user->billing_country) ? $user->billing_country : 'india' }}">
                            </select>
                            <!-- <option value="india" {{ $user->billing_country == 'india' ? 'selected' : '' }}>india</option> -->
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPostalCode">Postal Code</label>
                            <input class="form-control" type="number" name="postal_code"
                                value="{{ $user->postal_code }}" id="inputPostalCode" placeholder="Enter Postal Code">
                        </div>
                        @endif
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit"
                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
                        <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if($user->role->name == 'Advertiser')
@if(session('show_advertiser_modal'))
<div id="advertiserModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body firstlogin-popup text-center pt-0">
                <div class="text-center mb-4 p-2 pt-0 mt-negative-15">
                    <img src="{{ asset('public/img/pages/gifticon.png') }}">
                </div>
                <div>
                    <h3>CONGRATULATIOS!</h3>
                </div>
                <div>
                    <h2 class="firstlogin_price">$25</h2>
                </div>
                <p>Free Credit has been awarded to you. Take advantage of this free credit and place your <span>1st
                        order on the Marketplace.</span></p>

                <a class="openEditProfile btn btn-primary waves-effect waves-light" href="javascript:void(0)">Grab The
                    Deal</a>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="change-password-pop" tabindex="-1" style="display: none;" aria-hidden="true">

    <script>
        $(document).ready(function() {
            $('#advertiserModal').modal('show');
            $('#advertiserModal').on('shown.bs.modal', function() {
                if (!$('.modal-backdrop').length) {
                    $('<div class="modal-backdrop fade show"></div>').appendTo('body');
                }
            }).on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove();
            });


            $('.openEditProfile').on('click', function() {
                $('#advertiserModal').modal('hide');
                setTimeout(function() {
                    $('#edit-user-detail-pop').modal('show');
                    if (!$('.modal-backdrop').length) {
                        $('<div class="modal-backdrop fade show"></div>').appendTo('body');
                    }
                }, 1000);
            });

            $('#edit-user-detail-pop').on('shown.bs.modal', function() {
                if (!$('.modal-backdrop').length) {
                    $('<div class="modal-backdrop fade show"></div>').appendTo('body');
                }
            }).on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove();
            });

            function toggleAdditionalInfo() {
                if ($('#event_specify').is(':checked') || $('#other_specify').is(':checked')) {
                    $('#additional_info_container').show();
                } else {
                    $('#additional_info_container').hide();
                }
            }
            toggleAdditionalInfo();
            $('input[name="how_hear_about_us"]').change(toggleAdditionalInfo);
        });
    </script>
    @endif
    @endif
    @if(session('error'))
    <script>
        // $('#changePasswordBtn').click();
        $('#change-password-pop').addClass('show');
        $('#change-password-pop').attr('role', 'dialog');
        $('#change-password-pop').show();
    </script>
    @endif
    @endsection

    @push('script')
    <script src="{{ asset_url('js/pages-profile.js') }}"></script>
    <!-- intlTelInput JS -->
    <script src="{{ asset_url('libs/intlTelInput/intlTelInput.min.js') }}"></script>

    <script src="{{ asset_url('script/profile.js') }}"></script>
    @endpush