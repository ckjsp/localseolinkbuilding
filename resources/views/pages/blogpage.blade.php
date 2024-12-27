@include('pages.header')

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />



    <meta name="description" content="" />
    <style>
        .search-container {
        display: flex;
        justify-content: center;
        /* margin: 20px 0; */
        }

        .search-input {
        width: 840px;
        height: 58px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        color: #ffffff !important;
        }
        .search-input::placeholder{
        font-size: 18px !important;
        font-weight: 500 !important;
        color: #ffffff !important;
        line-height: 28px !important;
        
        }
        .search-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .search-input{
            background: none !important;
            padding: 15px !important;
            margin: 30px !important;
            border: 1px solid #ffffff80;
            padding-left: 66px !important;
        }
        .marg_border {
           background: linear-gradient(180deg, rgba(43, 255, 255, 0.12) 0%, rgba(43, 255, 255, 0.04) 50%, rgba(43, 255, 255, 0.07) 100%);
           border-radius: 20px !important;
           backdrop-filter: blur(84px);
        }
        .mb-60{
            margin-bottom: 60px;
        }
        .marg_border:before {
        content: url("http://127.0.0.1:8000/img/transform-strategy/Frame%20(64).svg");
         position: absolute;
         left: 46px;
         width: 24px;
         height: 24px;
        display: block;
        z-index: 9999999999999;
        top: 50%;
        transform: translateY(-50%);
    }
    .figure
    {
        padding: 20px !important;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px !important;
    }
    .mb-100 {
        margin-bottom: 100px !important;
    }
    </style>


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
                <img src="{{ asset_url('img/transform-strategy/Content Syndication.png.png') }}" alt="Content Syndication">
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