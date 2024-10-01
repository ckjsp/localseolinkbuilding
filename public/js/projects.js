$(document).ready(function () {
    $.validator.addMethod(
        "minSelected",
        function (value, element, min) {
            var selected = $(element).find("option:selected").length;
            return selected >= min;
        },
        "Please select at least {0} options."
    );

    $.validator.addMethod("urlExists", function (value, element) {
        // Skip the AJAX check if the field is readonly
        if ($(element).prop("readonly")) {
            return true; // Treat as valid since we are not checking readonly fields
        }

        let urlExists = false;
        // Perform AJAX check
        $.ajax({
            url: '/check-url', // Your endpoint to check URL
            type: 'GET',
            data: { url: value },
            async: false, // Synchronous request for validation
            success: function (response) {
                urlExists = response.exists; // Set the value based on response
            },
        });
        return !urlExists; // Return true if the URL does NOT exist
    }, "This URL is already added in a project.");

    // jQuery Validation Code
    $("#project-form").validate({
        rules: {
            project_name: {
                required: true,
                minlength: 2,
            },
            project_url: {
                required: true,
                url: true,
                urlExists: true, // Add URL check here
            },
            "projectCategories[]": {
                minSelected: 1,
            },
            "projectForbiddenCategories[]": {
                minSelected: 1,
            },
            additional_note: {
                maxlength: 500,
            },
        },
        messages: {
            project_name: {
                required: "Please enter a project name.",
                minlength: "Project name must be at least 2 characters long.",
            },
            project_url: {
                required: "Please enter a project URL.",
                url: "Please enter a valid URL.",
                urlExists: "This URL has already been added in a project.", // Custom message
            },
            "projectCategories[]": "Please select at least one category.",
            "projectForbiddenCategories[]":
                "Please select at least one forbidden category.",
            additional_note: {
                maxlength: "Additional note cannot exceed 500 characters.",
            },
        },
        errorClass: "invalid-feedback",
        validClass: "valid-feedback",
        errorElement: "div",
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.next(".select2-container"));
            } else {
                error.insertAfter(element);
            }
        },
    });
});
