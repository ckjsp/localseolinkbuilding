
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset_url('css/pages/page-auth.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('css/pages/front-page.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('css/pages/front-page-landing.css')); ?>" />

<?php $__env->stopPush(); ?>
<?php $__env->startSection('auth-content'); ?>

<!-- Content -->

<div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">

        <!-- /Left Text -->

        <div class="d-none d-lg-flex col-lg-7 p-0">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img src="<?php echo e(asset_url('img/illustrations/auth-login-illustration.png')); ?>" alt="auth-login-cover"
                    class="img-fluid my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-login-illustration.png"
                    data-app-dark-img="illustrations/auth-login-illustration.png" />
                <!-- <img src="<?php echo e(asset_url('img/illustrations/bg-shape-image-light.png')); ?>" alt="auth-login-cover"
                    class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png" /> -->
            </div>
        </div>

        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <?php if(session('verified')): ?>
                <div class="alert alert-success" role="alert"><?php echo e(session('verified')); ?></div>
                <?php endif; ?>
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="<?php echo e(url('/')); ?>" class="app-brand-link gap-2">
                        <img src="<?php echo e(asset_url('img/header-logo.png')); ?>" data-app-light-img="img/logo.svg"
                            data-app-dark-img="img/header-logo.png" alt="Logo" class="w-100">
                    </a>
                </div>
                <!-- /Logo -->
                <h3 class="mb-1 fw-bold">Welcome to <span class="animated-text"> Links Farmer! </span> 👋</h3>
                <p class="mb-4">Please sign-in to your account and start the adventure</p>

                <form class="mb-3" method="POST" action="<?php echo e(route('login')); ?>" id="user-login-form">
                    <?php echo csrf_field(); ?>
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
                            name="email" value="<?php echo e(old('email')); ?>" required placeholder="Enter your email or username"
                            autocomplete="email" autofocus>
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
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password"><?php echo e(__('Password')); ?></label>
                        </div>
                        <div class="input-group input-group-merge flex-nowrap">
                            <input type="password" id="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                autocomplete="current-password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
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
                        <div class="d-flex flex-row-reverse">
                            <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>">
                                <small><?php echo e(__('Forgot Your Password?')); ?></small>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                <?php echo e(old('remember') ? 'checked' : ''); ?> />
                            <label class="form-check-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary d-grid w-100"><?php echo e(__('Sign in')); ?></button>
                </form>

                <p class="text-center">
                    <span>New on our platform?</span>
                    <a href="<?php echo e(route('register')); ?>">
                        <span><?php echo e(__('Create an account')); ?></span>
                    </a>
                </p>
            </div>
        </div>

        <!-- /Login -->

    </div>
</div>

<!-- / Content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script src="<?php echo e(asset_url('js/pages-auth.js')); ?>"></script>

<script>
$(document).ready(function() {
    // Initialize validation
    var validator = $('#user-login-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            email: {
                email: "Please enter a valid email address"
            },
            password: {
                required: "Your password must be at least 8 characters long",
                minlength: "Your password must be at least 8 characters long"
            }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            element.closest(".mb-3").append(error);
        },
        highlight: function(element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });

    // Trigger validation on keyup for the password field
    $('#password').on('keyup', function() {
        validator.element('#password'); // Validate the password field on keyup
    });
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/auth/login.blade.php ENDPATH**/ ?>