

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset_url('libs/select2/select2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset_url('libs/dropzone/dropzone.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('sidebar-content'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php if(isset($website) && !empty($website)): ?>
                    <?php echo e(__('Edit Website')); ?>

                    <?php else: ?>
                    <?php echo e(__('Add Website')); ?>

                    <?php endif; ?>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-primary float-end"><i
                            class="ti ti-arrow-narrow-left mx-1"></i> Go Back</a>
                </div>
            </div>
        </div>
    </div>
    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
    <section class="border rounded p-5 mt-5 bg-white">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form class="row g-3" action="<?php echo e((isset($website) && !empty($website)) ? route('publisher.website.update', $website->id) : route('publisher.website.store')); ?>" method="Post" id="addWebsiteForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php if(!isset($website) || empty($website)): ?>
                    <div class="col-md-12">
                        <label for="website_url" class="form-label">Website URL
                            <small>(https://example.com)</small></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['website_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputWebUrl" name="website_url" required placeholder="https://example.com" value="<?php echo e(old('website_url')); ?>" autofocus>
                        <div class="invalid-feedback"></div>
                    </div>
                    <?php else: ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" id="id" name="id" value="<?php echo e($website->id); ?>">
                    <input type="hidden" id="inputWebUrl" name="website_url" value="<?php echo e($website->website_url); ?>">
                    <?php endif; ?>
                    <div class="col-md-4">
                        <?php
                        if (old('domain_authority')) {
                            $domain_authority = old('domain_authority');
                        } else {
                            isset($website->domain_authority) ? $domain_authority = $website->domain_authority : '';
                        }
                        ?>
                        <label for="inputDomainAuthority" class="form-label">DA <small>Domain Authority</small></label>
                        <input type="number" class="form-control" id="inputDomainAuthority" name="domain_authority" mix="1" max="100" value="<?php echo e((isset($domain_authority) && !empty($domain_authority)) ? $domain_authority : 1); ?>" placeholder="DA (domain Authority)">

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
                        <input type="number" class="form-control" id="inputPageAuthority" name="page_authority" mix="1" max="100" value="<?php echo e((isset($page_authority) && !empty($page_authority)) ? $page_authority : 1); ?>" placeholder="PA (Page Authority)">
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
                        <input type="number" class="form-control" id="inputSpamScore" name="spam_score" mix="0" max="100" value="<?php echo e((isset($spam_score) && !empty($spam_score)) ? $spam_score : 1); ?>" placeholder="Spam Score">
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
                            <option value="" <?php echo e((!isset($publishing_time) || empty($publishing_time)) ? 'selected' : ''); ?>>Select Day</option>
                            <option value="1" <?php echo e((!empty($publishing_time) && $publishing_time==1) ? 'selected' : ''); ?>>1 Days</option>
                            <option value="2" <?php echo e((!empty($publishing_time) && $publishing_time==2) ? 'selected' : ''); ?>>2 Days</option>
                            <option value="3" <?php echo e((!empty($publishing_time) && $publishing_time==3) ? 'selected' : ''); ?>>3 Days</option>
                            <option value="4" <?php echo e((!empty($publishing_time) && $publishing_time==4) ? 'selected' : ''); ?>>4 Days</option>
                            <option value="5" <?php echo e((!empty($publishing_time) && $publishing_time==5) ? 'selected' : ''); ?>>5 Days</option>
                            <option value="6" <?php echo e((!empty($publishing_time) && $publishing_time==6) ? 'selected' : ''); ?>>6 Days</option>
                            <option value="7" <?php echo e((!empty($publishing_time) && $publishing_time==7) ? 'selected' : ''); ?>>7 Days</option>
                            <option value="8" <?php echo e((!empty($publishing_time) && $publishing_time==8) ? 'selected' : ''); ?>>8 Days</option>
                            <option value="9" <?php echo e((!empty($publishing_time) && $publishing_time==9) ? 'selected' : ''); ?>>9 Days</option>
                            <option value="10" <?php echo e((!empty($publishing_time) && $publishing_time==10) ? 'selected' : ''); ?>>10 Days</option>
                            <option value="11" <?php echo e((!empty($publishing_time) && $publishing_time==11) ? 'selected' : ''); ?>>11 Days</option>
                            <option value="12" <?php echo e((!empty($publishing_time) && $publishing_time==12) ? 'selected' : ''); ?>>12 Days</option>
                            <option value="13" <?php echo e((!empty($publishing_time) && $publishing_time==13) ? 'selected' : ''); ?>>13 Days</option>
                            <option value="14" <?php echo e((!empty($publishing_time) && $publishing_time==14) ? 'selected' : ''); ?>>14 Days</option>
                            <option value="15" <?php echo e((!empty($publishing_time) && $publishing_time==15) ? 'selected' : ''); ?>>15 Days</option>
                            <option value="60" <?php echo e((!empty($publishing_time) && $publishing_time==60) ? 'selected' : ''); ?>>60 Days</option>
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
                        <input type="number" class="form-control" id="inputWordCount" value="<?php echo e((isset($minimum_word_count_required) && !empty($minimum_word_count_required)) ? $minimum_word_count_required : 1); ?>" name="minimum_word_count_required">
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
                                    <input class="form-check-input" type="radio" name="backlink_type" id="inputBacklinkType1" value="dofollow" <?php echo e((!empty($backlink_type) && $backlink_type=='dofollow' ) ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="inputBacklinkType1">DoFollow</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="backlink_type" id="inputBacklinkType2" value="nofollow" <?php echo e((!empty($backlink_type) && $backlink_type=='nofollow' || !isset($backlink_type)) ? 'checked' : ''); ?>>
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
                            <option value="" <?php echo e((!isset($maximum_no_of_backlinks_allowed) || empty($maximum_no_of_backlinks_allowed)) ? 'selected' : ''); ?>>Select number of link</option>
                            <option value="1" <?php echo e((!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='1' ) ? 'selected' : ''); ?>>1</option>
                            <option value="2" <?php echo e((!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='2' ) ? 'selected' : ''); ?>>2</option>
                            <option value="3" <?php echo e((!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='3' ) ? 'selected' : ''); ?>>3</option>
                            <option value="4" <?php echo e((!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='4' ) ? 'selected' : ''); ?>>4</option>
                            <option value="5" <?php echo e((!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='5' ) ? 'selected' : ''); ?>>5</option>
                            <option value="5+" <?php echo e((!empty($maximum_no_of_backlinks_allowed) && $maximum_no_of_backlinks_allowed=='5+' ) ? 'selected' : ''); ?>>5+</option>
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
                            <option value="" <?php echo e((!isset($domain_life_validity) || empty($domain_life_validity)) ? 'selected' : ''); ?>>Select domain life validity</option>
                            <option value="Permanent" <?php echo e((!empty($domain_life_validity) && $domain_life_validity=='Permanent' ) ? 'selected' : ''); ?>>Permanent</option>
                            <option value="Atleast for 1 year" <?php echo e((!empty($domain_life_validity) && $domain_life_validity=='Atleast for 1 year' ) ? 'selected' : ''); ?>>Atleast for 1 year</option>
                            <option value="Atleast for 2 years" <?php echo e((!empty($domain_life_validity) && $domain_life_validity=='Atleast for 2 years' ) ? 'selected' : ''); ?>>Atleast for 2 years</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-4">
                        <?php
                        if(old('traffic_by_country')){
                        $traffic_by_country = old('traffic_by_country');
                        } else {
                        isset($website->traffic_by_country) ? $traffic_by_country = $website->traffic_by_country : '';
                        }
                        $FCarr = array();
                        if(isset($traffic_by_country) && !empty($traffic_by_country)) {
                        $FCarr = explode(',', $traffic_by_country);
                        }
                        ?>
                        <input type="hidden" id="traffic_by_countrys" name="traffic_by_country"
                            value="<?php echo e((isset($traffic_by_country) && !empty($traffic_by_country)) ? $traffic_by_country : ''); ?>">
                        <label for="traffic_by_country" class="form-label">Traffic By Country</label>
                        <div class="select2-info">
                            <select id="traffic_by_countrys" name="traffic_by_country[]"
                                class="select2 form-select" multiple>
                                <option value="Australia" <?php echo e((in_array("Australia", $FCarr)) ? 'selected' : ''); ?>>Australia</option>
                                <option value="India" <?php echo e((in_array("India", $FCarr)) ? 'selected' : ''); ?>>India</option>
                                <option value="United States" <?php echo e((in_array("United States", $FCarr)) ? 'selected' : ''); ?>>United States</option>
                            </select>
                        </div>
                        <div id="country-error" class="text-danger" style="display: none;">Please select at least one country.</div>
                    </div> -->

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
                            value="<?php echo e((isset($sample_post_url) && !empty($sample_post_url)) ? $sample_post_url : ''); ?>"
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
                            value="<?php echo e((isset($guidelines) && !empty($guidelines)) ? $guidelines : ''); ?>"
                            placeholder="If you have any specific guidelines regarding word limit, backlink count, anchor text selection, etc. mention them below."><?php echo e((isset($guidelines) && !empty($guidelines)) ? $guidelines : ''); ?></textarea>
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
                            <p style="float :right; font-size: 14px; color: #275570; margin-top: 5px;"> <span id="inputGuidelinesTextCount" class="badge badge-pill bg-info"><?php echo e((isset($guidelines) && !empty($guidelines)) ? (1000-strlen($guidelines)) : 1000); ?></span> Character(s) Remaining</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <?php
                        if (old('categories')) {
                        $categories = old('categories');
                        } else {
                        isset($website->categories) ? $categories = $website->categories : '';
                        }
                        $Carr = array();
                        if (isset($categories) && !empty($categories))
                        $Carr = explode(',', $categories);
                        ?>
                        <input type="hidden" id="inputCategories" name="categories"
                            value="<?php echo e((isset($categories) && !empty($categories)) ? $categories : ''); ?>" multiple>
                        <label for="inputCategories1" class="form-label">Categories</label>
                        <div class="select2-primary">
                            <select id="inputCategories1" name="categories[]" class="form-select select2" multiple>
                                <option value="General" <?php echo e(in_array("General", $Carr) ? 'selected' : ''); ?>>General</option>
                                <option value="Agriculture" <?php echo e(in_array("Agriculture", $Carr) ? 'selected' : ''); ?>>Agriculture</option>
                                <option value="Animals & Pets" <?php echo e(in_array("Animals & Pets", $Carr) ? 'selected' : ''); ?>>Animals & Pets</option>
                                <option value="Arms and ammunition" <?php echo e(in_array("Arms and ammunition", $Carr) ? 'selected' : ''); ?>>Arms and ammunition</option>
                                <option value="Arts & Entertainment" <?php echo e(in_array("Arts & Entertainment", $Carr) ? 'selected' : ''); ?>>Arts & Entertainment</option>
                                <option value="Automobiles" <?php echo e((in_array("Automobiles", $Carr)) ? 'selected' : ''); ?>>
                                    Automobiles</option>
                                <option value="Beauty" <?php echo e((in_array("Beauty", $Carr)) ? 'selected' : ''); ?>>Beauty
                                </option>
                                <option value="Blogging" <?php echo e((in_array("Blogging", $Carr)) ? 'selected' : ''); ?>>Blogging
                                </option>
                                <option value="Business" <?php echo e((in_array("Business", $Carr)) ? 'selected' : ''); ?>>Business
                                </option>
                                <option value="Career & Employment" <?php echo e((in_array("Career & Employment", $Carr))
                                    ? 'selected' : ''); ?>>Career & Employment</option>
                                <option value="Computer & Electronics" <?php echo e((in_array("Computer & Electronics", $Carr))
                                    ? 'selected' : ''); ?>>Computer & Electronics</option>
                                <option value="Coupons Offers & Cashback" <?php echo e((in_array("Coupons Offers & Cashback",
                                    $Carr)) ? 'selected' : ''); ?>>Coupons Offers & Cashback</option>
                                <option value="Digital Marketing" <?php echo e((in_array("Digital Marketing", $Carr)) ? 'selected'
                                    : ''); ?>>Digital Marketing</option>
                                <option value="Education" <?php echo e((in_array("Education", $Carr)) ? 'selected' : ''); ?>>
                                    Education</option>
                                <option value="Environment" <?php echo e((in_array("Environment", $Carr)) ? 'selected' : ''); ?>>
                                    Environment</option>
                                <option value="Family" <?php echo e((in_array("Family", $Carr)) ? 'selected' : ''); ?>>Family
                                </option>
                                <option value="Fashion & Lifestyle" <?php echo e((in_array("Fashion & Lifestyle", $Carr))
                                    ? 'selected' : ''); ?>>Fashion & Lifestyle</option>
                                <option value="Finance" <?php echo e((in_array("Finance", $Carr)) ? 'selected' : ''); ?>>Finance
                                </option>
                                <option value="Food & Drink" <?php echo e((in_array("Food & Drink", $Carr)) ? 'selected' : ''); ?>>
                                    Food & Drink</option>
                                <option value="Games" <?php echo e((in_array("Games", $Carr)) ? 'selected' : ''); ?>>Games</option>

                                <option value="Gift" <?php echo e((in_array("Gift", $Carr)) ? 'selected' : ''); ?>>Gift</option>
                                <option value="Health & Fitness" <?php echo e((in_array("Health & Fitness", $Carr)) ? 'selected'
                                    : ''); ?>>Health & Fitness</option>
                                <option value="Home & Garden" <?php echo e((in_array("Home & Garden", $Carr)) ? 'selected' : ''); ?>>Home & Garden</option>
                                <option value="Humor" <?php echo e((in_array("Humor", $Carr)) ? 'selected' : ''); ?>>Humor</option>
                                <option value="Internet & Telecom" <?php echo e((in_array("Internet & Telecom", $Carr))
                                    ? 'selected' : ''); ?>>Internet & Telecom</option>
                                <option value="Law & Government" <?php echo e((in_array("Law & Government", $Carr)) ? 'selected'
                                    : ''); ?>>Law & Government</option>
                                <option value="Leisure & Hobbies" <?php echo e((in_array("Leisure & Hobbies", $Carr)) ? 'selected'
                                    : ''); ?>>Leisure & Hobbies</option>
                                <option value="Magazine" <?php echo e((in_array("Magazine", $Carr)) ? 'selected' : ''); ?>>Magazine
                                </option>
                                <option value="Manufacturing" <?php echo e((in_array("Manufacturing", $Carr)) ? 'selected' : ''); ?>>Manufacturing</option>
                                <option value="Marketing & Advertising" <?php echo e((in_array("Marketing & Advertising", $Carr))
                                    ? 'selected' : ''); ?>>Marketing & Advertising</option>
                                <option value="Music" <?php echo e((in_array("Music", $Carr)) ? 'selected' : ''); ?>>Music</option>
                                <option value="News & Media" <?php echo e((in_array("News & Media", $Carr)) ? 'selected' : ''); ?>>
                                    News & Media</option>
                                <option value="Photography" <?php echo e((in_array("Photography",$Carr)) ? 'selected' : ''); ?>>
                                    Photography</option>
                                <option value="Politics" <?php echo e((in_array("Politics",$Carr)) ? 'selected' : ''); ?>>Politics
                                </option>
                                <option value="Quotes" <?php echo e((in_array("Quotes",$Carr)) ? 'selected' : ''); ?>>Quotes
                                </option>
                                <option value="Real estate" <?php echo e((in_array("Real estate",$Carr)) ? 'selected' : ''); ?>>Real
                                    estate</option>
                                <option value="Region" <?php echo e((in_array("Region",$Carr)) ? 'selected' : ''); ?>>Region
                                </option>
                                <option value="Reviews" <?php echo e((in_array("Reviews",$Carr)) ? 'selected' : ''); ?>>Reviews
                                </option>
                                <option value="Science" <?php echo e((in_array("Science",$Carr)) ? 'selected' : ''); ?>>Science
                                </option>
                                <option value="Shopping" <?php echo e((in_array("Shopping",$Carr)) ? 'selected' : ''); ?>>Shopping
                                </option>
                                <option value="Spanish" <?php echo e((in_array("Spanish",$Carr)) ? 'selected' : ''); ?>>Spanish
                                </option>
                                <option value="Sports" <?php echo e((in_array("Sports",$Carr)) ? 'selected' : ''); ?>>Sports
                                </option>
                                <option value="Sprituality" <?php echo e((in_array("Sprituality",$Carr)) ? 'selected' : ''); ?>>
                                    Sprituality</option>
                                <option value="Technology" <?php echo e((in_array("Technology",$Carr)) ? 'selected' : ''); ?>>
                                    Technology</option>
                                <option value="Travelling" <?php echo e((in_array("Travelling",$Carr)) ? 'selected' : ''); ?>>
                                    Travelling</option>
                                <option value="Web development" <?php echo e((in_array("Web development",$Carr)) ? 'selected' : ''); ?>>Web development</option>
                                <option value="Wedding" <?php echo e((in_array("Wedding",$Carr)) ? 'selected' : ''); ?>>Wedding
                                </option>
                                <!-- Add other options here -->
                            </select>
                            <small id="category-limit-message" class="form-text text-danger d-none">
                                You can only select up to 5 categories.
                            </small>
                            <small class="form-text text-muted">
                                Please select up to 5 categories only
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <?php
                        if(old('forbidden_categories')){
                        $forbidden_categories = old('forbidden_categories');
                        } else {
                        isset($website->forbidden_categories) ? $forbidden_categories = $website->forbidden_categories :
                        '';
                        }
                        $FCarr = array();
                        if(isset($forbidden_categories) && !empty($forbidden_categories)) $FCarr =
                        explode(',',$forbidden_categories);
                        ?>
                        <input type="hidden" id="inputForbiddenCategories" name="forbidden_categories"
                            value="<?php echo e((isset($forbidden_categories) && !empty($forbidden_categories)) ? $forbidden_categories : ''); ?>">
                        <label for="inputForbiddenCategories1" class="form-label">Select the forbidden categories you
                            accept</label>
                        <div class="select2-info">

                            <select id="inputForbiddenCategories1" name="forbidden_categories[]"
                                class="select2 form-select" multiple>
                                <option value="Casino" <?php echo e((in_array("Casino",$FCarr)) ? 'selected' : ''); ?>>Casino
                                </option>
                                <option value="CBD/Marijuana" <?php echo e((in_array("CBD/Marijuana",$FCarr)) ? 'selected' : ''); ?>>CBD/Marijuana</option>
                                <option value="Cryptocurrency" <?php echo e((in_array("Cryptocurrency",$FCarr)) ? 'selected' : ''); ?>>Cryptocurrency</option>
                                <option value="Vape" <?php echo e((in_array("Vape",$FCarr)) ? 'selected' : ''); ?>>Vape</option>
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
                            value="<?php echo e((isset($guest_post_price) && !empty($guest_post_price)) ? $guest_post_price : 1); ?>"
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
                            value="<?php echo e((isset($link_insertion_price) && !empty($link_insertion_price)) ? $link_insertion_price : 1); ?>"
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
                        <label for="site_verification_file" class="form-label">Upload Your Website Analytics Report</label>
                        <input type="file" name="site_verification_file" id="site_verification_file" class="form-control"
                            <?php echo e((isset($site_verification_file) && !empty($site_verification_file)) ? '' : 'required'); ?> accept=".pdf">
                        <input type="hidden" name="old_site_verification_file" class="form-control"
                            value="<?php echo e((isset($site_verification_file) && !empty($site_verification_file)) ? $site_verification_file : ''); ?>">
                        <div id="file-error" class="text-danger" style="display: none;">Only PDF files are allowed.</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <label class="form-check-label" for="inputReadedGuide">Please confirm that you have read and followed the guide. </label>
                            <input class="form-check-input" type="checkbox" name="readedguide" id="inputReadedGuide" value="yes" required>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-outline-primary w-25" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $.validator.addMethod("minSelected", function(value, element, min) {
            return $(element).val() && $(element).val().length >= min;
        }, "Please select at least one option.");

        $.validator.addMethod("maxSelected", function(value, element, max) {
            return $(element).val() && $(element).val().length <= max;
        }, "You can select up to {0} options only.");

        $("#addWebsiteForm").validate({
            rules: {
                website_url: {
                    required: true,
                    url: true
                },
                sample_post_url: {
                    required: true,
                    url: true
                },
                domain_authority: {
                    required: true,
                    min: 1,
                    max: 100
                },
                domain_rating: {
                    required: true,
                    min: 1,
                    max: 100
                },
                page_authority: {
                    required: true,
                    min: 1,
                    max: 100
                },
                publishing_time: {
                    required: true,

                },
                spam_score: {
                    required: true,
                    min: 0,
                    max: 100
                },
                maximum_no_of_backlinks_allowed: {
                    required: true
                },
                minimum_word_count_required: {
                    required: true,
                    min: 500
                },
                domain_life_validity: {
                    required: true
                },
                "categories[]": {
                    minSelected: 1,
                    maxSelected: 5
                },


                guest_post_price: {
                    required: true,
                    min: 1,
                    max: 1000
                },
                link_insertion_price: {
                    required: true,
                    min: 1,
                    max: 1000
                },

            },
            messages: {
                website_url: {
                    required: "Please enter a website URL.",
                    url: "Please enter a valid URL starting with https:// or http://."
                },
                sample_post_url: {
                    required: "Please enter a sample post URL.",
                    url: "Please enter a valid URL starting with https:// or http://."
                },
                domain_authority: {
                    required: "Please enter the domain authority.",
                    min: "Domain authority must be at least 1.",
                    max: "Domain authority cannot exceed 100."
                },
                domain_rating: {
                    required: "Please enter the domain rating.",
                    min: "Domain rating must be at least 1.",
                    max: "Domain rating cannot exceed 100."
                },
                page_authority: {
                    required: "Please enter the page authority.",
                    min: "Page authority must be at least 1.",
                    max: "Page authority cannot exceed 100."
                },
                publishing_time: {
                    required: "Please enter the publishing time.",

                },
                spam_score: {
                    required: "Please enter the spam score.",
                    min: "Spam score must be at least 0.",
                    max: "Spam score cannot exceed 100."
                },
                maximum_no_of_backlinks_allowed: {
                    required: "Please select the maximum number of backlinks allowed."
                },
                minimum_word_count_required: {
                    required: "Please select the minimum word count.",
                    min: "Minimum word count must be greater than 500."
                },
                "categories[]": {
                    minSelected: "Please select at least 1 category.",
                    maxSelected: "You can select up to 5 categories only."
                },

                guest_post_price: {
                    required: "Please enter the guest post price.",
                    min: "Guest post price must be at least 1.",
                    max: "Guest post price cannot exceed 1000."
                },
                link_insertion_price: {
                    required: "Please enter the link insertion price.",
                    min: "Link insertion price must be at least 1.",
                    max: "Link insertion price cannot exceed 1000."
                },

            },
            errorClass: "is-invalid",
            validClass: "is-valid",
            highlight: function(element) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element) {
                $(element).addClass("is-valid").removeClass("is-invalid");
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else {
                    error.insertAfter(element);
                }
            },
            onfocusout: function(element) {
                this.element(element);
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


    document.getElementById('submit').addEventListener('click', function(event) {
        var fileInput = document.getElementById('site_verification_file');
        var filePath = fileInput.value;
        var fileErrorMessage = document.getElementById('file-error');

        fileErrorMessage.style.display = 'none';

        if (filePath) {
            var allowedExtensions = /(\.pdf)$/i;
            if (!allowedExtensions.exec(filePath)) {
                fileErrorMessage.style.display = 'block';
                fileInput.value = '';
                event.preventDefault();
            }
        }
    });

    $(document).ready(function() {
        $('#inputCategories1').on('change', function() {
            var selectedOptions = $(this).find('option:selected');
            if (selectedOptions.length > 5) {
                $('#category-limit-message').removeClass('d-none');
                selectedOptions.last().prop('selected', false);
            } else {
                $('#category-limit-message').addClass('d-none');
            }
        });
    });

    $('#inputWebUrl').blur(function() {
        var websiteUrl = $(this).val();
        var submitButton = $('#submit');

        submitButton.prop('disabled', true);

        if (websiteUrl) {
            $.ajax({
                url: '/check-website',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    website_url: websiteUrl
                },
                success: function(response) {
                    if (response.exists) {
                        $('#inputWebUrl').addClass('is-invalid').next('.invalid-feedback').text(response.message).show();
                        submitButton.prop('disabled', true);
                    } else {
                        $('#inputWebUrl').removeClass('is-invalid').next('.invalid-feedback').text('').hide();
                        submitButton.prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    submitButton.prop('disabled', false);
                }
            });
        } else {
            submitButton.prop('disabled', false);
        }
    });

    $('#addWebsiteForm').submit(function(event) {
        if ($('#inputWebUrl').next('.invalid-feedback').is(':visible')) {
            event.preventDefault();
        }
    });
</script>

<script src="<?php echo e(asset_url('libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset_url('js/form-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset_url('libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset_url('js/forms-selects.js')); ?>"></script>
<script src="<?php echo e(asset_url('.../public\script/addweb_form.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('publisher.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\localseolinkbuilding\resources\views/publisher/website_create.blade.php ENDPATH**/ ?>