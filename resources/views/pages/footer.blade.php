<footer class="landing-footer  footer-text">
    <div class="footer-top ">
        <div class="container">
            <div class="row justify-content-between  gx-0 gy-4 g-md-5 ">
                <div class="col-lg-3">
                    <div class="mb-40">
                        <a href="#" class="footer-logo">
                            <img src="{{ asset_url('img/footer-logo.png') }}" alt="footer-logo">
                        </a>
                    </div>
                    <p class="footer-text footer-logo-description mb-4">
                        Grow your website traffic and build your reputation with our simple, results-driven link-building services. Start seeing the difference now!
                    </p>
                    <ul class="footer-list social-links-wrap  mt-3">
                        <li>
                            <div class="d-flex justify-content-start">
                                <a href="https://www.facebook.com/linksfarmer/" rel="noopener noreferrer" class="icon-div-wrap">
                                    <i class="ti ti-brand-facebook ti-sm"></i>
                                </a>
                                <a href="https://www.instagram.com/linksfarmer/" rel="noopener noreferrer" class="icon-div-wrap">
                                    <i class="ti ti-brand-instagram ti-sm"></i>
                                </a>
                                <a href="https://www.linkedin.com/company/links-farmer/about/" rel="noopener noreferrer" class="icon-div-wrap">
                                    <i class="ti ti-brand-linkedin ti-sm"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <h6 class="footer-title mb-4">Services</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('guest-posting-services') }}" class="footer-link">Guest Posting</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('link-building-services') }}" class="footer-link">Link Building</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('content-writing-services') }}" class="footer-link">Content Writing</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('seo-reseller-services') }}" class="footer-link">SEO Reseller</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('content-marketing-services') }}" class="footer-link">Content Marketing</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                    <h6 class="footer-title mb-4">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="{{ route('about-us') }}" class="footer-link">About</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('contact-us') }}" class="footer-link">Contact</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ route('blog') }}" class="footer-link">Blog</a>
                        </li>

                        <li class="mb-3">
                            <a href="#" class="footer-link">Write for Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title mb-4">Get Update</h6>
                    <form class="footer-form">
                        <div class=" mt-1">
                            <input type="email" class=" custom-input mb-4" id="footer-email"
                                placeholder="Your email address" />
                            <button type="submit" class="filled-btn">
                                Get Registered
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>