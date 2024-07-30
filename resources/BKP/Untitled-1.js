
/* $("#user-update-form").validate({
            rules: {
                image: {
                    required: true,
                    accept: "image/jpeg,image/png,image/gif,image/jpg,image/svg"
                },
                name: "required",
                email: {
                    required: true,
                    email: true,
                    
                },
                phone_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 12
                },
                dial_code: "required",
                identity: "required",
                company_website_url:{
                    required: true,
                    url: true
                },
                country: "required",
                preferred_method: "required",
                payment_email: {
                    required: false,
                    email: true,
                    
                },
                // password: {
                //     required: true,
                //     minlength: 5
                // },
                // confirm_password: {
                //     required: true,
                //     minlength: 5,

                //     // For checking both passwords are same or not
                //     equalTo: "#password"
                // },
                // email: {
                //     required: true,
                //     email: true
                // },
                // agree: "required"
            },
            // In 'messages' user have to specify message as per rules
            messages: {
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
                    minlength:" Your phone number must be consist of at least 10 characters",
                    minlength: " phone numbers should be 10-12 digits in length"
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
                // password: {
                //     required: " Please enter a password",
                //     minlength:
                //         " Your password must be consist of at least 5 characters"
                // },
                // confirm_password: {
                //     required: " Please enter a password",
                //     minlength:
                //         " Your password must be consist of at least 5 characters",
                //     equalTo: " Please enter the same password as above"
                // },
                // agree: "Please accept our policy"
            }
        }); */


          /* $('#user-update-form').submit(function() {
        var $user_role = $('#user_role').val();
        var $user_role_id = $('#user_role_id').val();
        var $user_id = $('#user_id').val();
        var $dial_code = $('#dial_code').val() == undefined ? '' : ($('#dial_code').val()).trim();
        var $inputName = $('#inputName').val() == undefined ? '' : ($('#inputName').val()).trim();
        var $inputImage = $('#inputImage').val() == undefined ? '' : ($('#inputImage').val()).trim();
        var $old_image = $('#old_image').val() == undefined ? '' : ($('#old_image').val()).trim();
        var $inputEmail = $('#inputEmail').val() == undefined ? '' : ($('#inputEmail').val()).trim();
        var $inputPhoneNumber = $('#inputPhoneNumber').val() == undefined ? '' : ($('#inputPhoneNumber').val()).trim();
        var $inputIdentity = $('#inputIdentity').val() == undefined ? '' : ($('#inputIdentity').val()).trim();
        var $inputCompanyWebsite = $('#inputCompanyWebsite').val() == undefined ? '' : ($('#inputCompanyWebsite').val()).trim();
        var $inputCountry = $('#inputCountry').val() == undefined ? '' : ($('#inputCountry').val()).trim();
        var $inputPreferredMethod = $('#inputPreferredMethod').val() == undefined ? '' : ($('#inputPreferredMethod').val()).trim();
        var $inputPaymentEmail = $('#inputPaymentEmail').val() == undefined ? '' : ($('#inputPaymentEmail').val()).trim();
        if ($user_role == 'Advertiser') {
            var $inputBusinessName = $('#inputBusinessName').val() == undefined ? '' : ($('#inputBusinessName').val()).trim();
            var $inputRegistrationNumber = $('#inputRegistrationNumber').val() == undefined ? '' : ($('#inputRegistrationNumber').val()).trim();
            var $inputBillingAddress = $('#inputBillingAddress').val() == undefined ? '' : ($('#inputBillingAddress').val()).trim();
            var $inputBillingCity = $('#inputBillingCity').val() == undefined ? '' : ($('#inputBillingCity').val()).trim();
            var $inputBillingCountry = $('#inputBillingCountry').val() == undefined ? '' : ($('#inputBillingCountry').val()).trim();
            var $inputPostalCode = $('#inputPostalCode').val() == undefined ? '' : ($('#inputPostalCode').val()).trim();
        }

        var $flag = 0;

        if ($inputName != '') {
            $('#inputName').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputName').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputImage == '' && $old_image == '') {
            $flag++;
            $('#inputImage').addClass('is-invalid').removeClass('is-valid');
        } else {
            const selectedFile = $('#inputImage').files[0];
            if (selectedFile) {
                const allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/svg'];
                if (allowedFileTypes.includes(selectedFile.type)) {
                    $('#inputImage').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $flag++;
                    $(this).addClass('is-invalid').removeClass('is-valid');
                }
            }
        }
        if ($inputEmail != '' && IsEmail($inputEmail) == true) {
            $('#inputEmail').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputEmail').addClass('is-invalid').removeClass('is-valid');
        }
        if ($dial_code != '') {
            $('#inputPhoneNumber').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputPhoneNumber').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputPhoneNumber != '' && $inputPhoneNumber != 0) {
            if ($inputPhoneNumber.length >=13) {
                $flag++;
                $('#inputPhoneNumber').addClass('is-invalid').removeClass('is-valid');
                $('.num-msg').text('Please enter valid contact number!');
            }else{
                $('#inputPhoneNumber').removeClass('is-invalid').addClass('is-valid');
            }
        } else {
            $flag++;
            $('#inputPhoneNumber').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputIdentity != '') {
            $('#inputIdentity').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputIdentity').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputCompanyWebsite != '' && isValidHttpUrl($inputCompanyWebsite) == true) {
            $('#inputCompanyWebsite').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputCompanyWebsite').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputCountry != '') {
            $('#inputCountry').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputCountry').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputPreferredMethod != '') {
            $('#inputPreferredMethod').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputPreferredMethod').addClass('is-invalid').removeClass('is-valid');
        }
        // if ($inputPaymentEmail != '' && IsEmail($inputPaymentEmail)==true) {
        //     $('#inputPaymentEmail').removeClass('is-invalid').addClass('is-valid');
        // } else {
        //     $flag++;
        //     $('#inputPaymentEmail').addClass('is-invalid').removeClass('is-valid');
        // }
        if ($user_role == 'Advertiser') {
            if ($inputBusinessName != '') {
                $('#inputBusinessName').removeClass('is-invalid').addClass('is-valid');
            } else {
                $flag++;
                $('#inputBusinessName').addClass('is-invalid').removeClass('is-valid');
            }
            if ($inputRegistrationNumber != '') {
                $('#inputRegistrationNumber').removeClass('is-invalid').addClass('is-valid');
            } else {
                $flag++;
                $('#inputRegistrationNumber').addClass('is-invalid').removeClass('is-valid');
            }
            if ($inputBillingAddress != '') {
                $('#inputBillingAddress').removeClass('is-invalid').addClass('is-valid');
            } else {
                $flag++;
                $('#inputBillingAddress').addClass('is-invalid').removeClass('is-valid');
            }
            if ($inputBillingCity != '') {
                $('#inputBillingCity').removeClass('is-invalid').addClass('is-valid');
            } else {
                $flag++;
                $('#inputBillingCity').addClass('is-invalid').removeClass('is-valid');
            }
            if ($inputBillingCountry != '') {
                $('#inputBillingCountry').removeClass('is-invalid').addClass('is-valid');
            } else {
                $flag++;
                $('#inputBillingCountry').addClass('is-invalid').removeClass('is-valid');
            }
            if ($inputPostalCode != '') {
                $('#inputPostalCode').removeClass('is-invalid').addClass('is-valid');
            } else {
                $flag++;
                $('#inputPostalCode').addClass('is-invalid').removeClass('is-valid');
            }
        }

        if ($flag == 0) {
            return true;
        } else {
            return false;
        }
    }); */
