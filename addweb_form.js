$('#site_verification_file').change(function() {
    const selectedFile = this.files[0]; // Get the selected file

    if (selectedFile) {
        const allowedFileTypes = ['application/pdf','image/jpg','image/jpeg','image/png'];

        if (allowedFileTypes.includes(selectedFile.type)) {
            $(this).removeClass('is-invalid').addClass('is-valid');
            // Valid file type
        } else {
            $(this).addClass('is-invalid').removeClass('is-valid');
            // Invalid file type
            $('#fileInput').val(''); // Clear the file input
        }
    }
});

$(window).ready(function () {
    $('#inputForbiddenCategories1').change(function(){
        inputval = $(this).val();
        if(inputval != ''){
            $('#inputForbiddenCategories').val(inputval.join(','));
        }
    });
    $('#inputCategories1').change(function(){
        inputval = $(this).val();
        if(inputval != ''){
            $('#inputCategories').val(inputval.join(','));
        }
    });
    
    $('#inputGuidelines').on('input', function(){
        inputval = ($(this).val());
        if(inputval.length > 1000){
            $('#inputGuidelinesTextCount').text(0);
            $(this).addClass('error');
        }else{
            $(this).removeClass('error');
            $('#inputGuidelinesTextCount').text((1000-inputval.length));
        }
    });

    $.validator.addMethod("domainMatch", function(value, element) {
        // Replace "example.com" with your sample post URL domain
        var url1 = new URL($('#inputWebUrl').val());
        var urlDomain = url1.hostname;
        var url = new URL(value);
        var sampleDomain = url.hostname;
        return sampleDomain === urlDomain;
      }, "Domain should match with the website URL domain.");

    $("#addWebsiteForm").validate({
        rules: {
            website_url: {
                required: true,
                url: true
            },
            domain_authority: {
                required: true,
                integer: true,
                range: [1, 100]
            },
            page_authority: {
                required: true,
                integer: true,
                range: [1, 100]
            },
            spam_score: {
                required: true,
                integer: true,
                range: [0, 100]
            },
            publishing_time: "required",
            minimum_word_count_required: {
                required: true,
                integer: true,
                range: [1, 1000]
            },
            backlink_type: "required",
            maximum_no_of_backlinks_allowed: "required",
            domain_life_validity: "required",
            sample_post_url: {
                required: true,
                url: true,
                domainMatch: true
            },
            guidelines: {
                maxlength: 1000
            },
            inputCategories1: "required",
            inputForbiddenCategories1: "required",
            guest_post_price: {
                required: true,
                number: true,
                min: 1
            },
            link_insertion_price: {
                required: true,
                number: true,
                min: 1
            },
            // fc_guest_post_price: {
            //     required: true,
            //     number: true,
            //     min: 1
            // },
            // fc_link_insertion_price: {
            //     required: true,
            //     number: true,
            //     min: 1
            // },
            site_verification_file: {
                required: false,
                accept: "application/pdf,image/jpg,image/jpeg,image/png"
            },
            readedguide: "required",
        },
        messages: {
            website_url: {
                required: " Please enter your website url",
                url: " Please Enter valid website url ex.(https://example.com)"
            },
            domain_authority: {
                required: " Please enter a domain authority",
                integer:" Your domain authority must be numbers only",
                range: " domain authority should be 1 to 100"
            },
            page_authority: {
                required: " Please enter a page authority",
                integer:" Your page authority must be numbers only",
                range: " page authority should be 1 to 100"
            },
            spam_score: {
                required: " Please enter a Spam Score",
                integer:" Your Spam Score must be numbers only",
                range: " Spam Score should be 0 to 100"
            },
            name: " Please select publishing time",
            minimum_word_count_required: {
                required: " Please enter required minimum word count",
                integer:" Your minimum word count must be numbers only",
                range: " Required minimum word count should be 1 to 1000"
            },
            backlink_type: " Please select backlink type",
            maximum_no_of_backlinks_allowed: " Please select maximum no of backlinks allowed",
            domain_life_validity: " Please select domain life validity",
            sample_post_url: {
                required: " Please enter your sample post url",
                url: " Please Enter valid sample post url ex.(https://example.com/post)"
            },
            guidelines: {
                maxlength: "Maximum 1000 characters allowed."
            },
            inputCategories1: " Please select categories",
            inputForbiddenCategories1: " Please select forbidden categories",
            guest_post_price: {
                required: "Please enter a guest post price.",
                number: "Please enter a valid guest post price.",
                min: "Please enter a guest post price greater than or equal to 1."
            },
            link_insertion_price: {
                required: "Please enter a link insertion price.",
                number: "Please enter a valid link insertion price.",
                min: "Please enter a link insertion price greater than or equal to 1."
            },
            // fc_guest_post_price: {
            //     required: "Please enter a fc guest post price.",
            //     number: "Please enter a valid fc guest post price.",
            //     min: "Please enter a fc guest post price greater than or equal to 1."
            // },
            // fc_link_insertion_price: {
            //     required: "Please enter a fc link insertion price.",
            //     number: "Please enter a valid fc link insertion price.",
            //     min: "Please enter a fc link insertion price greater than or equal to 1."
            // },
            site_verification_file: {
                required: " Please upload a site verification file",
                accept: " Please upload valid site verification file ex. PDF, JPEG, JPG, and PNG"
            },
            readedguide: " Please make sure to thoroughly read the guide before checking the 'I have read' button.",
        }
    });
});

