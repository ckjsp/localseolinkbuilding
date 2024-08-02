$("#inputImage").change(function () {
    const selectedFile = this.files[0];

    if (selectedFile) {
        const allowedFileTypes = [
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/jpg",
            "image/svg",
        ];
        if (allowedFileTypes.includes(selectedFile.type)) {
            $(this).removeClass("is-invalid").addClass("is-valid");
        } else {
            $(this).addClass("is-invalid").removeClass("is-valid");
            $("#inputImage").val("");
        }
    }
});

$(window).ready(function () {
    var input = document.querySelector("#inputPhoneNumber");
    var iti = window.intlTelInput(input, {
        separateDialCode: true,
        utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    $(".iti.iti--allow-dropdown").css("width", "100%");

    var defaultDialingCode = $("#dial_code").val();
    var countryCode = window.intlTelInputGlobals
        .getCountryData()
        .find(function (country) {
            return "+" + country.dialCode === defaultDialingCode;
        });
    if (countryCode) {
        iti.setCountry(countryCode.iso2);
    }

    input.addEventListener("countrychange", function () {
        var countryDialCode = iti.getSelectedCountryData().dialCode;
        $("#dial_code").val("+" + countryDialCode);
    });

    $.validator.addMethod(
        "validPhoneNumber",
        function (value, element) {
            if (!iti.isValidNumber()) {
                $(".iti__selected-flag").css("height", "60%");
            } else {
                $(".iti__selected-flag").css("height", "100%");
            }
            return iti.isValidNumber();
        },
        "Please enter a valid phone number"
    );

    function rulesFun() {
        const userRole = $("#user_role").val();
        const dynamicRules = {
            image: {
                required: false,
                accept: "image/jpeg,image/png,image/gif,image/jpg,image/svg",
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
                url: true,
            },
            country: "required",
            preferred_method: "required",
            payment_email: {
                required: false,
                email: true,
            },
        };
        if (userRole == "Advertiser") {
            dynamicRules.business_name = "required";
            dynamicRules.registration_number = "required";
            dynamicRules.billing_address = "required";
            dynamicRules.billing_city = "required";
            dynamicRules.billing_country = "required";
            dynamicRules.how_hear_about_us = "required";
            dynamicRules.postal_code = {
                required: true,
                maxlength: 6,
            };
        }
        return dynamicRules;
    }

    function messagesFun() {
        const userRole = $("#user_role").val();
        const dynamicMessages = {
            image: {
                required: " Please enter a profile image",
                accept: " Please select valid profile image ex. JPG,JPEG,PNG",
            },
            name: " Please enter your name",
            email: {
                required: " Please enter your email",
                email: " Please enter valid email address",
            },
            phone_number: {
                required: " Please enter a phone number",
                validPhoneNumber: "Please enter a valid phone number",
                // minlength: " Please enter valid phone number"
            },
            dial_code: " Please check your contury dial code",
            identity: " Please select your identity",
            company_website_url: {
                required: " Please enter your company website url",
                url: " Please Enter valid company website url",
            },
            country: " Please select your country",
            preferred_method: " Please select your preferred payment method",
            payment_email: {
                email: " Please enter valid payment email address",
            },
        };

        if (userRole == "Advertiser") {
            dynamicMessages.how_hear_about_us = "Please Select one option";
            dynamicMessages.business_name = "Please enter your business name";
            dynamicMessages.registration_number =
                "Please enter your registration number";
            dynamicMessages.billing_address =
                "Please enter your billing address";
            dynamicMessages.billing_city = "Please enter your billing city";
            dynamicMessages.billing_country =
                "Please select your billing country";
            dynamicMessages.postal_code = {
                required: " Please enter postal code",
                maxlength: " postal code should be 4-6 digits in length",
            };
        }

        return dynamicMessages;
    }
    $("#user-update-form").validate({
        rules: rulesFun(),
        messages: messagesFun(),
    });

    $("#change-password-form").validate({
        rules: {
            current_password: "required",
            password: "required",
            password_confirmation: {
                required: true,
                equalTo: "#newPassword",
            },
        },
        messages: {
            current_password: " Please enter your current password",
            password: "New Password is required",
            password_confirmation: {
                required: "Confirm Password is required",
                equalTo: "Password not matching",
            },
        },
    });
    $("button[type=submit]").click(function (event) {
        setTimeout(function () {
            if ($("#how_hear_about_us-error").length) {
                event.preventDefault();
                $("#how_hear_about_us-error").insertAfter("#how_hear_about_us");
            }
        });
    });
});

function isValidHttpUrl(str) {
    const pattern = new RegExp(
        "^(https?:\\/\\/)?" + // protocol
            "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|" + // domain name
            "((\\d{1,3}\\.){3}\\d{1,3}))" + // OR ip (v4) address
            "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" + // port and path
            "(\\?[;&a-z\\d%_.~+=-]*)?" + // query string
            "(\\#[-a-z\\d_]*)?$", // fragment locator
        "i"
    );
    return pattern.test(str);
}

function IsEmail(email) {
    console.log("OKKDS");
    var regex =
        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}
asset_url = $("html").data("assets-path");
fetch(asset_url + "json/country.json")
    .then((response) => response.json())
    .then((data) => {
        var $user_role = $("#user_role").val();
        $inputCountry = $("#inputCountry").data("val");
        $inputCountry = $inputCountry != "" ? $inputCountry : "india";
        /* $inputdial_code = $('#inputdial_code').data('val');
    $inputdial_code = ($inputdial_code != '') ? $inputdial_code : '+91'; */
        if ($user_role == "Advertiser") {
            $inputBillingCountry = $("#inputBillingCountry").data("val");
            $inputBillingCountry =
                $inputBillingCountry != "" ? $inputBillingCountry : "india";
        }
        data.map(function ($v) {
            $slct1 = $slct2 = "";
            if ($inputCountry == $v.name.toLowerCase()) {
                $slct1 = "selected";
            }
            /* if($inputdial_code == ($v.dial_code).toLowerCase()){
            $slct2 = "selected";
        } */
            $opt1 =
                '<option value="' +
                $v.name.toLowerCase() +
                '" data-code="' +
                $v.dial_code +
                '" ' +
                $slct1 +
                ">" +
                $v.name +
                "</option>";
            $("#inputCountry").append($opt1);
            /* $phoneopt = '<option value="'+$v.dial_code+'" data-country="'+($v.name).toLowerCase()+'" '+$slct2+'>'+$v.dial_code+'</option>';
        $('#inputdial_code').append($phoneopt); */
            if ($user_role == "Advertiser") {
                $slct2 =
                    $inputBillingCountry == $v.name.toLowerCase()
                        ? "selected"
                        : "";
                $opt2 =
                    '<option value="' +
                    $v.name.toLowerCase() +
                    '" data-code="' +
                    $v.dial_code +
                    '" ' +
                    $slct2 +
                    ">" +
                    $v.name +
                    "</option>";
                $("#inputBillingCountry").append($opt2);
            }
        });
    });

// $('#inputCountry').change(function(){
//     var $code = $(this).find('option:selected').data('code');
//     $('.phone_code').text($code);
//     $('#dial_code').val($code);
// });
