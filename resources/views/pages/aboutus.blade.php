<?php
$pagetitale = 'About Us | Links Farmer';
$content = 'Links Farmer is a marketplace platform that offers guest posts and link-building services. Connect with top publishers to buy high-quality guest posts and build authoritative backlinks that enhance your SEO strategy and boost search engine rankings.';
?>

@include('pages.header')

<style>
    .pt-60 {
        padding-top: 60px !important;
    }
</style>

<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section class="hero-section">
            <div class=" landing-hero position-relative">
                <div class="container">
                    <div class="text-center">
                        <h1 class="page-title">Our <span class="animated-text"> Company Story</span> </h1>
                        <!-- <h1>Welcome to LINKSFARMER – Your Trusted <br /> Partner in Link Building!</h1> -->
                        <h3 class="page_subtitle mb-40">
                            LINKSFARMER is the leading AI-driven guest posting marketplace. We connect advertisers with publishers on one convenient platform. Engaging<br /> with our one-stop solution helps you with buying, selling, and publishing your guest post within 32 hours. There is no frustrating experience once<br /> you visit our platform.</h3>
                        <!-- <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Looking for the best link building platform? Join Links farmer today!
                        </h2> -->
                    </div>
                </div>
            </div>
            <section id="totalSection" class="section-py total-section pb-0 pt-60">
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
        </section>
        <!-- Hero: End -->

        <section class="light-bg section-py">
            <div class="position-relative">
                <div class="container">
                    <div class="text-center">
                        <h2 class="page-title">The Birth of <span class="animated-text"> Marketplace</span> </h2>
                        <!-- <h1>Welcome to LINKSFARMER – Your Trusted <br /> Partner in Link Building!</h1> -->
                        <h3 class="page_subtitle mb-3">
                            Having the vision to streamline the guest posting process and reduce burdens, a team of experts started to spark about creating this web page.<br /> From that moment, it became a game changer for various experts. Wherein the power of automation and technology ensures advertisers receive<br /> backlinks faster. This is what allows them to focus on core SEO strategies and content creation.</h3>
                        <h3 class="page_subtitle">
                            LINKSFARMER, recognize the diverse needs of the SEO world. From comprehensive link building to bespoke content services, it emerged as one<br /> stop solution from 2018 to still. What truly set us apart from others is our unwavering commitment to excellence. Humble Endeavor has blossomed<br /> into the fastest-growing platform in this marketplace.</h3>

                    </div>
                </div>
            </div>
        </section>

        <section class="section-py linear_bg_section">
            <div class="container">
                <div class="linear_bg_wrap">
                    <div class="text_wrap">
                        <h2>Transform your SEO strategy with LINKSFARMER</h2>
                        <p>Join us now and see the results to satisfy yourself!
                        </p>
                    </div>
                    <button type="button" class="btn-white d-block mx-auto">Connect to Our Experts</button>
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