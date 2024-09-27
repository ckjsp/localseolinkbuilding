<!-- Menu -->

<aside class="layout-menu menu-vertical menu bg-menu-theme " style="width: 250px; overflow-y: auto;">
    <div class="app-brand demo">
        <a href="{{ route('publisher') }}" class="app-brand-link">
            <img src="{{ asset_url('img/favicon.svg') }}" alt="Logo" class="w-60 small-logo">
            <img src="{{ asset_url('img/logo.svg') }}" alt="Logo" class="w-100 full-logo">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <form name="websitefilter" id="websitefilter" class="websitefilter">
        <input type="hidden" id="url" value="{{ url('website/filter') }}">

        <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item py-2">
                <div class="px-3">
                    @csrf
                    <label for="inputCategories1" class="form-label">Categories</label>
                    <div class="select2-primary">
                        <select id="selectcategory" class="form-select select2" name="selectcategory[]" multiple>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Animals & Pets">Animals & Pets</option>
                            <option value="Arms and ammunition">Arms and ammunition</option>
                            <option value="Arts & Entertainment">Arts & Entertainment</option>
                            <option value="Automobiles">Automobiles</option>
                            <option value="Beauty">Beauty</option>
                            <option value="Blogging">Blogging</option>
                            <option value="Business">Business</option>
                            <option value="Career & Employment">Career & Employment</option>
                            <option value="Computer & Electronics">Computer & Electronics</option>
                            <option value="Coupons Offers & Cashback">Coupons Offers & Cashback</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Education">Education</option>
                            <option value="Environment">Environment</option>
                            <option value="Family">Family</option>
                            <option value="Fashion & Lifestyle">Fashion & Lifestyle</option>
                            <option value="Finance">Finance</option>
                            <option value="Food & Drink">Food & Drink</option>
                            <option value="Games">Games</option>
                            <option value="General">General</option>
                            <option value="Gift">Gift</option>
                            <option value="Health & Fitness">Health & Fitness</option>
                            <option value="Home & Garden">Home & Garden</option>
                            <option value="Humor">Humor</option>
                            <option value="Internet & Telecom">Internet & Telecom</option>
                            <option value="Law & Government">Law & Government</option>
                            <option value="Leisure & Hobbies">Leisure & Hobbies</option>
                            <option value="Magazine">Magazine</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Marketing & Advertising">Marketing & Advertising</option>
                            <option value="Music">Music</option>
                            <option value="News & Media">News & Media</option>
                            <option value="Photography">Photography</option>
                            <option value="Politics">Politics</option>
                            <option value="Quotes">Quotes</option>
                            <option value="Real estate">Real estate</option>
                            <option value="Region">Region</option>
                            <option value="Reviews">Reviews</option>
                            <option value="Science">Science</option>
                            <option value="Shopping">Shopping</option>
                            <option value="Spanish">Spanish</option>
                            <option value="Sports">Sports</option>
                            <option value="Sprituality">Sprituality</option>
                            <option value="Technology">Technology</option>
                            <option value="Travelling">Travelling</option>
                            <option value="Web development">Web development</option>
                            <option value="Wedding">Wedding</option>
                        </select>
                    </div>
                </div>
            </li>

            <li class="menu-item py-2">
                <div class="px-3">
                    @csrf
                    <label for="selectday" class="form-label">TAT</label>
                    <div class="select2-primary">
                        <select id="selectday" class="form-select select2" name="selectday[]" multiple="multiple" data-placeholder="Select days">
                            <option value="1">Last 1 day</option>
                            <option value="2">Last 2 days</option>
                            <option value="3">Last 3 days</option>
                            <option value="4">Last 4 days</option>
                            <option value="5">Last 5 days</option>
                            <option value="6">Last 6 days</option>
                            <option value="7">Last 7 days</option>
                            <option value="8">Last 8 days</option>
                            <option value="9">Last 9 days</option>
                            <option value="10">Last 10 days</option>
                            <option value="11">Last 11 days</option>
                            <option value="12">Last 12 days</option>
                            <option value="13">Last 13 days</option>
                            <option value="14">Last 14 days</option>
                            <option value="15">Last 15 days</option>
                            <option value="30">Last 30 days</option>
                            <option value="60">Last 60 days</option>
                            <!-- Add more options if needed -->
                        </select>
                    </div>
                </div>
            </li>

            <li class="menu-item py-2">
                <div class="px-3">
                    @csrf
                    <label for="inputCountry1" class="form-label">Country</label>
                    <div class="select2-primary">
                        <select id="selectcontry" name="selectcontry[]" class="form-select select2" multiple>
                            <option value="Australia">Australia</option>
                            <option value="India">India</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>
                </div>
            </li>
            <li class="menu-item py-2">
                <div class="px-3">
                    <label class="form-label">Link Type</label>
                    <div class="row rounded py-2 ms-1">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputBacklinkType1" type="radio" name="backlink_type" id="inputBacklinkType1" value="dofollow">
                                <label class="form-check-label" for="inputBacklinkType1">DoFollow</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputBacklinkType2" type="radio" name="backlink_type" id="inputBacklinkType2" value="nofollow">
                                <label class="form-check-label" for="inputBacklinkType2">NoFollow</label>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="menu-item py-2">
                <div class="px-3">
                    <label class="form-label">Price</label>
                    <div class="row rounded py-2 ms-1">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice1" type="radio" name="price_filters" id="inputPrice1" value="0-100">
                                <label class="form-check-label" for="inputPrice1">Under $100</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice2" type="radio" name="price_filters" id="inputPrice2" value="100-500">
                                <label class="form-check-label" for="inputPrice2">$100 to $500</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice3" type="radio" name="price_filters" id="inputPrice3" value="500-1000">
                                <label class="form-check-label" for="inputPrice3">$500 to $1000</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice4" type="radio" name="price_filters" id="inputPrice4" value="1000-1500">
                                <label class="form-check-label" for="inputPrice4">$1000 to $1500</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice5" type="radio" name="price_filters" id="inputPrice5" value="1500-2000">
                                <label class="form-check-label" for="inputPrice5">$1500 to $2000</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice6" type="radio" name="price_filters" id="inputPrice6" value="2000-3000">
                                <label class="form-check-label" for="inputPrice6">$2000 to $3000</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputPrice7" type="radio" name="price_filters" id="inputPrice7" value="3001-99999999">
                                <label class="form-check-label" for="inputPrice7">Above $3000</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 p-1">
                                <input type="text" name="priceMin" id="priceMin" class="form-control numeric" placeholder="min" autocomplete="off" maxlength="5">
                            </div>
                            <div class="col-md-4 p-1">
                                <input type="text" name="priceMax" id="priceMax" class="form-control numeric" placeholder="max" autocomplete="off" maxlength="5">
                            </div>
                            <div class="col-md-4 p-1">
                                <button class="btn button btn-primary priceMinMax" type="button" id="priceGoButton" disabled>GO</button>
                            </div>
                            <div class="col-md-12">
                                <p id="price_traffic_msg" class="d-none text-danger"><b>Enter valid value</b></p>
                            </div>
                        </div>

                    </div>
                </div>
            </li>


            <li class="menu-item py-2">
                <div class="px-3">
                    <label class="form-label">Domain Authority (DA)</label>
                    <div class="row rounded py-2 ms-1">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDA1" type="radio" name="da_filter" id="inputDA1" value="1-20">
                                <label class="form-check-label" for="inputDA1">1 - 20</label>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDA2" type="radio" name="da_filter" id="inputDA2" value="21-40">
                                <label class="form-check-label" for="inputDA2">21 - 40</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDA3" type="radio" name="da_filter" id="inputDA3" value="41-60">
                                <label class="form-check-label" for="inputDA3">41 - 60</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDA4" type="radio" name="da_filter" id="inputDA4" value="61-80">
                                <label class="form-check-label" for="inputDA4">61 - 80</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDA5" type="radio" name="da_filter" id="inputDA5" value="81-100">
                                <label class="form-check-label" for="inputDA5">81 - 100</label>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="menu-item py-2">
                <div class="px-3">
                    <label class="form-label">Ahrefs Traffic</label>
                    <div class="row rounded py-2 ms-1">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputAT1 " type="radio" name="ahrefs_traffic" id="inputAT1" value="1-20">
                                <label class="form-check-label" for="inputAT1">1 - 20</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputAT2 " type="radio" name="ahrefs_traffic" id="inputAT2" value="21-40">
                                <label class="form-check-label" for="inputAT2">21 - 40</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputAT3 " type="radio" name="ahrefs_traffic" id="inputAT3" value="41-60">
                                <label class="form-check-label" for="inputAT3">41 - 60</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputAT4 " type="radio" name="ahrefs_traffic" id="inputAT4" value="61-80">
                                <label class="form-check-label" for="inputAT4">61 - 80</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputAT5 " type="radio" name="ahrefs_traffic" id="inputAT5" value="81-100">
                                <label class="form-check-label" for="inputAT5">81 - 100</label>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <li class="menu-item py-2">
                <div class="px-3">
                    <label class="form-label">Semrush Traffic</label>
                    <div class="row rounded py-2 ms-1">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputST1" type="radio" name="semrush_traffic" id="inputST1" value="1-20">
                                <label class="form-check-label" for="inputST1">1 - 20</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputST2 " type="radio" name="semrush_traffic" id="inputST2" value="21-40">
                                <label class="form-check-label" for="inputST2">21 - 40</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputST3 " type="radio" name="semrush_traffic" id="inputST3" value="41-60">
                                <label class="form-check-label" for="inputST3">41 - 60</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputST4 " type="radio" name="semrush_traffic" id="inputST4" value="61-80">
                                <label class="form-check-label" for="inputST4">61 - 80</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputST5 " type="radio" name="semrush_traffic" id="inputST5" value="81-100">
                                <label class="form-check-label" for="inputST5">81 - 100</label>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="menu-item py-2">
                <div class="px-3">
                    <label class="form-label">Domain Rating</label>
                    <div class="row rounded py-2 ms-1">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDR1 " type="radio" name="domain_rating" id="inputDR1" value="1-20">
                                <label class="form-check-label" for="inputDR1">1 - 20</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDR1 domain_rating" type="radio" name="domain_rating" id="inputDR1" value="21-40">
                                <label class="form-check-label" for="inputDR1">21 - 40</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDR1 domain_rating" type="radio" name="domain_rating" id="inputDR1" value="41-60">
                                <label class="form-check-label" for="inputDR1">41 - 60</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDR1 domain_rating" type="radio" name="domain_rating" id="inputDR1" value="61-80">
                                <label class="form-check-label" for="inputDR1">61 - 80</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input rounded-circle inputDR1 domain_rating" type="radio" name="domain_rating" id="inputDR1" value="81-100">
                                <label class="form-check-label" for="inputDR1">81 - 100</label>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </form>
</aside>
<!-- / Menu -->