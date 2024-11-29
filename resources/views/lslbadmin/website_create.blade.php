@extends('lslbadmin.sidebar')

@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/dropzone/dropzone.css') }}" />
@endpush

@section('sidebar-content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Update Website Detail') }}
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-end"><i class="ti ti-arrow-narrow-left mx-1"></i> Go Back</a>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <section class="border rounded p-5 mt-5 bg-white">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form class="row g-3" action="{{ (isset($website) && !empty($website)) ? route('lslbadmin.website.update', $website->id) : route('lslbadmin.website.store') }}" method="Post" id="addWebsiteForm" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <label for="inputWebUrl" class="form-label">Website URL</label>
                        <input type="text" class="form-control" id="inputWebUrl" name="website_url" placeholder="https://example.com" value="{{ $website->website_url }}">
                    </div>
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="{{ $website->id }}">
                    <input type="hidden" name="old_url" value="{{ $website->website_url }}">

                    <div class="col-md-4">
                        <label for="inputDomainAuthority" class="form-label">DA <small>Domain Authority</small></label>
                        <input type="number" class="form-control" id="inputDomainAuthority" name="domain_authority" mix="0" max="100" value="{{ (isset($website->domain_authority) && !empty($website->domain_authority)) ? $website->domain_authority : 0 }}" placeholder="DA (domain Authority)">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPageAuthority" class="form-label">PA <small>Page Authority</small></label>
                        <input type="number" class="form-control" id="inputPageAuthority" name="page_authority" mix="0" max="100" value="{{ (isset($website->page_authority) && !empty($website->page_authority)) ? $website->page_authority : 0 }}" placeholder="PA (Page Authority)">
                    </div>
                    <div class="col-md-4">
                        <label for="inputSpamScore" class="form-label">Spam Score</label>
                        <input type="number" class="form-control" id="inputSpamScore" name="spam_score" mix="0" max="100" value="{{ (isset($website->spam_score) && !empty($website->spam_score)) ? $website->spam_score : 0 }}" placeholder="Spam Score">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPublishingTime" class="form-label">Publishing Time</label>
                        <select id="inputPublishingTime" class="select2 form-select" name="publishing_time" data-allow-clear="true">
                            <option value="" {{ (!isset($website->publishing_time) || empty($website->publishing_time)) ? 'selected' : '' }}>Select Day</option>
                            <option value="1" {{ (!empty($website->publishing_time) && $website->publishing_time == 1) ? 'selected' : '' }}>1 Days</option>
                            <option value="2" {{ (!empty($website->publishing_time) && $website->publishing_time == 2) ? 'selected' : '' }}>2 Days</option>
                            <option value="3" {{ (!empty($website->publishing_time) && $website->publishing_time == 3) ? 'selected' : '' }}>3 Days</option>
                            <option value="4" {{ (!empty($website->publishing_time) && $website->publishing_time == 4) ? 'selected' : '' }}>4 Days</option>
                            <option value="5" {{ (!empty($website->publishing_time) && $website->publishing_time == 5) ? 'selected' : '' }}>5 Days</option>
                            <option value="6" {{ (!empty($website->publishing_time) && $website->publishing_time == 6) ? 'selected' : '' }}>6 Days</option>
                            <option value="7" {{ (!empty($website->publishing_time) && $website->publishing_time == 7) ? 'selected' : '' }}>7 Days</option>
                            <option value="8" {{ (!empty($website->publishing_time) && $website->publishing_time == 8) ? 'selected' : '' }}>8 Days</option>
                            <option value="9" {{ (!empty($website->publishing_time) && $website->publishing_time == 9) ? 'selected' : '' }}>9 Days</option>
                            <option value="10" {{ (!empty($website->publishing_time) && $website->publishing_time == 10) ? 'selected' : '' }}>10 Days</option>
                            <option value="11" {{ (!empty($website->publishing_time) && $website->publishing_time == 11) ? 'selected' : '' }}>11 Days</option>
                            <option value="12" {{ (!empty($website->publishing_time) && $website->publishing_time == 12) ? 'selected' : '' }}>12 Days</option>
                            <option value="13" {{ (!empty($website->publishing_time) && $website->publishing_time == 13) ? 'selected' : '' }}>13 Days</option>
                            <option value="14" {{ (!empty($website->publishing_time) && $website->publishing_time == 14) ? 'selected' : '' }}>14 Days</option>
                            <option value="15" {{ (!empty($website->publishing_time) && $website->publishing_time == 15) ? 'selected' : '' }}>15 Days</option>
                            <option value="60" {{ (!empty($website->publishing_time) && $website->publishing_time == 60) ? 'selected' : '' }}>60 Days</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputWordCount" class="form-label">Minimum Word Count Required</label>
                        <input type="number" class="form-control" id="inputWordCount" mix="0" max="1000" value="{{ (isset($website->minimum_word_count_required) && !empty($website->minimum_word_count_required)) ? $website->minimum_word_count_required : 0 }}" name="minimum_word_count_required">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Backlink Type</label>
                        <div class="row bg-light rounded p-2 w-75 mx-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="backlink_type" id="inputBacklinkType1" value="dofollow" {{ (!empty($website->backlink_type) && $website->backlink_type == 'dofollow') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inputBacklinkType1">DoFollow</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="backlink_type" id="inputBacklinkType2" value="nofollow" {{ (!empty($website->backlink_type) && $website->backlink_type == 'nofollow' || !isset($website->backlink_type)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inputBacklinkType2">NoFollow</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputBacklinksAllowed" class="form-label">Maximum no. of Backlinks allowed</label>
                        <select id="inputBacklinksAllowed" class="select2 form-select" name="maximum_no_of_backlinks_allowed" data-allow-clear="true">
                            <option value="" {{ (!isset($website->maximum_no_of_backlinks_allowed) || empty($website->maximum_no_of_backlinks_allowed)) ? 'selected' : '' }}>Select number of link</option>
                            <option value="1" {{ (!empty($website->maximum_no_of_backlinks_allowed) && $website->maximum_no_of_backlinks_allowed == '1') ? 'selected' : '' }}>1</option>
                            <option value="2" {{ (!empty($website->maximum_no_of_backlinks_allowed) && $website->maximum_no_of_backlinks_allowed == '2') ? 'selected' : '' }}>2</option>
                            <option value="3" {{ (!empty($website->maximum_no_of_backlinks_allowed) && $website->maximum_no_of_backlinks_allowed == '3') ? 'selected' : '' }}>3</option>
                            <option value="4" {{ (!empty($website->maximum_no_of_backlinks_allowed) && $website->maximum_no_of_backlinks_allowed == '4') ? 'selected' : '' }}>4</option>
                            <option value="5" {{ (!empty($website->maximum_no_of_backlinks_allowed) && $website->maximum_no_of_backlinks_allowed == '5') ? 'selected' : '' }}>5</option>
                            <option value="5+" {{ (!empty($website->maximum_no_of_backlinks_allowed) && $website->maximum_no_of_backlinks_allowed == '5+') ? 'selected' : '' }}>5+</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputDomainLifeValidity" class="form-label">Domain Life Validity:</label>
                        <select id="inputDomainLifeValidity" class="form-select select2" name="domain_life_validity" data-allow-clear="true">
                            <option value="" {{ (!isset($website->domain_life_validity) || empty($website->domain_life_validity)) ? 'selected' : '' }}>Select domain life validity</option>
                            <option value="Permanent" {{ (!empty($website->domain_life_validity) && $website->domain_life_validity == 'Permanent') ? 'selected' : '' }}>Permanent</option>
                            <option value="Atleast for 1 year" {{ (!empty($website->domain_life_validity) && $website->domain_life_validity == 'Atleast for 1 year') ? 'selected' : '' }}>Atleast for 1 year</option>
                            <option value="Atleast for 2 years" {{ (!empty($website->domain_life_validity) && $website->domain_life_validity == 'Atleast for 2 years') ? 'selected' : '' }}>Atleast for 2 years</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="inputSamplePostUrl" class="form-label">Sample Post URL</label>
                        <input type="text" class="form-control" id="inputSamplePostUrl" name="sample_post_url" value="{{ (isset($website->sample_post_url) && !empty($website->sample_post_url)) ? $website->sample_post_url : '' }}" placeholder="https://example.com/post">
                        <div class="invalid-feedback"><strong class="url-msg"></strong></div>
                        <p><small><strong>NOTE :</strong> Sample post should have one outgoing dofollow link and it should be Google indexed.</small></p>
                    </div>
                    <div class="col-md-4">
                        <label for="inputStatus" class="form-label">Status</label>
                        <select id="inputStatus" class="select2 form-select" name="status" data-allow-clear="true">
                            <option value="pending" {{ (!empty($website->status) && $website->status == 'pending') ? 'selected' : '' }}>Pending</option>
                            <option value="in-review" {{ (!empty($website->status) && $website->status == 'in-review') ? 'selected' : '' }}>In Review</option>
                            <option value="approve" {{ (!empty($website->status) && $website->status == 'approve') ? 'selected' : '' }}>Approve</option>
                            <option value="rejected" {{ (!empty($website->status) && $website->status == 'rejected') ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="inputGuidelines" class="form-label">Guidelines</label>
                        <textarea class="form-control" id="inputGuidelines" rows="7" name="guidelines" value="{{ (isset($website->guidelines) && !empty($website->guidelines)) ? $website->guidelines : '' }}" placeholder="If you have any specific guidelines regarding word limit, backlink count, anchor text selection, etc. mention them below.">{{ (isset($website->guidelines) && !empty($website->guidelines)) ? $website->guidelines : '' }}</textarea>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <ul>
                                <li>The post will be Google Indexed</li>
                                <li>The post will be permanent/at least for 1 year/at least for 2 years</li>
                                <li>Promotional articles are not allowed</li>
                                <li>PBN not allowed</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p style="float :right; font-size: 14px; color: #275570; margin-top: 5px;"> <span id="inputGuidelinesTextCount" class="badge badge-pill bg-info">{{ (isset($website->guidelines) && !empty($website->guidelines)) ? (1000-strlen($website->guidelines)) : 1000 }}</span> Character(s) Remaining</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        @php
                        $Carr = array();
                        if (isset($website->categories) && !empty($website->categories))
                        $Carr = explode(',', $website->categories);
                        @endphp
                        <input type="hidden" id="inputCategories" name="categories" value="{{ (isset($website->categories) && !empty($website->categories)) ? $website->categories : '' }}">
                        <label for="inputCategories1" class="form-label">Categories</label>
                        <div class="select2-primary">
                            <select id="inputCategories1" class="form-select select2" multiple>
                                <option value="Agriculture" {{ (in_array("Agriculture", $Carr)) ? 'selected' : '' }}>Agriculture</option>
                                <option value="Animals & Pets" {{ (in_array("Animals & Pets", $Carr)) ? 'selected' : '' }}>Animals & Pets</option>
                                <option value="Arms and ammunition" {{ (in_array("Arms and ammunition", $Carr)) ? 'selected' : '' }}>Arms and ammunition</option>
                                <option value="Arts & Entertainment" {{ (in_array("Arts & Entertainment", $Carr)) ? 'selected' : '' }}>Arts & Entertainment</option>
                                <option value="Automobiles" {{ (in_array("Automobiles", $Carr)) ? 'selected' : '' }}>Automobiles</option>
                                <option value="Beauty" {{ (in_array("Beauty", $Carr)) ? 'selected' : '' }}>Beauty</option>
                                <option value="Blogging" {{ (in_array("Blogging", $Carr)) ? 'selected' : '' }}>Blogging</option>
                                <option value="Business" {{ (in_array("Business", $Carr)) ? 'selected' : '' }}>Business</option>
                                <option value="Career & Employment" {{ (in_array("Career & Employment", $Carr)) ? 'selected' : '' }}>Career & Employment</option>
                                <option value="Computer & Electronics" {{ (in_array("Computer & Electronics", $Carr)) ? 'selected' : '' }}>Computer & Electronics</option>
                                <option value="Coupons Offers & Cashback" {{ (in_array("Coupons Offers & Cashback", $Carr)) ? 'selected' : '' }}>Coupons Offers & Cashback</option>
                                <option value="Digital Marketing" {{ (in_array("Digital Marketing", $Carr)) ? 'selected' : '' }}>Digital Marketing</option>
                                <option value="Education" {{ (in_array("Education", $Carr)) ? 'selected' : '' }}>Education</option>
                                <option value="Environment" {{ (in_array("Environment", $Carr)) ? 'selected' : '' }}>Environment</option>
                                <option value="Family" {{ (in_array("Family", $Carr)) ? 'selected' : '' }}>Family</option>
                                <option value="Fashion & Lifestyle" {{ (in_array("Fashion & Lifestyle", $Carr)) ? 'selected' : '' }}>Fashion & Lifestyle</option>
                                <option value="Finance" {{ (in_array("Finance", $Carr)) ? 'selected' : '' }}>Finance</option>
                                <option value="Food & Drink" {{ (in_array("Food & Drink", $Carr)) ? 'selected' : '' }}>Food & Drink</option>
                                <option value="Games" {{ (in_array("Games", $Carr)) ? 'selected' : '' }}>Games</option>
                                <option value="General" {{ (in_array("General", $Carr)) ? 'selected' : '' }}>General</option>
                                <option value="Gift" {{ (in_array("Gift", $Carr)) ? 'selected' : '' }}>Gift</option>
                                <option value="Health & Fitness" {{ (in_array("Health & Fitness", $Carr)) ? 'selected' : '' }}>Health & Fitness</option>
                                <option value="Home & Garden" {{ (in_array("Home & Garden", $Carr)) ? 'selected' : '' }}>Home & Garden</option>
                                <option value="Humor" {{ (in_array("Humor", $Carr)) ? 'selected' : '' }}>Humor</option>
                                <option value="Internet & Telecom" {{ (in_array("Internet & Telecom", $Carr)) ? 'selected' : '' }}>Internet & Telecom</option>
                                <option value="Law & Government" {{ (in_array("Law & Government", $Carr)) ? 'selected' : '' }}>Law & Government</option>
                                <option value="Leisure & Hobbies" {{ (in_array("Leisure & Hobbies", $Carr)) ? 'selected' : '' }}>Leisure & Hobbies</option>
                                <option value="Magazine" {{ (in_array("Magazine", $Carr)) ? 'selected' : '' }}>Magazine</option>
                                <option value="Manufacturing" {{ (in_array("Manufacturing", $Carr)) ? 'selected' : '' }}>Manufacturing</option>
                                <option value="Marketing & Advertising" {{ (in_array("Marketing & Advertising", $Carr)) ? 'selected' : '' }}>Marketing & Advertising</option>
                                <option value="Music" {{ (in_array("Music", $Carr)) ? 'selected' : '' }}>Music</option>
                                <option value="News & Media" {{ (in_array("News & Media", $Carr)) ? 'selected' : '' }}>News & Media</option>
                                <option value="Photography" {{ (in_array("Photography", $Carr)) ? 'selected' : '' }}>Photography</option>
                                <option value="Politics" {{ (in_array("Politics", $Carr)) ? 'selected' : '' }}>Politics</option>
                                <option value="Quotes" {{ (in_array("Quotes", $Carr)) ? 'selected' : '' }}>Quotes</option>
                                <option value="Real estate" {{ (in_array("Real estate", $Carr)) ? 'selected' : '' }}>Real estate</option>
                                <option value="Region" {{ (in_array("Region", $Carr)) ? 'selected' : '' }}>Region</option>
                                <option value="Reviews" {{ (in_array("Reviews", $Carr)) ? 'selected' : '' }}>Reviews</option>
                                <option value="Science" {{ (in_array("Science", $Carr)) ? 'selected' : '' }}>Science</option>
                                <option value="Shopping" {{ (in_array("Shopping", $Carr)) ? 'selected' : '' }}>Shopping</option>
                                <option value="Spanish" {{ (in_array("Spanish", $Carr)) ? 'selected' : '' }}>Spanish</option>
                                <option value="Sports" {{ (in_array("Sports", $Carr)) ? 'selected' : '' }}>Sports</option>
                                <option value="Sprituality" {{ (in_array("Sprituality", $Carr)) ? 'selected' : '' }}>Sprituality</option>
                                <option value="Technology" {{ (in_array("Technology", $Carr)) ? 'selected' : '' }}>Technology</option>
                                <option value="Travelling" {{ (in_array("Travelling", $Carr)) ? 'selected' : '' }}>Travelling</option>
                                <option value="Web development" {{ (in_array("Web development", $Carr)) ? 'selected' : '' }}>Web development</option>
                                <option value="Wedding" {{ (in_array("Wedding", $Carr)) ? 'selected' : '' }}>Wedding</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        @php
                        $FCarr = array();
                        if (isset($website->forbidden_categories) && !empty($website->forbidden_categories))
                        $FCarr = explode(',', $website->forbidden_categories);
                        @endphp
                        <input type="hidden" id="inputForbiddenCategories" name="forbidden_categories" value="{{ (isset($website->forbidden_categories) && !empty($website->forbidden_categories)) ? $website->forbidden_categories : '' }}">
                        <label for="inputForbiddenCategories1" class="form-label">Select the forbidden categories you accept</label>
                        <div class="select2-info">
                            <select id="inputForbiddenCategories1" class="select2 form-select" multiple>
                                <option value="Casino" {{ (in_array("Casino", $FCarr)) ? 'selected' : '' }}>Casino</option>
                                <option value="CBD/Marijuana" {{ (in_array("CBD/Marijuana", $FCarr)) ? 'selected' : '' }}>CBD/Marijuana</option>
                                <option value="Cryptocurrency" {{ (in_array("Cryptocurrency", $FCarr)) ? 'selected' : '' }}>Cryptocurrency</option>
                                <option value="Vape" {{ (in_array("Vape", $FCarr)) ? 'selected' : '' }}>Vape</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inputGuestPostPrice" class="form-label">Guest post price ($)</label>
                        <input type="number" class="form-control" id="inputGuestPostPrice" value="{{ (isset($website->guest_post_price) && !empty($website->guest_post_price)) ? $website->guest_post_price : 0 }}" name="guest_post_price" placeholder="$">
                    </div>
                    <div class="col-md-6">
                        <label for="inputLinkInsertionPrice" class="form-label">Link insertion price ($)</label>
                        <input type="number" class="form-control" id="inputLinkInsertionPrice" value="{{ (isset($website->link_insertion_price) && !empty($website->link_insertion_price)) ? $website->link_insertion_price : 0 }}" name="link_insertion_price" placeholder="$">
                    </div>
                    <!-- <div class="col-md-3">
                        <label for="inputFCGuestPostPrice" class="form-label">FC Guest Post price ($)</label>
                        <input type="number" class="form-control" id="inputFCGuestPostPrice" value="{{ (isset($website->fc_guest_post_price) && !empty($website->fc_guest_post_price)) ? $website->fc_guest_post_price : 0 }}" name="fc_guest_post_price" placeholder="$">
                    </div> -->
                    <!-- <div class="col-md-3">
                        <label for="inputFCLinkInsertionPrice" class="form-label">FC Link Insertion price ($)</label>
                        <input type="number" class="form-control" id="inputFCLinkInsertionPrice" value="{{ (isset($website->fc_link_insertion_price) && !empty($website->fc_link_insertion_price)) ? $website->fc_link_insertion_price : 0 }}" name="fc_link_insertion_price" placeholder="$">
                    </div> -->
                    <div class="col-md-12 W-100 m-3">
                        <div class="row border border-primary p-3 rounded">
                            <div class="col-md-6">
                                <p><strong>Why should I Share my Analytics Detail with Links Farmer?</strong></p>
                                <ol>
                                    <li>Owner's websites are shown on top of the Marketplace.</li>
                                    <li>Your website will not be added by any other contributor.</li>
                                    <li>Your actual traffic will be showcased to the clients compared to any other SEO tool.</li>
                                </ol>
                                <p>If you have any question follow <a href="javascript:void(0)">this guide</a> where we explain step by step how to verify you website...</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Google Analytics Report. How to Share?</strong></p>
                                <p>How to prepare a report?</p>
                                <ol>
                                    <li>Go to the "Reports snapshot" tab in google analytics.</li>
                                    <li>Make sure "last 30 days" is selected in the top right corner.</li>
                                    <li>Go to Share Report > Download File > Download PDF.</li>
                                </ol>
                                <!-- <p>Attachments* (.pdf files only & maximum 1 file allowed)</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <?php
                        if (old('site_verification_file')) {
                            $site_verification_file = old('site_verification_file');
                        } else {
                            isset($website->site_verification_file) ? $site_verification_file = $website->site_verification_file : '';
                        }
                        ?>
                        <label for="site_verification_file" class="form-label">Upload Your Website Analytics Report</label>
                        <input type="file" name="site_verification_file" id="site_verification_file" class="form-control" {{ (isset($site_verification_file) && !empty($site_verification_file)) ? '' : 'required=""' }}>
                        <input type="hidden" name="old_site_verification_file" class="form-control" value="{{ (isset($site_verification_file) && !empty($site_verification_file)) ? $site_verification_file : '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <?php
                        if (old('site_verification_file')) {
                            $site_verification_file = old('site_verification_file');
                        } else {
                            isset($website->site_verification_file) ? $site_verification_file = $website->site_verification_file : '';
                        }
                        ?>
                        <div class="form-check">
                            <label class="form-check-label" for="inputReadedGuide">Please confirm that you have read and followed the guide. </label>
                            <input class="form-check-input" type="checkbox" name="readedguide" id="inputReadedGuide" value="yes">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-outline-primary w-25">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script src="{{ asset_url('libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>
<script src="{{ asset_url('.../public\script/addweb_form.js') }}"></script>

<script>
    $('#site_verification_file').change(function() {
        const selectedFile = this.files[0]; // Get the selected file

        if (selectedFile) {
            const allowedFileTypes = ['application/pdf', 'image/jpg', 'image/jpeg', 'image/png'];

            if (allowedFileTypes.includes(selectedFile.type)) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                // Valid file type
            } else {
                $(this).addClass('is-invalid').removeClass('is-valid');
                // Invalid file type
                $('#fileInput').val(''); // Clear the file input
            }
        }
    });

    $(window).ready(function() {
        $('#inputForbiddenCategories1').change(function() {
            inputval = $(this).val();
            if (inputval != '') {
                $('#inputForbiddenCategories').val(inputval.join(','));
            }
        });
        $('#inputCategories1').change(function() {
            inputval = $(this).val();
            if (inputval != '') {
                $('#inputCategories').val(inputval.join(','));
            }
        });
        $('#inputGuidelines').on('input', function() {
            inputval = ($(this).val());
            if (inputval.length > 1000) {
                $('#inputGuidelinesTextCount').text(0);
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
                $('#inputGuidelinesTextCount').text((1000 - inputval.length));
            }
        });

        $.validator.addMethod("domainMatch", function(value, element) {
            // Replace "example.com" with your sample post URL domain
            var url1 = new URL($('#inputWebUrl').val());
            var urlDomain = url1.hostname;
            var url = new URL(value);
            var sampleDomain = url.hostname;
            return sampleDomain === urlDomain;
        }, "Domain should match with the website URL domain.");

        $("#addWebsiteForm").validate({
            rules: {
                website_url: {
                    required: true,
                    url: true
                },
                domain_authority: {
                    required: true,
                    integer: true,
                    range: [1, 100]
                },
                page_authority: {
                    required: true,
                    integer: true,
                    range: [1, 100]
                },
                spam_score: {
                    required: true,
                    integer: true,
                    range: [0, 100]
                },
                publishing_time: "required",
                minimum_word_count_required: {
                    required: true,
                    integer: true,
                    range: [1, 1000]
                },
                backlink_type: "required",
                maximum_no_of_backlinks_allowed: "required",
                domain_life_validity: "required",
                sample_post_url: {
                    required: true,
                    url: true,
                    domainMatch: true
                },
                inputCategories1: "required",
                inputForbiddenCategories1: "required",
                guest_post_price: {
                    required: true,
                    number: true,
                    min: 1
                },
                link_insertion_price: {
                    required: true,
                    number: true,
                    min: 1
                },
                // fc_guest_post_price: {
                //     required: true,
                //     number: true,
                //     min: 1
                // },
                // fc_link_insertion_price: {
                //     required: true,
                //     number: true,
                //     min: 1
                // },
                site_verification_file: {
                    required: false,
                    accept: "application/pdf,image/jpg,image/jpeg,image/png"
                },
                readedguide: "required",
            },
            messages: {
                website_url: {
                    required: " Please enter your website url",
                    url: " Please Enter valid website url ex.(https://example.com)"
                },
                domain_authority: {
                    required: " Please enter a domain authority",
                    integer: " Your domain authority must be numbers only",
                    range: " domain authority should be 1 to 100"
                },
                page_authority: {
                    required: " Please enter a page authority",
                    integer: " Your page authority must be numbers only",
                    range: " page authority should be 1 to 100"
                },
                spam_score: {
                    required: " Please enter a Spam Score",
                    integer: " Your Spam Score must be numbers only",
                    range: " Spam Score should be 0 to 100"
                },
                name: " Please select publishing time",
                minimum_word_count_required: {
                    required: " Please enter required minimum word count",
                    integer: " Your minimum word count must be numbers only",
                    range: " Required minimum word count should be 1 to 500"
                },
                backlink_type: " Please select backlink type",
                maximum_no_of_backlinks_allowed: " Please select maximum no of backlinks allowed",
                domain_life_validity: " Please select domain life validity",
                sample_post_url: {
                    required: " Please enter your sample post url",
                    url: " Please Enter valid sample post url ex.(https://example.com/post)"
                },
                inputCategories1: " Please select categories",
                inputForbiddenCategories1: " Please select forbidden categories",
                guest_post_price: {
                    required: "Please enter a guest post price.",
                    number: "Please enter a valid guest post price.",
                    min: "Please enter a guest post price greater than or equal to 1."
                },
                link_insertion_price: {
                    required: "Please enter a link insertion price.",
                    number: "Please enter a valid link insertion price.",
                    min: "Please enter a link insertion price greater than or equal to 1."
                },
                // fc_guest_post_price: {
                //     required: "Please enter a fc guest post price.",
                //     number: "Please enter a valid fc guest post price.",
                //     min: "Please enter a fc guest post price greater than or equal to 1."
                // },
                // fc_link_insertion_price: {
                //     required: "Please enter a fc link insertion price.",
                //     number: "Please enter a valid fc link insertion price.",
                //     min: "Please enter a fc link insertion price greater than or equal to 1."
                // },
                site_verification_file: {
                    required: " Please upload a site verification file",
                    accept: " Please upload valid site verification file ex. PDF, JPEG, JPG, and PNG"
                },
                readedguide: " Please make sure to thoroughly read the guide before checking the 'I have read' button.",
            }
        });
    });

    /* $('#addWebsiteForm').submit(function() {
        var $inputWebUrl = $('#inputWebUrl').val();
        var $inputDomainAuthority = $('#inputDomainAuthority').val();
        var $inputPublishingTime = $('#inputPublishingTime').val();
        var $inputWordCount = $('#inputWordCount').val();
        var $inputBacklinkType1 = $('#inputBacklinkType1').val();
        var $inputBacklinkType2 = $('#inputBacklinkType2').val();
        var $inputBacklinksAllowed = $('#inputBacklinksAllowed').val();
        var $inputStatus = $('#inputStatus').val();
        var $inputDomainLifeValidity = $('#inputDomainLifeValidity').val();
        var $inputSamplePostUrl = $('#inputSamplePostUrl').val();
        var $inputGuidelines = $('#inputGuidelines').val();
        var $inputCategories1 = $('#inputCategories1').val();
        var $inputForbiddenCategories1 = $('#inputForbiddenCategories1').val();
        var $inputGuestPostPrice = $('#inputGuestPostPrice').val();
        var $inputLinkInsertionPrice = $('#inputLinkInsertionPrice').val();
        var $inputFCGuestPostPrice = $('#inputFCGuestPostPrice').val();
        var $inputFCLinkInsertionPrice = $('#inputFCLinkInsertionPrice').val();
        var $site_verification_file = $('#site_verification_file').val();
        var $old_site_verification_file = $('#old_site_verification_file').val();

        var $flag = 0;
        if ($inputWebUrl != '' && isValidHttpUrl($inputWebUrl) == true) {
            $('#inputWebUrl').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputWebUrl').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputDomainAuthority != '') {
            $('#inputDomainAuthority').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputDomainAuthority').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputPublishingTime != '') {
            $('#inputPublishingTime').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputPublishingTime').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputWordCount != '') {
            $('#inputWordCount').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputWordCount').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputBacklinkType1 != '') {
            $('input[name="backlink_type"]').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('input[name="backlink_type"]').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputBacklinksAllowed != '') {
            $('#inputBacklinksAllowed').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputBacklinksAllowed').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputStatus != '') {
            $('#inputStatus').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputStatus').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputDomainLifeValidity != '') {
            $('#inputDomainLifeValidity').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputDomainLifeValidity').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputSamplePostUrl != '' && isValidHttpUrl($inputSamplePostUrl) == true) {
            $('#inputSamplePostUrl').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputSamplePostUrl').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputSamplePostUrl != '' && $inputWebUrl != '') {
            if ($inputSamplePostUrl == $inputWebUrl) {
                $flag++;
                $('.url-msg').text("Please enter valid sample post URL.");
                $('#inputSamplePostUrl').addClass('is-invalid').removeClass('is-valid');
            } else if (getDomain($inputWebUrl) !== getDomain($inputSamplePostUrl)) {
                $flag++;
                $('.url-msg').text("Sample post URL should contain your website's domain name.");
                $('#inputSamplePostUrl').addClass('is-invalid').removeClass('is-valid');
            }
        }
        if ($inputGuidelines != '' && $inputGuidelines.length <= 400) {
            $('#inputGuidelines').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputGuidelines').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputCategories1 != '') {
            $('#inputCategories').val($inputCategories1.join(','));
            $('#inputCategories1').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputCategories1').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputForbiddenCategories1 != '') {
            $('#inputForbiddenCategories').val($inputForbiddenCategories1.join(','));
            $('#inputForbiddenCategories1').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputForbiddenCategories1').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputGuestPostPrice != '') {
            $('#inputGuestPostPrice').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputGuestPostPrice').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputLinkInsertionPrice != '') {
            $('#inputLinkInsertionPrice').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputLinkInsertionPrice').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputFCGuestPostPrice != '') {
            $('#inputFCGuestPostPrice').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputFCGuestPostPrice').addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputFCLinkInsertionPrice != '') {
            $('#inputFCLinkInsertionPrice').removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputFCLinkInsertionPrice').addClass('is-invalid').removeClass('is-valid');
        }
        // if ($site_verification_file != '' && old_site_verification_file != '') {
        //     $('#site_verification_file').removeClass('is-invalid').addClass('is-valid');
        // } else {
        //     $flag++;
        //     $('#site_verification_file').addClass('is-invalid').removeClass('is-valid');
        // }
        if ($flag == 0) {
            return true;
        } else {
            return false;
        }
    }); */

    function isValidHttpUrl(str) {
        const pattern = new RegExp(
            '^(https?:\\/\\/)?' + // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
            '(\\#[-a-z\\d_]*)?$', // fragment locator
            'i'
        );
        return pattern.test(str);
    }

    function getDomain(url) {
        var a = document.createElement('a');
        a.href = url;
        return a.hostname;
    }
</script>
@endpush