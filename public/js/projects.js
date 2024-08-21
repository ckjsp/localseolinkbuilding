$(document).ready(function () {
    $.validator.addMethod(
        "minSelected",
        function (value, element, min) {
            var selected = $(element).find("option:selected").length;
            return selected >= min;
        },
        "Please select at least {0} options."
    );

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
