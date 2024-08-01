@extends('lslbadmin.sidebar')

@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/dropzone/dropzone.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
@endpush

@section('sidebar-content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Update User Detail') }}
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-end"><i class="ti ti-arrow-narrow-left mx-1"></i> Go Back</a>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="border rounded p-5 mt-5 bg-white">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session('error'))
                <div class="alert alert-danger">
                    <ul class="m-auto">
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('lslbadmin.user.update', $user->id) }}" class="needs-validation" id="user-update-form" novalidate>
                    @csrf
                    <input type="hidden" id="user_role" name="user_role" value="{{ $user->role->name }}">
                    <input type="hidden" id="user_role_id" name="user_role_id" value="{{ $user->role->id }}">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" id="dial_code" name="dial_code" value="{{ !empty($user->dial_code) ? $user->dial_code : '+91' }}">
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputName">Name</label>
                            <input class="form-control" type="text" name="name" id="inputName" value="{{ $user->name }}" placeholder="Enter Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputEmail">Email Address</label>
                            <input class="form-control" type="text" name="email" id="inputEmail" value="{{ $user->email }}" placeholder="Enter Email">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPhoneNumber">Phone Number</label>
                            <input type="text" id="inputPhoneNumber" name="phone_number" value="{{ $user->phone_number }}" class="form-control inputPhoneNumber" placeholder="9856485236">
                        </div>
                        <!-- <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPhoneNumber">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text phone_code"><?php //echo !empty($user->dial_code) ? $user->dial_code : '+91'  ?></span>
                                <input type="number" id="inputPhoneNumber" name="phone_number" value="<?php //echo $user->phone_number ?>" maxlength="13" class="form-control inputPhoneNumber" placeholder="9856485236">
                                <div class="invalid-feedback"><strong class="num-msg"></strong></div>
                            </div>
                        </div> -->
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputIdentity">{{ $user->role->name == 'Advertiser' ? 'Identity' : 'Who are you?' }}</label>
                            <select name="identity" id="inputIdentity" class="form-select">
                                <option value="individual link builder" {{ $user->identity == 'individual link builder' ? 'selected' : '' }}>Individual Link Builder</option>
                                <option value="in-house team" {{ $user->identity == 'in-house team' ? 'selected' : '' }}>In-House Team</option>
                                <option value="agency" {{ $user->identity == 'agency' ? 'selected' : '' }}>Agency</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputCompanyWebsite">Company Website</label>
                            <input class="form-control" type="text" name="company_website_url" value="{{ $user->company_website_url }}" id="inputCompanyWebsite" placeholder="Company Website">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputCountry">Country</label>
                            <select name="country" id="inputCountry" class="form-select" data-val="{{ !empty($user->country) ? $user->country : 'india' }}">
                            </select>
                            <!-- <option value="india" {{ $user->country == 'india' ? 'selected' : '' }}>india</option> -->
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPreferredMethod">Preferred Method</label>
                            <select name="preferred_method" id="inputPreferredMethod" class="form-select">
                                <option value="paypal" {{ $user->preferred_method == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                <option value="stripe" {{ $user->preferred_method == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                <option value="razorpay" {{ $user->preferred_method == 'razorpay' ? 'selected' : '' }}>Razorpay</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPaymentEmail">Payment Email</label>
                            <input class="form-control" type="text" name="payment_email" value="{{ $user->payment_email }}" id="inputPaymentEmail" placeholder="Enter Payment Email">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputActiveStatus">Active Status</label>
                            <select name="status" id="inputActiveStatus" class="form-select">
                                <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputEmailVerified">Email Verified</label>
                            <select name="email_verified_at" id="inputEmailVerified" class="form-select">
                                <option value="{{ empty($user->email_verified_at) || $user->email_verified_at == null ? date('Y-m-d H:i:s') : $user->email_verified_at }}" {{ !empty($user->email_verified_at) ? 'selected' : '' }}>Verified</option>
                                <option value="" {{ empty($user->email_verified_at) || $user->email_verified_at == null ? 'selected' : '' }}>Unverified</option>
                            </select>
                        </div>

                        @if($user->role->name == 'Advertiser')
                        <div class="mb-3 col-12 col-md-12 text-center"><strong>Billing Information</strong></div>

                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBusinessName">Business Name</label>
                            <input class="form-control" type="text" name="business_name" value="{{ $user->business_name }}" id="inputBusinessName" placeholder="Enter Business Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputRegistrationNumber">Registration Number</label>
                            <input class="form-control" type="text" name="registration_number" value="{{ $user->registration_number }}" id="inputRegistrationNumber" placeholder="Enter Registration Number">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBillingAddress">Billing Address</label>
                            <input class="form-control" type="text" name="billing_address" value="{{ $user->billing_address }}" id="inputBillingAddress" placeholder="Enter Billing Address">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBillingCity">Billing City</label>
                            <input class="form-control" type="text" name="billing_city" value="{{ $user->billing_city }}" id="inputBillingCity" placeholder="Enter Billing City">
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputBillingCountry">Billing Country</label>
                            <select name="billing_country" id="inputBillingCountry" class="form-select" data-val="{{ !empty($user->billing_country) ? $user->billing_country : 'india' }}">
                            </select>
                            <!-- <option value="india" {{ $user->billing_country == 'india' ? 'selected' : '' }}>india</option> -->
                        </div>
                        <div class="mb-3 col-12 col-md-6 fv-plugins-icon-container">
                            <label class="form-label" for="inputPostalCode">Postal Code</label>
                            <input class="form-control" type="number" name="postal_code" value="{{ $user->postal_code }}" id="inputPostalCode" placeholder="Enter Postal Code">
                        </div>
                        @endif
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
                        <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
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
<script src="{{ asset_url('libs/intlTelInput/intlTelInput.min.js') }}"></script>
<script>
    $(window).ready(function () {
        var input = document.querySelector("#inputPhoneNumber");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        $('.iti.iti--allow-dropdown').css('width','100%');

        var defaultDialingCode = $('#dial_code').val();
        var countryCode = window.intlTelInputGlobals.getCountryData().find(function(country) {
            return '+'+country.dialCode === defaultDialingCode;
        });
        if(countryCode){
            iti.setCountry(countryCode.iso2);
        }

        input.addEventListener("countrychange", function() {
            var countryDialCode = iti.getSelectedCountryData().dialCode;
            $('#dial_code').val('+'+countryDialCode);
        });

        $.validator.addMethod("validPhoneNumber", function(value, element) {
            if(!iti.isValidNumber()){
                $('.iti__selected-flag').css('height','60%');
            }else{
                $('.iti__selected-flag').css('height','100%');
            }
            return iti.isValidNumber();
        }, "Please enter a valid phone number");

        function rulesFun() {
            const userRole = $("#user_role").val();
            const dynamicRules = {
                image: {
                    required: false,
                    accept: "image/jpeg,image/png,image/gif,image/jpg,image/svg"
                },
                name: "required",
                email: {
                    required: true,
                    email: true,
                },
                phone_number: {
                    required: true,
                    validPhoneNumber: true,
                    // maxlength: 12
                },
                dial_code: "required",
                identity: "required",
                company_website_url: {
                    required: true,
                    url: true
                },
                country: "required",
                preferred_method: "required",
                payment_email: {
                    required: false,
                    email: true,
                },
            };
            if (userRole == 'Advertiser') {
                dynamicRules.business_name = "required";
                dynamicRules.registration_number = "required";
                dynamicRules.billing_address = "required";
                dynamicRules.billing_city = "required";
                dynamicRules.billing_country = "required";
                dynamicRules.postal_code = {
                    required: true,
                    maxlength: 6
                };
            }
            return dynamicRules;
        }

        function messagesFun() {
            const userRole = $("#user_role").val();
            const dynamicMessages = {
                image: {
                    required: " Please enter a profile image",
                    accept: " Please select valid profile image ex. JPG,JPEG,PNG"
                },
                name: " Please enter your name",
                email: {
                    required: " Please enter your email",
                    email: " Please enter valid email address"
                },
                phone_number: {
                    required: " Please enter a phone number",
                    validPhoneNumber: "Please enter a valid phone number"
                    // minlength: " Please enter valid phone number"
                },
                dial_code: " Please check your contury dial code",
                identity: " Please select your identity",
                company_website_url: {
                    required: " Please enter your company website url",
                    url: " Please Enter valid company website url"
                },
                country: " Please select your country",
                preferred_method: " Please select your preferred payment method",
                payment_email: {
                    email: " Please enter valid payment email address"
                },
            };

            if (userRole == 'Advertiser') {
                dynamicMessages.business_name = "Please enter your business name";
                dynamicMessages.registration_number = "Please enter your registration number";
                dynamicMessages.billing_address = "Please enter your billing address";
                dynamicMessages.billing_city = "Please enter your billing city";
                dynamicMessages.billing_country = "Please select your billing country";
                dynamicMessages.postal_code = {
                    required: " Please enter postal code",
                    maxlength: " postal code should be 4-6 digits in length"
                };
            }

            return dynamicMessages;
        }
        $("#user-update-form").validate({
            rules: rulesFun(),
            messages: messagesFun()
        });
    });
  

    function isValidHttpUrl(str) {
        const pattern = new RegExp(
            '^(https?:\\/\\/)?' + // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
            '(\\#[-a-z\\d_]*)?$', // fragment locator
            'i'
        );
        return pattern.test(str);
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;   
        } else {
            return true;
        }
    }

    fetch('<?= url('public/json/country.json') ?>').then(response => response.json()).then(data => {
        var $user_role = $('#user_role').val();
        $inputCountry = $('#inputCountry').data('val');
        $inputCountry = ($inputCountry != '') ? $inputCountry : 'india';
        if ($user_role == 'Advertiser') {
            $inputBillingCountry = $('#inputBillingCountry').data('val');
            $inputBillingCountry = ($inputBillingCountry != '') ? $inputBillingCountry : 'india';
        }
        data.map(function($v) {
            $slct1 = '';
            if ($inputCountry == ($v.name).toLowerCase()) {
                $slct1 = "selected";
                $('.phone_code').text($v.dial_code);
                $('#dial_code').val($v.dial_code);
            }
            $opt1 = '<option value="' + ($v.name).toLowerCase() + '" data-code="' + $v.dial_code + '" ' + $slct1 + '>' + $v.name + '</option>';
            $('#inputCountry').append($opt1);
            if ($user_role == 'Advertiser') {
                $slct2 = $inputBillingCountry == ($v.name).toLowerCase() ? "selected" : "";
                $opt2 = '<option value="' + ($v.name).toLowerCase() + '" data-code="' + $v.dial_code + '" ' + $slct2 + '>' + $v.name + '</option>';
                $('#inputBillingCountry').append($opt2);
            }
        });
    });

    $('#inputCountry').change(function() {
        var $code = $(this).find('option:selected').data('code');
        $('.phone_code').text($code);
        $('#dial_code').val($code);
    });
</script>
@endpush