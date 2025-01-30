<?php
$pagetitale = 'Guest Post Marketplace | Link Building Platform | Links Farmer';
$content = 'Links Farmer combines the best of a guest post marketplace and link building platform. Buy and sell guest posts to grow your SEO effortlessly.';
?>
@include('pages.header')



<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="hero-animation" class="hero-section">
            <div id="landingHero" class="section-py landing-hero position-relative">

                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="page-title">Welcome to <span class="animated-text"> LINKSFARMER </span> – Your
                            Trusted <br /> Partner in
                            Link Building!</h1>
                        <h3 class="page_subtitle">
                            We, LINKSFARMER, specialize in delivering premium quality link-building services. Our
                            services are designed to elevate your online presence. Whether you are a business owner, SEO
                            agency, or content marketer, improve the website’s authority, visibility, and search engine
                            rankings. Cultivate your online success by exploring our services. We help your brand thrive
                            in the competitive digital world. Your success is our mission! </h3>
                        <div class="d-flex flex-wrap justify-content-center gap-2 align-items-center">
                            @php
                            $userRole = auth()->check() ? auth()->user()->role_id : null;
                            @endphp

                            <!-- Buy Guest Post button -->
                            @if(auth()->check())
                            @if($userRole == 3)
                            <a href="{{ route('advertiser') }}" class="filled-btn">Buy Guest Post</a>
                            @else
                            <a class="filled-btn disabled" href="javascript:void(0);">Buy Guest Post</a>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="filled-btn">Buy Guest Post</a>
                            @endif

                            <!-- Sell Guest Post button -->
                            @if(auth()->check())
                            @if($userRole == 2)
                            <a href="{{ route('publisher') }}" class="outlined-btn">Sell Guest Post</a>
                            @else
                            <a class="outlined-btn disabled" href="javascript:void(0);">Sell Guest Post</a>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="outlined-btn">Sell Guest Post</a>
                            @endif
                        </div>



                    </div>
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                            <img src="{{ asset_url('img/hero-element-img.png') }}" alt="hero dashboard"
                                class="animation-img"
                                data-app-light-img="{{ asset_url('img/hero-elements-img.png') }}"
                                data-app-dark-img="{{ asset_url('img/hero-elements-img.png') }}" />
                            <img src="{{ asset_url('img/hero-element-img.png') }}" alt="hero elements"
                                class="position-absolute hero-elements-img animation-img top-0 start-0"
                                data-app-light-img="{{ asset_url('img/hero-elements-img.png') }}"
                                data-app-dark-img="{{ asset_url('img/hero-elements-img.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="landing-hero-blank"></div>
        </section>
        <!-- Hero: End -->

        <section id="getFeaturedOn" class="section-py  light-bg">
            <div class="text-center mb-3">
                <span class="title-section animated-text">Get Featured On</span>
            </div>
            <div class="swiper-logo-carousel py-4 my-lg-2">
                <div class="swiper" id="swiper-clients-logos">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img src="{{ asset_url('img/featured/chicago.png') }}" alt="client logo" />

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img src="{{ asset_url('img/featured/digital-gernal.png') }}" alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img src="{{ asset_url('img/featured/forbes.png') }}" alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img src="{{ asset_url('img/featured/hubspot.png') }}" alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">

                                <img src="{{ asset_url('img/featured/mercury-news.png') }}" alt="client logo" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-logo-wrap">
                                <img src="{{ asset_url('img/featured/yahoo.png') }}" alt="client logo" />
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
                            <span class="position-relative fw-bold z-1 subtitle-section">What people say
                            </span>
                        </h3>
                        <p class="mb-3 mb-md-5">
                            See what our customers have to<br class="d-none d-xl-block" />
                            say about their experience.
                        </p>
                        <div class="landing-reviews-btns">
                            <button id="reviews-previous-btn" class="btn  swiper-btn me-3 scaleX-n1-rtl" type="button">
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
                                                    <h5 class="mb-0">David Mitchell</h5>
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
                                                This platform is a game-changer for SEO! I’ve used it multiple times and always get high-quality links from reputable sites. Highly recommend it for marketers and bloggers alike.
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
                                                    <h5 class="mb-0">Samantha Collins</h5>
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
                                                The platform has potential, but I found the pricing a bit steep for smaller businesses. However, the quality of available blogs is commendable.
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
                                                    <h5 class="mb-0">Neha Gupta</h5>
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
                                                Fantastic platform for content marketing. I got featured on several high-DA sites, which significantly boosted my SEO efforts.
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

        <section id="whyToReach" class="section-py light-bg">
            <div class="container">
                <h2 class="subtitle-section text-center"> Why To
                    <span class="animated-text">Reach LINKSFARMER?</span>
                </h2>
                <div class="row justify-content-center ">
                    <div class="col-lg-10">
                        <div class="whytoreact-wrap">
                            <p>We have experienced professionals who provide trusted care to your website. Many clients
                                across industries boost their digital footprint by approaching us.</p>
                            <p>Embrace comprehensive solutions from guest posting to niche edits. Seekers can grab a
                                wide
                                range of link-building strategies to meet the unique needs of a website.</p>
                            <p>By collaborating with reputable websites, it’s effortless to ensure quality assurance. All links will be natural and impactful for successful SEO goals.</p>
                            <p>Our focused strategies are built on thorough research, and every link will add value and
                                strengthen online presence.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="topFeatured" class="section-py topFeatured-section">
            <div class="container">
                <div class="text-center mb-3">
                    <span class="title-section animated-text">Top Featured</span>
                </div>
                <h2 class="subtitle-section text-center">
                    <span class="animated-text">January </span> Featured Websites
                </h2>
                <div class="img-wrap">
                    <img src="{{ asset_url('img/Featured Websites.png') }}" alt="top-featured-img">
                </div>
            </div>
        </section>

        <section id="whyUs" class="section-py light-bg">
            <div class="container">
                <div class="text-center mb-3">
                    <span class="title-section animated-text">Why us?</span>
                </div>
                <h2 class="subtitle-section text-center">
                    Why to choose LINKSFARMER
                </h2>

                <div class="d-flex align-items-center">
                    <button id="whyus-previous-btn" class="btn  swiper-btn me-3 scaleX-n1-rtl" type="button">
                        <i class="ti ti-chevron-left ti-sm"></i>
                    </button>

                    <div class="swiper-whyus-carousel overflow-hidden">
                        <div class="swiper" id="swiper-whyus">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="card h-100 whyus-card">
                                        <div class="h-100">
                                            <div class="img-wrap">
                                                <img src="{{ asset_url('img/whyus/transparency.png') }}"
                                                    alt="whyus-img">
                                            </div>
                                            <h6>100% Transparency</h6>
                                            <p>
                                                LINKSFARMER offers clear metrics and upfront communication, ensuring you know exactly where your content is published. No hidden costs, just honest and transparent service.
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
                                                Our team delivers well-researched, SEO-optimized, and original articles tailored to your niche, ensuring your brand stands out with top-tier content.
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
                                                Gain backlinks from high-authority websites that boost your site’s credibility, drive organic traffic, and improve search rankings effectively.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="whyus-button-next"></div>
                            <div class="whyus-button-prev"></div>
                        </div>
                    </div>

                    <button id="whyus-next-btn" class="btn swiper-btn ms-3 scaleX-n1-rtl" type="button">
                        <i class="ti ti-chevron-right ti-sm"></i>
                    </button>

                </div>


            </div>
        </section>

        <section id="services" class="section-py services-section">
            <div class="container">
                <div class="text-center mb-3">
                    <span class="title-section animated-text">Our Services</span>
                </div>
                <h2 class="subtitle-section text-center">
                    Are you in search of a <span class="animated-text"> complete solution </span> <br /> for your
                    digital
                    product?
                </h2>
                <h5 class="subtitle2-section text-center">Enhance your online presence with our tailored services crafted for a comprehensive strategy.</h5>

                <div class="data_wrap">
                    <div class="row gy-3">
                        <div class="col-lg-3 col-sm-6 col-6 ">
                            <a href="{{ route('content-writing-services') }}">

                                <div class="services-card">
                                    <div class="img-wrap">
                                        <img src="{{ asset_url('img/services/service1.png') }}" alt="service-img">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Content Writing</h6>
                                        <i class="ti ti-arrow-narrow-right "></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6 ">
                            <a href="{{ route('link-building-services') }}">

                                <div class="services-card">
                                    <div class="img-wrap">
                                        <img src="{{ asset_url('img/services/service2.png') }}" alt="service-img">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Link Building</h6>
                                        <i class="ti ti-arrow-narrow-right "></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6 ">
                            <a href="{{ route('content-marketing-services') }}">

                                <div class="services-card">
                                    <div class="img-wrap">
                                        <img src="{{ asset_url('img/services/service3.png') }}" alt="service-img">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>Content Marketing</h6>
                                        <i class="ti ti-arrow-narrow-right "></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6 ">
                            <a href="{{ route('seo-reseller-services') }}">

                                <div class="services-card">
                                    <div class="img-wrap">
                                        <img src="{{ asset_url('img/services/service4.png') }}" alt="service-img">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6>SEO Reseller</h6>
                                        <i class="ti ti-arrow-narrow-right "></i>
                                    </div>
                                </div>
                            </a>
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
                            <h2>The First Artificial Intelligence Driven Guest Post & Link Building Spot!</h2>
                            <p>Revolutionize your link-building effortlessly with our AI-driven guest post platform. You'll be 100% sure to reach a wider audience and establish authority on high-DA websites. Embrace it without the hassle of manual outreach.</p>
                            <a href="{{ route('register') }}">
                                <button type="button" class="btn-white">Get Registered</button>
                            </a>

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