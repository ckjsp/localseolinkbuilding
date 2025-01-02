<!doctype html>

<html lang="en" class="dark-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="front-pages">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('public/img/favicon.svg')}}" />
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
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/img/favicon.svg')}}" />
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
                <div class="navbar-brand app-brand demo d-flex  me-4">
                    <button class="navbar-toggler text-light border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-sm align-middle"></i>
                    </button>
                    <a href="landing-page.html" class="app-brand-link">
                        <div class="logo-wrap">
                            <img src="{{ asset_url('img/header-logo.png') }}" alt="logo">
                        </div>
                    </a>
                </div>

                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="navbar-toggler border-0 text-light position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                        <i class="ti ti-x ti-sm"></i>
                    </button>
                    <ul class="navbar-nav mx-auto">

                        <li class="nav-item mega-dropdown">
                            <a href="https://freebestseotools.com/"
                                class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                                aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                                Service
                            </a>
                            <div class="dropdown-menu custom-menu p-3 p-md-4">
                                <div class="row gy-4">

                                    <div class="col-12 col-lg">

                                        <ul class="nav flex-column">

                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('guest-posting-services') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Guest Posting </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('link-building-services') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Link Building
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('content-writing-services') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Content Writing
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('seo-reseller-services') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    SEO Reseller
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('content-writing-services') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Content Marketing </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item mega-dropdown">
                            <a href="https://freebestseotools.com/"
                                class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                                aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                                Tools
                            </a>
                            <div class="dropdown-menu custom-menu p-3 p-md-4">
                                <div class="row gy-4">

                                    <div class="col-12 col-lg">

                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/free-broken-links-checker"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Broken Links Finder </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/google-index-checker"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Google Index Checker </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/free-robots-txt-generator"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Robots.txt Generator
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/free-xml-sitemap-generator-tool"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    XML Sitemap Generator
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/google-malware-checker-tool"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Google Malware Checker
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-12 col-lg">

                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/free-seo-plagiarism-checker-tool"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Free Plagiarism Checker </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/free-word-counter-tool"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>

                                                    Word Counter </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="https://freebestseotools.com/domain-whois-checker-too"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Whois Checker </a>
                                            </li>
                                            <li class="nav-item">
                                                <button class="py-1 px-2 outlined-btn w-50 fs-6 mt-3"
                                                    onclick="window.open('https://freebestseotools.com/domain-whois-checker-too', '_blank')">
                                                    View
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </li>
                        <li class="nav-item mega-dropdown">
                            <a href="https://freebestseotools.com/"
                                class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                                aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                                Company
                            </a>
                            <div class="dropdown-menu custom-menu p-3 p-md-4">
                                <div class="row gy-4">

                                    <div class="col-12 col-lg">

                                        <ul class="nav flex-column">

                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('about-us') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    About Us </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="#"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Life at Link Publishers
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('contact-us') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Contact Us
                                                </a>
                                            </li>

                                        </ul>
                                    </div>


                                </div>
                            </div>

                        </li>
                        <li class="nav-item mega-dropdown">
                            <a href="https://freebestseotools.com/"
                                class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                                aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                                Resources
                            </a>
                            <div class="dropdown-menu custom-menu p-3 p-md-4">
                                <div class="row gy-4">

                                    <div class="col-12 col-lg">

                                        <ul class="nav flex-column">

                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('blog') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Blogs </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="{{ route('faq') }}"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    FAQs
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link"
                                                    href="#"
                                                    target="_blank">
                                                    <i class="ti ti-circle me-1"></i>
                                                    Help Center
                                                </a>
                                            </li>

                                        </ul>
                                    </div>


                                </div>
                            </div>

                        </li>
                        <li class="nav-item d-xl-none">
                            <a class="nav-link fw-medium" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item d-xl-none">
                            <a class="nav-link fw-medium" href="{{ route('register') }}">Sign Up for free</a>
                        </li>
                    </ul>
                </div>
                <div class="landing-menu-overlay d-xl-none"></div>

                <div class="navbar-nav flex-row gap-2 align-items-center ms-auto d-none d-xl-flex">
                    <a href="{{ route('login') }}" class="outlined-btn">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="filled-btn">
                        Sign Up for free
                    </a>
                </div>
            </div>
        </div>
    </nav>