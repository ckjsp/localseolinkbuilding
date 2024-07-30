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
                    {{ __('Add Website') }}
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
                <form class="row g-3" action="{{ (isset($website) && !empty($website)) ? route('publisher.website.update', $website->id) : route('publisher.website.store') }}" method="Post" id="addWebsiteForm" enctype="multipart/form-data">
                    @csrf
                    @if(!isset($website) || empty($website))
                    <div class="col-md-12">
                        <label for="inputWebUrl" class="form-label">Website URL</label>
                        <input type="text" class="form-control" id="inputWebUrl" name="website_url" placeholder="https://example.com">
                    </div>
                    @else
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="{{ $website->id }}">
                    <input type="hidden" id="inputWebUrl" name="website_url" value="{{ $website->website_url }}">
                    @endif
                    <div class="col-md-4">
                        <label for="inputDomainAuthority" class="form-label">DA <small>Domain Authority</small></label>
                        <input type="number" class="form-control" id="inputDomainAuthority" name="domain_authority" mix="0" max="100" value="{{ (isset($website->domain_authority) && !empty($website->domain_authority)) ? $website->domain_authority : 0 }}" placeholder="DA (domain Authority)">
                    </div>
                    <div class="col-md-4">
                        <label for="inputPublishingTime" class="form-label">Publishing Time</label>
                        <select id="inputPublishingTime" class="select2 form-select" name="publishing_time" data-allow-clear="true">
                            <option value="" {{ (!isset($website->publishing_time) || empty($website->publishing_time)) ? 'selected' : '' }}>Select Day</option>
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
                        <input type="number" class="form-control" id="inputWordCount" mix="0" max="500" value="{{ (isset($website->minimum_word_count_required) && !empty($website->minimum_word_count_required)) ? $website->minimum_word_count_required : 0 }}" name="minimum_word_count_required">
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
                    <div class="col-md-12">
                        <label for="inputSamplePostUrl" class="form-label">Sample Post URL</label>
                        <input type="text" class="form-control" id="inputSamplePostUrl" name="sample_post_url" value="{{ (isset($website->sample_post_url) && !empty($website->sample_post_url)) ? $website->sample_post_url : '' }}" placeholder="https://example.com/post">
                        <div class="invalid-feedback"><strong class="url-msg"></strong></div>
                        <p><small><strong>NOTE :</strong> Sample post should have one outgoing dofollow link and it should be Google indexed.</small></p>
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
                            <p style="float :right; font-size: 14px; color: #275570; margin-top: 5px;"> <span class="badge badge-pill bg-info">400</span> Character(s) Remaining</p>
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
                    <div class="col-md-3">
                        <label for="inputGuestPostPrice" class="form-label">Guest post price ($)</label>
                        <input type="number" class="form-control" id="inputGuestPostPrice" value="{{ (isset($website->guest_post_price) && !empty($website->guest_post_price)) ? $website->guest_post_price : 0 }}" name="guest_post_price" placeholder="$">
                    </div>
                    <div class="col-md-3">
                        <label for="inputLinkInsertionPrice" class="form-label">Link insertion price ($)</label>
                        <input type="number" class="form-control" id="inputLinkInsertionPrice" value="{{ (isset($website->link_insertion_price) && !empty($website->link_insertion_price)) ? $website->link_insertion_price : 0 }}" name="link_insertion_price" placeholder="$">
                    </div>
                    <div class="col-md-3">
                        <label for="inputFCGuestPostPrice" class="form-label">FC Guest Post price ($)</label>
                        <input type="number" class="form-control" id="inputFCGuestPostPrice" value="{{ (isset($website->fc_guest_post_price) && !empty($website->fc_guest_post_price)) ? $website->fc_guest_post_price : 0 }}" name="fc_guest_post_price" placeholder="$">
                    </div>
                    <div class="col-md-3">
                        <label for="inputFCLinkInsertionPrice" class="form-label">FC Link Insertion price ($)</label>
                        <input type="number" class="form-control" id="inputFCLinkInsertionPrice" value="{{ (isset($website->fc_link_insertion_price) && !empty($website->fc_link_insertion_price)) ? $website->fc_link_insertion_price : 0 }}" name="fc_link_insertion_price" placeholder="$">
                    </div>
                    <div class="col-md-12 border W-100 m-auto mt-4"></div>
                    <div class="col-md-12 W-100 m-3">
                        <h3 class="text-center mb-2">Verification*</h3>
                        <div class="row">
                            <div class="col-md-6 m-auto">
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="dropzone needsclick dz-clickable">
                                            <div class="dz-message needsclick mb-2">
                                                <input type="file" name="site_verification_file" id="site_verification_file" class="form-control">
                                                <input type="hidden" name="old_site_verification_file" class="form-control" value="{{ (isset($website->site_verification_file) && !empty($website->site_verification_file)) ? $website->site_verification_file : '' }}">
                                                <span class="note needsclick">Drop files here or Browse</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Why should I Share my Analytics Detail with Local SEO Link Building?</strong></p>
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
<script>
    $(document).ready(function() {
        $('#addWebsiteForm').validate();
    });
</script>
@endpush