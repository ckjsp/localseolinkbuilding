@extends('publisher.sidebar')

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
                    @if(isset($website) && !empty($website))
                    {{ __('Edit Website') }}
                    @else
                    {{ __('Add Website') }}
                    @endif
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary float-end"><i
                            class="ti ti-arrow-narrow-left mx-1"></i> Go Back</a>
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
    <section class="border rounded p-5 mt-5 ">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form class="row g-3" action="{{ (isset($website) && !empty($website)) ? route('publisher.website.update', $website->id) : route('publisher.website.store') }}" method="Post" id="addWebsiteForm" enctype="multipart/form-data">
                    @csrf
                    @if(!isset($website) || empty($website))
                    <div class="col-md-12">
                        <label for="inputWebUrl" class="form-label">Website URL
                            <small>(https://example.com)</small></label>
                        <input type="text" class="form-control" id="inputWebUrl" name="website_url"
                            placeholder="https://example.com" value="{{ old('website_url') }}">
                    </div>
                    @else
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="{{ $website->id }}">
                    <input type="hidden" id="inputWebUrl" name="website_url" value="{{ $website->website_url }}">
                    @endif
                    <div class="col-md-4">
                        <?php
                        if (old('domain_authority')) {
                            $domain_authority = old('domain_authority');
                        } else {
                            isset($website->domain_authority) ? $domain_authority = $website->domain_authority : '';
                        }
                        ?>
                        <label for="inputDomainAuthority" class="form-label">DA <small>Domain Authority</small></label>
                        <input type="number" class="form-control" id="inputDomainAuthority" name="domain_authority" mix="1" max="100" value="{{ (isset($domain_authority) && !empty($domain_authority)) ? $domain_authority : 1 }}" placeholder="DA (domain Authority)">
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('page_authority')) {
                            $page_authority = old('page_authority');
                        } else {
                            isset($website->page_authority) ? $page_authority = $website->page_authority : '';
                        }
                        ?>
                        <label for="inputPageAuthority" class="form-label">PA <small>Page Authority</small></label>
                        <input type="number" class="form-control" id="inputPageAuthority" name="page_authority" mix="1" max="100" value="{{ (isset($page_authority) && !empty($page_authority)) ? $page_authority : 1 }}" placeholder="PA (Page Authority)">
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('spam_score')) {
                            $spam_score = old('spam_score');
                        } else {
                            isset($website->spam_score) ? $spam_score = $website->spam_score : '';
                        }
                        ?>
                        <label for="inputSpamScore" class="form-label">Spam Score</label>
                        <input type="number" class="form-control" id="inputSpamScore" name="spam_score" mix="1" max="100" value="{{ (isset($spam_score) && !empty($spam_score)) ? $spam_score : 1 }}" placeholder="Spam Score">
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('publishing_time')) {
                            $publishing_time = old('publishing_time');
                        } else {
                            isset($website->publishing_time) ? $publishing_time = $website->publishing_time : '';
                        }
                        ?>
                        <label for="inputPublishingTime" class="form-label">Publishing Time</label>
                        <select id="inputPublishingTime" class="select2 form-select" name="publishing_time"
                            data-allow-clear="true">
                            <option value="" {{ (!isset($publishing_time) || empty($publishing_time)) ? 'selected' : '' }}>Select Day</option>
                            <option value="1" {{ (!empty($publishing_time) && $publishing_time==1) ? 'selected' : '' }}>1 Days</option>
                            <option value="2" {{ (!empty($publishing_time) && $publishing_time==2) ? 'selected' : '' }}>2 Days</option>
                            <option value="3" {{ (!empty($publishing_time) && $publishing_time==3) ? 'selected' : '' }}>3 Days</option>
                            <option value="4" {{ (!empty($publishing_time) && $publishing_time==4) ? 'selected' : '' }}>4 Days</option>
                            <option value="5" {{ (!empty($publishing_time) && $publishing_time==5) ? 'selected' : '' }}>5 Days</option>
                            <option value="6" {{ (!empty($publishing_time) && $publishing_time==6) ? 'selected' : '' }}>6 Days</option>
                            <option value="7" {{ (!empty($publishing_time) && $publishing_time==7) ? 'selected' : '' }}>7 Days</option>
                            <option value="8" {{ (!empty($publishing_time) && $publishing_time==8) ? 'selected' : '' }}>8 Days</option>
                            <option value="9" {{ (!empty($publishing_time) && $publishing_time==9) ? 'selected' : '' }}>9 Days</option>
                            <option value="10" {{ (!empty($publishing_time) && $publishing_time==10) ? 'selected' : '' }}>10 Days</option>
                            <option value="11" {{ (!empty($publishing_time) && $publishing_time==11) ? 'selected' : '' }}>11 Days</option>
                            <option value="12" {{ (!empty($publishing_time) && $publishing_time==12) ? 'selected' : '' }}>12 Days</option>
                            <option value="13" {{ (!empty($publishing_time) && $publishing_time==13) ? 'selected' : '' }}>13 Days</option>
                            <option value="14" {{ (!empty($publishing_time) && $publishing_time==14) ? 'selected' : '' }}>14 Days</option>
                            <option value="15" {{ (!empty($publishing_time) && $publishing_time==15) ? 'selected' : '' }}>15 Days</option>
                            <option value="60" {{ (!empty($publishing_time) && $publishing_time==60) ? 'selected' : '' }}>60 Days</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('minimum_word_count_required')) {
                            $minimum_word_count_required = old('minimum_word_count_required');
                        } else {
                            isset($website->minimum_word_count_required) ? $minimum_word_count_required = $website->minimum_word_count_required : '';
                        }
                        ?>
                        <label for="inputWordCount" class="form-label">Minimum Word Count Required</label>
                        <input type="number" class="form-control" id="inputWordCount" mix="1" max="1000" value="{{ (isset($minimum_word_count_required) && !empty($minimum_word_count_required)) ? $minimum_word_count_required : 1 }}" name="minimum_word_count_required">
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('backlink_type')) {
                            $backlink_type = old('backlink_type');
                        } else {
                            isset($website->backlink_type) ? $backlink_type = $website->backlink_type : '';
                        }
                        ?>
                        <label class="form-label">Backlink Type</label>
                        <div class="row bg-light rounded p-2 w-75 mx-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="backlink_type" id="inputBacklinkType1" value="dofollow" {{ (!empty($backlink_type) && $backlink_type=='dofollow' ) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inputBacklinkType1">DoFollow</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="backlink_type" id="inputBacklinkType2" value="nofollow" {{ (!empty($backlink_type) && $backlink_type=='nofollow' || !isset($backlink_type)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inputBacklinkType2">NoFollow</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('maximum_no_of_backlinks_allowed')) {
                            $maximum_no_of_backlinks_allowed = old('maximum_no_of_backlinks_allowed');
                        } else {
                            isset($website->maximum_no_of_backlinks_allowed) ? $maximum_no_of_backlinks_allowed = $website->maximum_no_of_backlinks_allowed : '';
                        }
                        ?>
                        <label for="inputBacklinksAllowed" class="form-label">Maximum no. of Backlinks allowed</label>
                        <select id="inputBacklinksAllowed" class="select2 form-select" name="maximum_no_of_backlinks_allowed" data-allow-clear="true">
                            <option value="" {{ (!isset($maximum_no_of_backlinks_allowed) || empty($maximum_no_of_backlinks_allowed)) ? 'selected' : '' }}>Select number of link</option>
                            <option value="1" {{ (!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='1' ) ? 'selected' : '' }}>1</option>
                            <option value="2" {{ (!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='2' ) ? 'selected' : '' }}>2</option>
                            <option value="3" {{ (!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='3' ) ? 'selected' : '' }}>3</option>
                            <option value="4" {{ (!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='4' ) ? 'selected' : '' }}>4</option>
                            <option value="5" {{ (!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='5' ) ? 'selected' : '' }}>5</option>
                            <option value="5+" {{ (!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='5+' ) ? 'selected' : '' }}>5+</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if (old('domain_life_validity')) {
                            $domain_life_validity = old('domain_life_validity');
                        } else {
                            isset($website->domain_life_validity) ? $domain_life_validity = $website->domain_life_validity : '';
                        }
                        ?>
                        <label for="inputDomainLifeValidity" class="form-label">Domain Life Validity:</label>
                        <select id="inputDomainLifeValidity" class="form-select select2" name="domain_life_validity" data-allow-clear="true">
                            <option value="" {{ (!isset($domain_life_validity) || empty($domain_life_validity)) ? 'selected' : '' }}>Select domain life validity</option>
                            <option value="Permanent" {{ (!empty($domain_life_validity) && $domain_life_validity=='Permanent' ) ? 'selected' : '' }}>Permanent</option>
                            <option value="Atleast for 1 year" {{ (!empty($domain_life_validity) && $domain_life_validity=='Atleast for 1 year' ) ? 'selected' : '' }}>Atleast for 1 year</option>
                            <option value="Atleast for 2 years" {{ (!empty($domain_life_validity) && $domain_life_validity=='Atleast for 2 years' ) ? 'selected' : '' }}>Atleast for 2 years</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <?php
                        if (old('sample_post_url')) {
                            $sample_post_url = old('sample_post_url');
                        } else {
                            isset($website->sample_post_url) ? $sample_post_url = $website->sample_post_url : '';
                        }
                        ?>
                        <label for="inputSamplePostUrl" class="form-label">Sample Post
                            URL<small>(https://example.com/post)</small></label>
                        <input type="text" class="form-control" id="inputSamplePostUrl" name="sample_post_url"
                            value="{{ (isset($sample_post_url) && !empty($sample_post_url)) ? $sample_post_url : '' }}"
                            placeholder="https://example.com/post">
                        <div class="invalid-feedback"><strong class="url-msg"></strong></div>
                        <p><small><strong>NOTE :</strong> Sample post should have one outgoing dofollow link and it
                                should be Google indexed.</small></p>
                    </div>
                    <div class="col-md-12">
                        <?php
                        if (old('guidelines')) {
                            $guidelines = old('guidelines');
                        } else {
                            isset($website->guidelines) ? $guidelines = $website->guidelines : '';
                        }
                        ?>
                        <label for="inputGuidelines" class="form-label">Guidelines</label>
                        <textarea class="form-control" id="inputGuidelines" rows="7" name="guidelines"
                            value="{{ (isset($guidelines) && !empty($guidelines)) ? $guidelines : '' }}"
                            placeholder="If you have any specific guidelines regarding word limit, backlink count, anchor text selection, etc. mention them below.">{{ (isset($guidelines) && !empty($guidelines)) ? $guidelines : '' }}</textarea>
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
                            <p style="float :right; font-size: 14px; color: #275570; margin-top: 5px;"> <span id="inputGuidelinesTextCount" class="badge badge-pill bg-info">{{ (isset($guidelines) && !empty($guidelines)) ? (1000-strlen($guidelines)) : 1000 }}</span> Character(s) Remaining</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        @php

                        if (old('categories')) {
                        $categories = old('categories');
                        } else {
                        isset($website->categories) ? $categories = $website->categories : '';
                        }
                        $Carr = array();
                        if (isset($categories) && !empty($categories))
                        $Carr = explode(',', $categories);
                        @endphp
                        <input type="hidden" id="inputCategories" name="categories"
                            value="{{ (isset($categories) && !empty($categories)) ? $categories : '' }}">
                        <label for="inputCategories1" class="form-label">Categories</label>
                        <div class="select2-primary">
                            <select id="inputCategories1" name="inputCategories1" class="form-select select2" multiple>
                                <option value="Agriculture" {{ (in_array("Agriculture", $Carr)) ? 'selected' : '' }}>
                                    Agriculture</option>
                                <option value="Animals & Pets" {{ (in_array("Animals & Pets", $Carr)) ? 'selected' : ''
                                    }}>Animals & Pets</option>
                                <option value="Arms and ammunition" {{ (in_array("Arms and ammunition", $Carr))
                                    ? 'selected' : '' }}>Arms and ammunition</option>
                                <option value="Arts & Entertainment" {{ (in_array("Arts & Entertainment", $Carr))
                                    ? 'selected' : '' }}>Arts & Entertainment</option>
                                <option value="Automobiles" {{ (in_array("Automobiles", $Carr)) ? 'selected' : '' }}>
                                    Automobiles</option>
                                <option value="Beauty" {{ (in_array("Beauty", $Carr)) ? 'selected' : '' }}>Beauty
                                </option>
                                <option value="Blogging" {{ (in_array("Blogging", $Carr)) ? 'selected' : '' }}>Blogging
                                </option>
                                <option value="Business" {{ (in_array("Business", $Carr)) ? 'selected' : '' }}>Business
                                </option>
                                <option value="Career & Employment" {{ (in_array("Career & Employment", $Carr))
                                    ? 'selected' : '' }}>Career & Employment</option>
                                <option value="Computer & Electronics" {{ (in_array("Computer & Electronics", $Carr))
                                    ? 'selected' : '' }}>Computer & Electronics</option>
                                <option value="Coupons Offers & Cashback" {{ (in_array("Coupons Offers & Cashback",
                                    $Carr)) ? 'selected' : '' }}>Coupons Offers & Cashback</option>
                                <option value="Digital Marketing" {{ (in_array("Digital Marketing", $Carr)) ? 'selected'
                                    : '' }}>Digital Marketing</option>
                                <option value="Education" {{ (in_array("Education", $Carr)) ? 'selected' : '' }}>
                                    Education</option>
                                <option value="Environment" {{ (in_array("Environment", $Carr)) ? 'selected' : '' }}>
                                    Environment</option>
                                <option value="Family" {{ (in_array("Family", $Carr)) ? 'selected' : '' }}>Family
                                </option>
                                <option value="Fashion & Lifestyle" {{ (in_array("Fashion & Lifestyle", $Carr))
                                    ? 'selected' : '' }}>Fashion & Lifestyle</option>
                                <option value="Finance" {{ (in_array("Finance", $Carr)) ? 'selected' : '' }}>Finance
                                </option>
                                <option value="Food & Drink" {{ (in_array("Food & Drink", $Carr)) ? 'selected' : '' }}>
                                    Food & Drink</option>
                                <option value="Games" {{ (in_array("Games", $Carr)) ? 'selected' : '' }}>Games</option>
                                <option value="General" {{ (in_array("General", $Carr)) ? 'selected' : '' }}>General
                                </option>
                                <option value="Gift" {{ (in_array("Gift", $Carr)) ? 'selected' : '' }}>Gift</option>
                                <option value="Health & Fitness" {{ (in_array("Health & Fitness", $Carr)) ? 'selected'
                                    : '' }}>Health & Fitness</option>
                                <option value="Home & Garden" {{ (in_array("Home & Garden", $Carr)) ? 'selected' : ''
                                    }}>Home & Garden</option>
                                <option value="Humor" {{ (in_array("Humor", $Carr)) ? 'selected' : '' }}>Humor</option>
                                <option value="Internet & Telecom" {{ (in_array("Internet & Telecom", $Carr))
                                    ? 'selected' : '' }}>Internet & Telecom</option>
                                <option value="Law & Government" {{ (in_array("Law & Government", $Carr)) ? 'selected'
                                    : '' }}>Law & Government</option>
                                <option value="Leisure & Hobbies" {{ (in_array("Leisure & Hobbies", $Carr)) ? 'selected'
                                    : '' }}>Leisure & Hobbies</option>
                                <option value="Magazine" {{ (in_array("Magazine", $Carr)) ? 'selected' : '' }}>Magazine
                                </option>
                                <option value="Manufacturing" {{ (in_array("Manufacturing", $Carr)) ? 'selected' : ''
                                    }}>Manufacturing</option>
                                <option value="Marketing & Advertising" {{ (in_array("Marketing & Advertising", $Carr))
                                    ? 'selected' : '' }}>Marketing & Advertising</option>
                                <option value="Music" {{ (in_array("Music", $Carr)) ? 'selected' : '' }}>Music</option>
                                <option value="News & Media" {{ (in_array("News & Media", $Carr)) ? 'selected' : '' }}>
                                    News & Media</option>
                                <option value="Photography" {{ (in_array("Photography",$Carr)) ? 'selected' : '' }}>
                                    Photography</option>
                                <option value="Politics" {{ (in_array("Politics",$Carr)) ? 'selected' : '' }}>Politics
                                </option>
                                <option value="Quotes" {{ (in_array("Quotes",$Carr)) ? 'selected' : '' }}>Quotes
                                </option>
                                <option value="Real estate" {{ (in_array("Real estate",$Carr)) ? 'selected' : '' }}>Real
                                    estate</option>
                                <option value="Region" {{ (in_array("Region",$Carr)) ? 'selected' : '' }}>Region
                                </option>
                                <option value="Reviews" {{ (in_array("Reviews",$Carr)) ? 'selected' : '' }}>Reviews
                                </option>
                                <option value="Science" {{ (in_array("Science",$Carr)) ? 'selected' : '' }}>Science
                                </option>
                                <option value="Shopping" {{ (in_array("Shopping",$Carr)) ? 'selected' : '' }}>Shopping
                                </option>
                                <option value="Spanish" {{ (in_array("Spanish",$Carr)) ? 'selected' : '' }}>Spanish
                                </option>
                                <option value="Sports" {{ (in_array("Sports",$Carr)) ? 'selected' : '' }}>Sports
                                </option>
                                <option value="Sprituality" {{ (in_array("Sprituality",$Carr)) ? 'selected' : '' }}>
                                    Sprituality</option>
                                <option value="Technology" {{ (in_array("Technology",$Carr)) ? 'selected' : '' }}>
                                    Technology</option>
                                <option value="Travelling" {{ (in_array("Travelling",$Carr)) ? 'selected' : '' }}>
                                    Travelling</option>
                                <option value="Web development" {{ (in_array("Web development",$Carr)) ? 'selected' : ''
                                    }}>Web development</option>
                                <option value="Wedding" {{ (in_array("Wedding",$Carr)) ? 'selected' : '' }}>Wedding
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        @php
                        if(old('forbidden_categories')){
                        $forbidden_categories = old('forbidden_categories');
                        } else {
                        isset($website->forbidden_categories) ? $forbidden_categories = $website->forbidden_categories :
                        '';
                        }
                        $FCarr = array();
                        if(isset($forbidden_categories) && !empty($forbidden_categories)) $FCarr =
                        explode(',',$forbidden_categories);
                        @endphp
                        <input type="hidden" id="inputForbiddenCategories" name="forbidden_categories"
                            value="{{ (isset($forbidden_categories) && !empty($forbidden_categories)) ? $forbidden_categories : '' }}">
                        <label for="inputForbiddenCategories1" class="form-label">Select the forbidden categories you
                            accept</label>
                        <div class="select2-info">
                            <select id="inputForbiddenCategories1" name="inputForbiddenCategories1"
                                class="select2 form-select" multiple>
                                <option value="Casino" {{ (in_array("Casino",$FCarr)) ? 'selected' : '' }}>Casino
                                </option>
                                <option value="CBD/Marijuana" {{ (in_array("CBD/Marijuana",$FCarr)) ? 'selected' : ''
                                    }}>CBD/Marijuana</option>
                                <option value="Cryptocurrency" {{ (in_array("Cryptocurrency",$FCarr)) ? 'selected' : ''
                                    }}>Cryptocurrency</option>
                                <option value="Vape" {{ (in_array("Vape",$FCarr)) ? 'selected' : '' }}>Vape</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if (old('guest_post_price')) {
                            $guest_post_price = old('guest_post_price');
                        } else {
                            isset($website->guest_post_price) ? $guest_post_price = $website->guest_post_price : '';
                        }
                        ?>
                        <label for="inputGuestPostPrice" class="form-label">Guest post price ($)</label>
                        <input type="number" class="form-control" id="inputGuestPostPrice"
                            value="{{ (isset($guest_post_price) && !empty($guest_post_price)) ? $guest_post_price : 1 }}"
                            name="guest_post_price" placeholder="$">
                    </div>
                    <div class="col-md-6">
                        <?php
                        if (old('link_insertion_price')) {
                            $link_insertion_price = old('link_insertion_price');
                        } else {
                            isset($website->link_insertion_price) ? $link_insertion_price = $website->link_insertion_price : '';
                        }
                        ?>
                        <label for="inputLinkInsertionPrice" class="form-label">Link insertion price ($)</label>
                        <input type="number" class="form-control" id="inputLinkInsertionPrice"
                            value="{{ (isset($link_insertion_price) && !empty($link_insertion_price)) ? $link_insertion_price : 1 }}"
                            name="link_insertion_price" placeholder="$">
                    </div>

                    <div class="col-md-12 W-100 m-3">
                        <div class="row border border-primary p-3 rounded">
                            <div class="col-md-6">
                                <p><strong>Why should I Share my Analytics Detail with Links Farmer?</strong>
                                </p>
                                <ol>
                                    <li>Owner's websites are shown on top of the Marketplace.</li>
                                    <li>Your website will not be added by any other contributor.</li>
                                    <li>Your actual traffic will be showcased to the clients compared to any other SEO
                                        tool.</li>
                                </ol>
                                <p>If you have any question follow <a href="javascript:void(0)">this guide</a> where we
                                    explain step by step how to verify you website...</p>
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
                        <label for="site_verification_file" class="form-label">Upload Your Website Analytics
                            Report</label>
                        <input type="file" name="site_verification_file" id="site_verification_file"
                            class="form-control" {{ (isset($site_verification_file) && !empty($site_verification_file))
                            ? '' : 'required=""' }}>
                        <input type="hidden" name="old_site_verification_file" class="form-control"
                            value="{{ (isset($site_verification_file) && !empty($site_verification_file)) ? $site_verification_file : '' }}">
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
                            <label class="form-check-label" for="inputReadedGuide">Please confirm that you have read and
                                followed the guide. </label>
                            <input class="form-check-input" type="checkbox" name="readedguide" id="inputReadedGuide"
                                value="yes">
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
<script src="{{ asset_url('script/addweb_form.js') }}"></script>

@endpush