/* $('#addWebsiteForm').submit(function() {
    var $inputWebUrl = $('#inputWebUrl').val();
    var $inputDomainAuthority = $('#inputDomainAuthority').val();
    var $inputPublishingTime = $('#inputPublishingTime').val();
    var $inputWordCount = $('#inputWordCount').val();
    var $inputBacklinkType1 = $('#inputBacklinkType1').val();
    var $inputBacklinkType2 = $('#inputBacklinkType2').val();
    var $inputBacklinksAllowed = $('#inputBacklinksAllowed').val();
    var $inputDomainLifeValidity = $('#inputDomainLifeValidity').val();
    var $inputSamplePostUrl = $('#inputSamplePostUrl').val();
    var $inputGuidelines = $('#inputGuidelines').val();
    var $inputCategories1 = $('#inputCategories1').val();
    var $inputForbiddenCategories1 = $('#inputForbiddenCategories1').val();
    var $inputGuestPostPrice = $('#inputGuestPostPrice').val();
    var $inputLinkInsertionPrice = $('#inputLinkInsertionPrice').val();
    var $inputFCGuestPostPrice = $('#inputFCGuestPostPrice').val();
    var $inputFCLinkInsertionPrice = $('#inputFCLinkInsertionPrice').val();
    var $site_verification_file = $('#site_verification_file').val();
    var $old_site_verification_file = $('#old_site_verification_file').val();

    var $flag = 0;
    if ($('#id').val() == undefined || $('#id').val() == '') {
        if ($inputWebUrl != '' && isValidHttpUrl($inputWebUrl) == true) {
            $('#inputWebUrl').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputWebUrl').addClass('is-invalid').removeClass('is-valid');
        }
    }
    if ($inputDomainAuthority != '') {
        $('#inputDomainAuthority').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputDomainAuthority').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputPublishingTime != '') {
        $('#inputPublishingTime').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputPublishingTime').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputWordCount != '') {
        $('#inputWordCount').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputWordCount').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputBacklinkType1 != '') {
        $('input[name="backlink_type"]').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('input[name="backlink_type"]').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputBacklinksAllowed != '') {
        $('#inputBacklinksAllowed').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputBacklinksAllowed').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputDomainLifeValidity != '') {
        $('#inputDomainLifeValidity').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputDomainLifeValidity').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputSamplePostUrl != '' && isValidHttpUrl($inputSamplePostUrl) == true) {
        $('#inputSamplePostUrl').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputSamplePostUrl').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputSamplePostUrl != '' && $inputWebUrl != '') {
        if ($inputSamplePostUrl == $inputWebUrl) {
            $flag++;
            $('.url-msg').text("Please enter valid sample post URL.");
            $('#inputSamplePostUrl').addClass('is-invalid').removeClass('is-valid');
        } else if (getDomain($inputWebUrl) !== getDomain($inputSamplePostUrl)) {
            $flag++;
            $('.url-msg').text("Sample post URL should contain your website's domain name.");
            $('#inputSamplePostUrl').addClass('is-invalid').removeClass('is-valid');
        }
    }
    if ($inputGuidelines != '' && $inputGuidelines.length <= 400) {
        $('#inputGuidelines').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputGuidelines').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputCategories1 != '') {
        $('#inputCategories').val($inputCategories1.join(','));
        $('#inputCategories1').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputCategories1').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputForbiddenCategories1 != '') {
        $('#inputForbiddenCategories').val($inputForbiddenCategories1.join(','));
        $('#inputForbiddenCategories1').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputForbiddenCategories1').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputGuestPostPrice != '') {
        $('#inputGuestPostPrice').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputGuestPostPrice').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputLinkInsertionPrice != '') {
        $('#inputLinkInsertionPrice').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputLinkInsertionPrice').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputFCGuestPostPrice != '') {
        $('#inputFCGuestPostPrice').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputFCGuestPostPrice').addClass('is-invalid').removeClass('is-valid');
    }
    if ($inputFCLinkInsertionPrice != '') {
        $('#inputFCLinkInsertionPrice').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#inputFCLinkInsertionPrice').addClass('is-invalid').removeClass('is-valid');
    }
    if ($site_verification_file != '' && old_site_verification_file != '') {
        $('#site_verification_file').removeClass('is-invalid').addClass('is-valid');
    } else {
        $flag++;
        $('#site_verification_file').addClass('is-invalid').removeClass('is-valid');
    }
    if ($flag == 0) {
        return true;
    } else {
        return false;
    }
});
 */
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

function getDomain(url) {
    var a = document.createElement('a');
    a.href = url;
    return a.hostname;
}