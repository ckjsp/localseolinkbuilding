

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset_url('css/pages/page-auth.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('auth-content'); ?>


<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">

        <!-- /Left Text -->

        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="<?php echo e(asset_url('img/illustrations/auth-register-illustration.png')); ?>" alt="auth-register-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-register-illustration.png"
                    data-app-dark-img="illustrations/auth-register-illustration.png" />
                <!-- <img src="<?php echo e(asset_url('img/illustrations/bg-shape-image-light.png')); ?>" alt="auth-register-cover"
                    class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png" /> -->
            </div>
        </div>

        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">

                <div class="app-brand mb-4">
                    <a href="index.html" class="app-brand-link gap-2">
                        <img src="<?php echo e(asset_url('img/header-logo.png')); ?>" alt="Logo" class="w-100">
                    </a>
                </div>

                <h3 class="mb-1 fw-bold">Adventure starts here 🚀</h3>
                <p class="mb-4">Make your app management easy and fun!</p>

                <form method="POST" class="mb-3" action="<?php echo e(route('register')); ?>" id="user-register-form">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label"><?php echo e(__('Name')); ?></label>
                        <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="name" placeholder="Enter your username" value="<?php echo e(old('name')); ?>" required
                            autocomplete="name" autofocus>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><?php echo e(__('Email')); ?></label>
                        <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Enter your email" name="email" value="<?php echo e(old('email')); ?>" required
                            autocomplete="email">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password"><?php echo e(__('Password')); ?></label>
                        <div class="input-group input-group-merge">
                            <input id="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" required autocomplete="new-password">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            <span class="invalid-feedback"><strong class="pass-msg"></strong></span>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password-confirm"><?php echo e(__('Confirm Password')); ?></label>
                        <div class="input-group input-group-merge">
                            <input id="password-confirm" type="password"
                                class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" required autocomplete="new-password">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="d-block form-label"><?php echo e(__('User Role')); ?></label>
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
                    <button type="submit" class="btn btn-primary d-grid w-100"><?php echo e(__('Register')); ?></button>

                </form>
                <p class="text-center">OR</p>
                <form method="GET" action="<?php echo e(route('login.google')); ?>" id="google-form">
                    <input type="hidden" name="selected_role" id="selected_role">
                    <div class="row mb-3">
                        <label class="d-block form-label"><?php echo e(__('User Role')); ?></label>
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

                    <button type="submit" class="btn btn-primary d-grid w-100 mb-3">Sign in with Google</button>

                    <!-- <a href="<?php echo e(route('login.google')); ?>" class="btn btn-primary  d-grid w-100 mb-3">Sign in with
                        Google</a> -->
                </form>
                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="<?php echo e(route('login')); ?>">
                        <span><?php echo e(__('Sign in instead')); ?></span>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset_url('js/pages-auth.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
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
        errorPlacement: function(error, element) {
            if (element.attr("name") == "role") {
                error.insertAfter(element.closest(".row"));
            } else {
                error.addClass("invalid-feedback");
                element.closest(".mb-3").append(error);
            }
        },
        highlight: function(element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });

    $('#password').on('keyup', function() {
        validator.element('#password'); // Validate the password field on keyup
    });


    var gvalidator = $('#google-form').validate({
        rules: {
            role: {
                required: true
            }
        },
        messages: {
            role: {
                required: "Please select a role before signing in with Google."
            }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorElement: "div",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "role") {
                error.insertAfter(element.closest(".row"));
            } else {
                error.addClass("invalid-feedback");
                element.closest(".mb-3").append(error);
            }
        },
        highlight: function(element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });

    $('#google-form').on('submit', function(event) {
        var selectedRole = $('input[name="g-role"]:checked').val();
        if (!selectedRole) {
            event.preventDefault();
        } else {
            $('#selected_role').val(selectedRole);
        }
    });

});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/auth/register.blade.php ENDPATH**/ ?>