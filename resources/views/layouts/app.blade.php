@php $slug = isset($slug) ? $slug : ''; @endphp
<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset_url() }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="YLCayHYkKvCKvayPOUHJnQ43h6I2p0IEf35uBwX7iQo" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset_url('img/favicon.svg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset_url('fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('fonts/flag-icons.css') }}" />
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset_url('css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset_url('css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset_url('css/demo.css') }}?{{ time() }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset_url('libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

    <!-- Page CSS -->
    @auth
    <link rel="stylesheet" href="{{ asset_url('css/pages/cards-advance.css') }}" />
    @endauth
    @stack('css')
    <script src="{{ asset_url('js/jquery.js') }}"></script>

    <!-- Helpers -->
    <script src="{{ asset_url('js/helpers.js') }}"></script>
    <script src="{{ asset_url('js/template-customizer.js') }}"></script>
    <script src="{{ asset_url('js/config.js') }}"></script>
    <script src="{{ asset_url('js/form-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset_url('js/form-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset_url('js/projectMenu.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B59LHVYPW3"></script>


</head>

<body>
    @auth
    @if(Auth::user()->hasVerifiedEmail())
    <!-- Layout wrapper -->
    <div
        class="{{ (Auth::user()->role->name == 'Advertiser' && $slug != 'marketplace') ? 'layout-wrapper layout-navbar-full layout-horizontal layout-without-menu' : 'layout-wrapper layout-content-navbar' }}">

        <div class="layout-container">
            @if(Auth::user()->role->name == 'Advertiser')
            @include('includes.second_navbar')
            @else
            @include('includes.navbar')
            @endif
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                    @include('includes.footer')
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <!-- / Layout wrapper -->

    @endif
    @endauth
    @yield('auth-content')

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset_url('libs/popper/popper.js') }}"></script>
    <script src="{{ asset_url('js/bootstrap.js') }}"></script>
    <script src="{{ asset_url('libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset_url('libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset_url('libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset_url('libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset_url('libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset_url('libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset_url('js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset_url('libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset_url('js/main.js') }}"></script>
    @auth
    @if(Auth::user()->role->name == 'Advertiser')
    <script>
        $cartCookie = getCookie('cart')
        if ($cartCookie != '') {
            $cartArr = JSON.parse($cartCookie);
            $('.nav-cart-icon').attr('data-item-count', $cartArr.length);
        }
    </script>
    @endif
    @endauth
    @stack('script')



    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6784e3bd49e2fd8dfe069a7c/1ihfhj7t5';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>