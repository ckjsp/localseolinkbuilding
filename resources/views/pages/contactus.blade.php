<?php
$pagetitale = 'Contact Us | Links Farmer';
$content = 'Reach out to Links Farmer for all your guest posting and SEO needs. We provide quality backlinks and expert support to grow your online presence.';
?>
@include('pages.header')

<body>
    <div data-bs-spy="scroll" class="scrollspy-example">
        <section class="hero-section pb-0">
            <div class=" landing-hero position-relative">
                <div class="container">
                    <section>
                        <div class="position-relative">
                            <div class="container">
                                <div class="text-center">
                                    <h1 class="page-title">Let's <span class="animated-text"> Chat Today</span> </h1>
                                    <h3 class="page_subtitle mb-40">
                                        Solve all your queries and concerns regarding Guest Posting and Content Writing
                                        Services. Our experts are<br /> here to help you. We will try our best to get
                                        back to you within 48 hours!</h3>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="container">
                            <div class="form-container form_cont mb-30">

                                <!-- Success Message -->
                                @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                                @endif

                                <!-- Form -->
                                <form action="{{ route('contacts.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <input type="text" name="first_name" class="form-control fm_cnt" id="firstName" placeholder="First Name" value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="last_name" class="form-control fm_cnt" id="lastName" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-3 mt-1">
                                        <div class="col-md-6">
                                            <input type="email" name="email" class="form-control fm_cnt" id="email" placeholder="Email" value="{{ old('email') }}" required>
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="phone_number" class="form-control fm_cnt" id="phone" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                            @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <textarea class="form-control fm_cnt txtarea" name="message" id="message" rows="4" placeholder="Message" required>{{ old('message') }}</textarea>
                                        @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <a class="mt-4 submitbtn" href="">
                                        <button type="submit" class="btn btn-submit bt mt-3 filled-btn">Submit</button>
                                    </a>
                                </form>

                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <section class="section-py first-section-pt pt-0">
            <div class="container mt-5 ">

                <div class="col-lg-12 light-bg p-30 rounded-20 ">

                    <div class="mb-2 pb-1 font_dv">Customer Support</div>
                    <p class="pt-lg-2 font_sz">
                        Our friendly customer support is ready to assist with all service, order, or general queries.
                        Providing speedy but helpful replies is what we strive to achieve.
                    </p>
                </div>
            </div>

            <div class="container mt-20 ">
                <div class="col-lg-12 light-bg  rounded-20 ">
                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Email Us</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            For those who require any inquiries or request assistance, you can contact us directly at:
                        </p>
                        <p class="pt-lg-2 green_font animated-text pt-10 ">
                            info@linksfarmer.com</p>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            We aim to respond to every email within 24-48 hours during business days.</p>
                    </div>
                    <hr class="" />

                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Call Us</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            Do you prefer to talk to someone? Our hours of customer support are Monday to Friday, from 9
                            AM to 6 PM. Call us at:</p>
                        <p class="pt-lg-2 green_font animated-text pt-10 ">
                            (9909964822)</p>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            We'd love to assist you with all your queries or concerns.</p>
                    </div>
                    <hr class="" />

                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Live Chat</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            If you need a response right away, use the chat icon in the bottom right corner of our
                            website to speak with an associate of our team at the moment.</p>
                    </div>
                    <hr class="" />

                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Office Address</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            Should you want to visit us personally, we are located at:</p>

                        <p class="pt-lg-2 green_font animated-text pt-10 ">
                            202/1, Skyzone Business Hub
                            Kamrej Road, Near Shyam Dham Mandir
                            Varachha, Surat, Gujarat - 395006</p>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            Note that our office is strict in accepting appointments only. Please call one of our
                            numbers above to set up an appointment before you come to visit us here.</p>
                    </div>
                    <hr class="" />

                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Social Media</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            You can also connect to us through social media. Subscribe to get updated, news, and
                            promotions:</p>

                        <div class="footer-list social-links-wrap  colored_social_links mt-2">

                            <div class="d-flex justify-content-start animated-text ">
                                <a href="https://www.facebook.com/linksfarmer/" target="_blank"
                                    rel="noopener noreferrer" class="iconpage">
                                    <i class="ti ti-brand-facebook ti-sm animated-text"></i>
                                </a>
                                <a href="https://www.instagram.com/linksfarmer/" target="_blank"
                                    rel="noopener noreferrer" class="iconpage">
                                    <i class="ti ti-brand-instagram ti-sm animated-text"></i>
                                </a>
                                <a href="https://www.linkedin.com/company/links-farmer/about/" target="_blank"
                                    rel="noopener noreferrer" class="iconpage">
                                    <i class="ti ti-brand-linkedin ti-sm animated-text"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                    <hr class="" />

                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Support Hours</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            Our support staff will be here to assist you during the following times:</p>

                        <table class="hours-table ">
                            <tr>
                                <td class="font_sz pt-10">Monday</td>
                                <td class="font_sz pt-10">9:00 AM - 6:00 PM</td>
                            </tr>
                            <tr>
                                <td class="font_sz">Tuesday</td>
                                <td class="font_sz">9:00 AM - 6:00 PM</td>
                            </tr>
                            <tr>
                                <td class="font_sz">Wednesday</td>
                                <td class="font_sz">9:00 AM - 6:00 PM</td>
                            </tr>
                            <tr>
                                <td class="font_sz">Thursday</td>
                                <td class="font_sz">9:00 AM - 6:00 PM</td>
                            </tr>
                            <tr>
                                <td class="font_sz">Friday</td>
                                <td class="font_sz">9:00 AM - 6:00 PM</td>
                            </tr>
                            <tr>
                                <td class="font_sz">Saturday</td>
                                <td class="font_sz">Closed</td>
                            </tr>
                            <tr>
                                <td class="font_sz pb-0">Sunday</td>
                                <td class="font_sz pb-0">Closed</td>
                            </tr>
                        </table>
                    </div>
                    <hr class="" />

                    <div class="p-30">
                        <div class="mb-2 pb-1 font_dv">Feedback and Suggestions</div>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            As part of our continuous improvement process, you are welcome to make comments or
                            suggestions through any of the feedback channels mentioned above. Your comments help us grow
                            and serve you better.</p>
                        <p class="pt-lg-2 font_sz pt-10 ">
                            Thank you for choosing Links Farmer! We're happy to help you!</p>
                    </div>
                </div>
            </div>
        </section>

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