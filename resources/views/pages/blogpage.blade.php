<?php
$pagetitale = 'Blogs | Links Farmer';
$content = 'Stay updated with the Links Farmer blog. Get the latest trends, tips, and insights on SEO, guest posting, and online marketing strategies.';
?>
@include('pages.header')

<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section class="hero-section">
            <div class=" landing-hero position-relative">
                <div class="container">
                    <div class="text-center">
                        <h1 class="page-title">Discover A <span class="animated-text"> Wealth of Knowledge</span> </h1>
                        <!-- <h1>Welcome to LINKSFARMER – Your Trusted <br /> Partner in Link Building!</h1> -->
                        <h3 class="page_subtitle mb-60">
                            Solve all your queries and concerns regarding Guest Posting and Content Writing Services. Our experts are<br /> here to help you. We will try our best to get back to you within 48 hours!</h3>
                        <!-- <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Looking for the best link building platform? Join Links farmer today!
                        </h2> -->
                    </div>
                </div>
            </div>

            <div class="search-container ">
                <div class="marg_border">
                    <input type="text" class="search-input mt-3" placeholder="Search blog here...">
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <section class="mb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="figure_wrap">
                            <figure class="figure">
                                <img src="{{ asset_url('img/transform-strategy/Wealth of Knowledge.png') }}" alt="Content Syndication">
                                <a href="{{ route('easy-ways-content-syndication-can-boast-your-research') }}" class="text-decoration-none">
                                    <h4 class="mt-3">Easy Ways Content Syndication Can Boast Your<br /> Research</h4>
                                </a>
                            </figure>
                        </div>

                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="figure_wrap">
                            <figure class="figure">
                                <img src="{{ asset_url('img/transform-strategy/Links Farmer.png.png') }}" alt="Content Syndication">
                                <a href="{{ route('manual-outreach-vs-links-farmer') }}" class="text-decoration-none">
                                    <h4 class="mt-3">Manual Outreach Vs Links Farmer: Which Is Better For Your SEO?</h4>
                                </a>
                            </figure>
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
    <script src="{{ asset_url('libs/popper/popper.js') }}"></script>
    <script src="{{ asset_url('js/bootstrap.js') }}"></script>
    <script src="{{ asset_url('libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset_url('libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset_url('libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset_url('assets/front-main.js') }}"></script>
    <script src="{{ asset_url('assets/front-page-landing.js') }}"></script>


</body>

</html>