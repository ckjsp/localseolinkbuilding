@include('pages.header')

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>Blogs | Links Farmer
    </title>
    <meta name="description" content="Stay updated with the Links Farmer blog. Get the latest trends, tips, and insights on SEO, guest posting, and online marketing strategies.
" />
    <!-- <style>
      
    </style> -->


</head>

<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section class="hero-section">
            <div class=" landing-hero position-relative">
                <div class="container">
                    <div class="text-center">
                        <h1 class="page-title">Discover A <span class="animated-text"> Wealth of Knowledge</span> </h1>
                        <!-- <h1>Welcome to LINKSFARMER – Your Trusted <br /> Partner in Link Building!</h1> -->
                        <h3 class="page_subtitle mb-60">
                        Solve all your queries and concerns regarding Guest Posting and Content Writing Services. Our experts are<br/> here to help you. We will try our best to get back to you within 48 hours!</h3>
                        <!-- <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Looking for the best link building platform? Join Links farmer today!
                        </h2> -->
                    </div>
                </div>
            </div>
          
            <div class="search-container ">
                <div class="marg_border">
                <!-- <img src="{{ asset_url('img/transform-strategy/Frame (64).svg') }}" alt="serch-icon"> -->
                <input type="text" class="search-input mt-3" placeholder="Search blog here...">
                </div>
             </div>
        </section>
            <!-- Hero: End -->    

        <section class="mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <figure class="figure">
                <img src="{{ asset_url('img/transform-strategy/Wealth of Knowledge.png') }}" alt="Content Syndication">
                <!-- <img src="{{ asset_url('img/Easy Ways Content Syndication Can Boast Your Research.jpg') }}" alt="linksfarmer-img" width="650" height="320"> -->
                <h4 class="mt-3">Easy Ways Content Syndication Can Boast Your<br/> Research</h4>
                </figure>
                </div>
                <div class="col-lg-6">
                <figure class="figure">
                <img src="{{ asset_url('img/transform-strategy/Links Farmer.png.png') }}" alt="Content Syndication">
                <h4 class="mt-3">Manual Outreach Vs Links Farmer: Which Is Better For<br/> Your SEO?</h4>
                </figure>
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