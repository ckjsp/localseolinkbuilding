$(document).ready(function () {
    $.validator.addMethod("minSelected", function (value, element, min) {
        var selectedCount = $(element).val() ? $(element).val().length : 0;
        console.log(`Element: ${element.id}, Selected Count: ${selectedCount}`);
        return selectedCount >= min;
    }, $.validator.format("Please select at least {0} item(s)."));  
    $('#projectCategories').select2({
        placeholder: "Select categories",
        allowClear: true
    });
    $('#projectForbiddenCategories').select2({
        placeholder: "Select forbidden categories",
        allowClear: true
    });

    // jQuery Validation Code
    $("#project-form").validate({
        rules: {
            project_name: {
                required: true,
                minlength: 2
            },
            project_url: {
                required: true,
                url: true
            },
            projectCategories: {
                minSelected: 1
            },
            projectForbiddenCategories: {
                minSelected: 1
            },
            additional_note: {
                maxlength: 500
            }
        },
        messages: {
            project_name: {
                required: "Please enter a project name.",
                minlength: "Project name must be at least 2 characters long."
            },
            project_url: {
                required: "Please enter a project URL.",
                url: "Please enter a valid URL."
            },
            projectCategories: "Please select at least one category.",
            projectForbiddenCategories: "Please select at least one forbidden category.",
            additional_note: {
                maxlength: "Additional note cannot exceed 500 characters."
            }
        },
        errorClass: "invalid-feedback",
        validClass: "valid-feedback",
        errorElement: "div",
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
});
