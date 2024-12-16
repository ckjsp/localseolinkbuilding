<!doctype html>

<html
    lang="en"
    class="dark-style layout-navbar-fixed layout-wide"
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
    <link rel="stylesheet" href="{{ asset_url('css/pages/front-page-landing.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/node-waves/node-waves.css') }}" />


    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.svg')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset_url('fonts/tabler-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset_url('css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/swiper/swiper.css') }}" />

    <link rel="stylesheet" href="{{ asset_url('css/pages/front-page-landing.css') }}" />

    <script src="{{ asset_url('js/helpers.js') }}"></script>
    <script src="{{ asset_url('js/template-customizer.js') }}"></script>
    <script src="{{ asset_url('js/front-config.js') }}"></script>

</head>


<body>

    <script src=" {{ asset_url('js/dropdown-hover.js') }}"></script>
    <script src="{{ asset_url('js/mega-dropdown.js') }}"></script>
    <nav class="layout-navbar custom-navbar shadow-none py-0">
        <div class="container">
            <div class="navbar navbar-expand-xl landing-navbar">
                <!-- Menu logo wrapper: Start -->
                <div class="navbar-brand app-brand demo d-flex  me-4">
                    <!-- Mobile menu toggle: Start-->
                    <button
                        class="navbar-toggler text-light border-0 px-0 me-2"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-sm align-middle"></i>
                    </button>
                    <!-- Mobile menu toggle: End-->
                    <a href="landing-page.html" class="app-brand-link">
                        <div class="logo-wrap">
                            <img src="{{ asset_url('img/header-logo.png') }}" alt="logo">
                        </div>
                    </a>
                </div>
                <!-- Menu logo wrapper: End -->
                <!-- Menu wrapper: Start -->
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button
                        class="navbar-toggler border-0 text-light position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="true"
                        aria-label="Toggle navigation">
                        <i class="ti ti-x ti-sm"></i>
                    </button>
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page" href="landing-page.html#landingHero">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="https://freebestseotools.com/" target="_blank">Tools</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="landing-page.html#landingTeam">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="landing-page.html#landingFAQ">Resources</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="landing-page.html#landingContact">Contact us</a>
                        </li>
                        <li class="nav-item d-xl-none">
                            <a class="nav-link fw-medium" href="#">Login</a>
                        </li>
                        <li class="nav-item d-xl-none">
                            <a class="nav-link fw-medium" href="#">Sign Up for free</a>
                        </li>

                    </ul>
                </div>
                <div class="landing-menu-overlay d-xl-none"></div>
                <!-- Menu wrapper: End -->
                <!-- Toolbar: Start -->
                <ul class="navbar-nav flex-row gap-2 align-items-center ms-auto d-none d-xl-flex">
                    <!-- navbar button: Start -->
                    <li>
                        <a href="#" class="outlined-btn">
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="#" class="filled-btn">
                            Sign Up for free
                        </a>
                    </li>
                    <!-- navbar button: End -->
                </ul>
                <!-- Toolbar: End -->
            </div>
        </div>
    </nav>