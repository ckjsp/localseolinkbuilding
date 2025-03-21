<?php
$pagetitale = 'White Label SEO Reselling | Links Farmer';
$content = 'Offer premium SEO services under your brand with Links Farmer’s white-label SEO reselling solutions. Grow your business without extra effort.';
?>
@include('pages.header')

<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- <div class="pb-100"> -->
        <section class="hero-section">
            <div class=" landing-hero position-relative pb-100">
                <div class="container">
                    <div class="text-center">
                        <h1 class="page-title">Thank You for Reaching Out!</h1>
                        <h3 class="page_subtitle">
                            We’ve received your message and will get back to you as soon as possible. Our team is reviewing your inquiry <br /> and will respond shortly. </h3>

                    </div>

                </div>

            </div>
            @include('pages.footer')
        </section>

    </div>
</body>
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