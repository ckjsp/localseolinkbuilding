<!doctype html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-wide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../../assets/"
    data-template="front-pages">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />



    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('/img/favicon.svg')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset_url('css/fonts/tabler-icons.eot') }}" />
    <link rel="stylesheet" href="{{ asset_url('css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset_url('css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset_url('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('css/pages/front-page.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/node-waves/node-waves.css') }}" />
    <script src="{{ asset_url('js/helpers.js') }}"></script>
    <script src="{{ asset_url('js/template-customizer.js') }}"></script>
    <script src="{{ asset_url('js/front-config.js') }}"></script>

</head>
<style>
    .navbar {
        height: 90px;
        /* Or any height you prefer */
    }
</style>

<body>

    <script src=" {{ asset_url('js/dropdown-hover.js') }}"></script>
    <script src="{{ asset_url('js/mega-dropdown.js') }}"></script>

    <nav class="layout-navbar shadow-none py-0 navbar-active">
        <div class="container">
            <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 ">

                <a href="#" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <a href="#" class="app-brand-link">
                            <a href="https://linksfarmer.com" class="app-brand-link gap-2">
                                <img src="https://linksfarmer.com//public/img/logo.svg" alt="Logo" class="w-75">
                            </a>
                        </a>
                    </span>
                </a>

                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">


                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">

                            <a class="nav-link fw-medium" aria-current="page" href="#">Home</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('terms-condition') }}">Terms</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('privacy-policy') }}">Privacy policy</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ route('contact-us') }}">Contact us</a>
                        </li>

                    </ul>
                </div>
                <div class="landing-menu-overlay d-lg-none"></div>

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="ti ti-sm"></i>
                        </a>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="ti ti-sm"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                            <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#" class="btn btn-primary me-2" target="_blank">
                                    <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                                    <span class="d-none d-md-block">Login</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-primary" target="_blank">
                                    <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                                    <span class="d-none d-md-block">Register</span>
                                </a>
                            </li>

                        </ul>
            </div>
        </div>
    </nav>