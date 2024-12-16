@include('pages.header')

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />



    <meta name="description" content="" />



</head>

<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="hero-animation" class="hero-section">
            <div id="landingHero" class="section-py landing-hero position-relative">

                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1>First <span class="animated-text">AI-Driven</span>   Guest Post& Link Building Platform</h1>
                        <h3>
                            The future of link Building is here. Say goodbye to manual outreach. Reach a Wider Audience and build Authority with AI-suggested guest blogging on high-DA websites.
                        </h3>
                        <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Looking for the best link building platform? Join Links farmer today!
                        </h2>
                        <div class="d-flex flex-wrap justify-content-center gap-2 align-items-center">

                            <a href="#landingPricing" class="filled-btn">Buy Guest Post</a>
                            <a href="#landingPricing" class="outlined-btn">Sell Guest Post</a>

                        </div>
                    </div>
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="../vertical-menu-template/app-ecommerce-dashboard.html" target="_blank">
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img
                                    src="{{ asset_url('img/hero-element-img.png') }}"
                                    alt="hero dashboard"
                                    class="animation-img"
                                    data-app-light-img="{{ asset_url('img/hero-elements-img.png') }}"
                                    data-app-dark-img="{{ asset_url('img/hero-elements-img.png') }}" />
                                <img
                                    src="{{ asset_url('img/hero-element-img.png') }}"
                                    alt="hero elements"
                                    class="position-absolute hero-elements-img animation-img top-0 start-0"
                                    data-app-light-img="{{ asset_url('img/hero-elements-img.png') }}"
                                    data-app-dark-img="{{ asset_url('img/hero-elements-img.png') }}" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="landing-hero-blank"></div>
        </section>
        <!-- Hero: End -->

        <section id="getFeaturedOn" class="section-py  getFeaturedOn-section">
            <div class="text-center mb-3">
                <span class="title-section animated-text">Get Featured On</span>
            </div>
            <div class="swiper-logo-carousel py-4 my-lg-2">
                <div class="swiper" id="swiper-clients-logos">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img
                                    src="{{ asset_url('img/featured/chicago.png') }}"
                                    alt="client logo" />

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img
                                    src="{{ asset_url('img/featured/digital-gernal.png') }}"
                                    alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img
                                    src="{{ asset_url('img/featured/forbes.png') }}"
                                    alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img
                                    src="{{ asset_url('img/featured/hubspot.png') }}"
                                    alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img
                                    src="{{ asset_url('img/featured/mercury-news.png') }}"
                                    alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">
                                <img
                                    src="{{ asset_url('img/featured/yahoo.png') }}"
                                    alt="client logo" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section id="totalSection" class="total-section">
            <div class="container">
                <div class="row gy-5 mt-2">
                    <div class="col-lg-3 col-sm-6">
                        <div class="totals-card">
                            <h5 class="animated-text">854,248+</h5>
                            <p>Total Websites</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="totals-card">
                            <h5 class="animated-text">14,248+</h5>
                            <p>Total Publishers</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="totals-card">
                            <h5 class="animated-text">9,248+</h5>
                            <p>Total Advertisers</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="totals-card">
                            <h5 class="animated-text">42,248+</h5>
                            <p>Total Complete Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Real customers reviews: Start -->
        <section id="landingReviews" class="section-py  landing-reviews pb-0">

            <div class="container">
                <div class="row align-items-center gx-0 gy-4 g-lg-5">
                    <div class="col-md-6 col-lg-5 col-xl-3">
                        <div class="mb-3 pb-1">
                            <span class="title-section animated-text">Real Customers Reviews</span>
                        </div>
                        <h3 class="mb-1">
                            <span class="position-relative fw-bold z-1">What people say
                            </span>
                        </h3>
                        <p class="mb-3 mb-md-5">
                            See what our customers have to<br class="d-none d-xl-block" />
                            say about their experience.
                        </p>
                        <div class="landing-reviews-btns">
                            <button
                                id="reviews-previous-btn"
                                class="btn  swiper-btn me-3 scaleX-n1-rtl"
                                type="button">
                                <i class="ti ti-chevron-left ti-sm"></i>
                            </button>
                            <button id="reviews-next-btn" class="btn  swiper-btn scaleX-n1-rtl" type="button">
                                <i class="ti ti-chevron-right ti-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7 col-xl-9">
                        <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                            <div class="swiper" id="swiper-reviews">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card h-100 reviews-card">

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="logo-wrap me-2 ">
                                                    <img src="{{ asset_url('img/google-logo.png') }}" />
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">Cecilia Payne</h5>
                                                    <div class="text-warning">
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                            </p>
                                        </div>

                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100 reviews-card">

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="logo-wrap me-2 ">
                                                    <img src="{{ asset_url('img/google-logo.png') }}" />
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">Cecilia Payne</h5>
                                                    <div class="text-warning">
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                            </p>
                                        </div>

                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100 reviews-card">

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="logo-wrap me-2 ">
                                                    <img src="{{ asset_url('img/google-logo.png') }}" />
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">Cecilia Payne</h5>
                                                    <div class="text-warning">
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                            </p>
                                        </div>

                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100 reviews-card">

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="logo-wrap me-2 ">
                                                    <img src="{{ asset_url('img/google-logo.png') }}" />
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">Cecilia Payne</h5>
                                                    <div class="text-warning">
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                            </p>
                                        </div>

                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100 reviews-card">

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="logo-wrap me-2 ">
                                                    <img src="{{ asset_url('img/google-logo.png') }}" />
                                                </div>
                                                <div>
                                                    <h5 class="mb-0">Cecilia Payne</h5>
                                                    <div class="text-warning">
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                        <i class="ti ti-star-filled ti-sm"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Real customers reviews: End -->
        <section id="topFeatured" class="section-py topFeatured-section">
            <div class="container">
                <div class="text-center mb-3">
                    <span class="title-section animated-text">Top Featured</span>
                </div>
                <h1 class="subtitle-section text-center">
                    <span class="animated-text">October</span> Featured Websites
                </h1>
                <div class="img-wrap">
                    <img src="{{ asset_url('img/top-featured-img.png') }}" alt="top-featured-img">
                </div>
            </div>
        </section>

        <section id="whyUs" class="section-py whyUs-section">
            <div class="container">
                <div class="text-center mb-3">
                    <span class="title-section animated-text">Why us?</span>
                </div>
                <h1 class="subtitle-section text-center">
                    Why to choose Links farmer?
                </h1>
                <div class="container">
                    <div class="d-flex align-items-center">
                        <button
                            id="whyus-previous-btn"
                            class="btn  swiper-btn me-3 scaleX-n1-rtl"
                            type="button">
                            <i class="ti ti-chevron-left ti-sm"></i>
                        </button>

                        <div class="swiper-whyus-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                            <div class="swiper" id="swiper-whyus">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card h-100 whyus-card">
                                            <div class="h-100">
                                                <div class="img-wrap">
                                                    <img src="{{ asset_url('img/whyus/transparency.png') }}" alt="whyus-img">
                                                </div>
                                                <h6>100% Transparency</h6>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100 whyus-card">
                                            <div class="h-100">
                                                <div class="img-wrap">
                                                    <img src="{{ asset_url('img/whyus/content.png') }}" alt="whyus-img">
                                                </div>
                                                <h6>High Quality Content</h6>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100 whyus-card">
                                            <div class="h-100">
                                                <div class="img-wrap">
                                                    <img src="{{ asset_url('img/whyus/backlinks.png') }}" alt="whyus-img">
                                                </div>
                                                <h6>Earn High-Quality Backlinks</h6>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="whyus-button-next"></div>
                                <div class="whyus-button-prev"></div>
                            </div>
                        </div>

                        <button id="whyus-next-btn" class="btn swiper-btn scaleX-n1-rtl" type="button">
                            <i class="ti ti-chevron-right ti-sm"></i>
                        </button>

                    </div>

                </div>
            </div>
        </section>

        <section id="services" class="section-py services-section">
            <div class="container">
                <div class="text-center mb-3">
                    <span class="title-section animated-text">Our Services</span>
                </div>
                <h1 class="subtitle-section text-center">
                    Are you in search of a <span class="animated-text"> complete solution </span> for your digital product?
                </h1>
                <h5 class="subtitle2-section text-center">Explore our range of services designed for a well-rounded strategy to boost your online presence.</h5>
                <div class="row gy-3">
                    <div class="col-lg-3 col-sm-6">
                        <div class="services-card">
                            <div class="img-wrap">
                                <img src="{{ asset_url('img/services/service1.png') }}" alt="service-img">
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Guest Post</h6>
                                <i class="ti ti-arrow-narrow-right "></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="services-card">
                            <div class="img-wrap">
                                <img src="{{ asset_url('img/services/service2.png') }}" alt="service-img">
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Guest Post</h6>
                                <i class="ti ti-arrow-narrow-right "></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="services-card">
                            <div class="img-wrap">
                                <img src="{{ asset_url('img/services/service3.png') }}" alt="service-img">
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Guest Post</h6>
                                <i class="ti ti-arrow-narrow-right "></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="services-card">
                            <div class="img-wrap">
                                <img src="{{ asset_url('img/services/service4.png') }}" alt="service-img">
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6>Guest Post</h6>
                                <i class="ti ti-arrow-narrow-right "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <section id="getRegistered" class="section-py getRegistered-section">
        <div class="container">

            <div class="registered-wrap">
                <div class="row  align-items-center flex-column-reverse flex-md-row">
                    <div class="col-md-6">
                        <h1>First AI-Driven Guest Post& Link Building Platform</h1>
                        <p>The future of link Building is here. Say goodbye to manual outreach. Reach a Wider Audience and build Authority with AI-suggested guest blogging on high-DA websites.</p>
                        <button type="button" class="btn-white">Get Registered</button>
                    </div>
                    <div class="col-md-6">
                        <div class="img-wrap">
                            <img src="{{ asset_url('img/registered-img.png') }}" alt="registered-img">
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>

    </div>


    @include('pages.footer')

    <script src="{{ asset_url('libs/popper/popper.js') }}"></script>
    <script src="{{ asset_url('js/bootstrap.js') }}"></script>
    <script src="{{ asset_url('libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset_url('js/front-main.js') }}"></script>

    <!-- Core JS -->
    <!-- build:js /js/core.js -->
    <script src="{{ asset_url('libs/popper/popper.js') }}"></script>
    <script src="{{ asset_url('js/bootstrap.js') }}"></script>
    <script src="{{ asset_url('libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset_url('libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset_url('libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset_url('assets/front-main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset_url('assets/front-page-landing.js') }}"></script>


</body>

</html>