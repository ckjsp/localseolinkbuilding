<footer class="landing-footer bg-body footer-text">
    <div class="footer-top position-relative overflow-hidden z-1">
        <div class="container">
            <div class="row gx-0 gy-4 g-md-5">
                <div class="col-lg-5">
                    <a href="#" class="app-brand-link mb-4">

                        <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">Links Farmer</span>
                    </a>
                    <p class="footer-text footer-logo-description mb-4">
                        Most developer friendly & highly customisable Admin Dashboard Template.
                    </p>
                    <form class="footer-form">
                        <label for="footer-email" class="small">Subscribe to newsletter</label>
                        <div class="d-flex mt-1">
                            <input
                                type="email"
                                class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                                id="footer-email"
                                placeholder="Your email" />
                            <button
                                type="submit"
                                class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="footer-title mb-4">Demos</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="#" class="footer-link">Home</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('privacy-policy') }}" class="footer-link">Privacy policy</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('cancellation-and-refund-policy') }}" class="footer-link">Cancellation and refund policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="footer-title mb-4">Pages</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('terms-condition') }}" class="footer-link">Terms and conditions</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('shipping-and-delivery-policy') }}" class="footer-link">Shipping and delivery policy</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('contact-us') }}" class="footer-link">Contact us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title mb-4">Download our app</h6>
                    <a href="#" class="d-block footer-link mb-3 pb-2"><img src="{{ asset('/public/img/front-pages/landing-page/apple-icon.png') }}" alt="apple icon" /></a>
                    <a href="#" class="d-block footer-link"><img src="{{ asset('/public/img/front-pages/landing-page/google-play-icon.png')}}" alt="google play icon" /></a>
                </div>
            </div>
        </div>
    </div>

</footer>