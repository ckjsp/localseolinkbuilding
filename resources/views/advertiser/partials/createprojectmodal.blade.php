<div class="modal fade" id="add-projects-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Edit User Detail') }}</h3>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        <ul class="m-auto">
                            <li>{{ session('error') }}</li>
                        </ul>
                    </div>
                @endif
                <!-- <form method="POST" action="{{ route('advertiser.projects.store') }}" class="needs-validation"
                    id="project-form" novalidate enctype="multipart/form-data"> -->
                <form class="row g-3"
                    action="{{ (isset($project) && !empty($project)) ? route('advertiser.projects.update', $project->id) : route('advertiser.projects.store') }}"
                    method="POST" id="project-form" enctype="multipart/form-data"></form>
                <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="project_name">Project Name</label>
                    <input type="text" name="project_name" id="project_name" class="form-control" required
                        value="{{ $project->project_name ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="project_url">Project URL</label>
                    <input type="text" name="project_url" id="project_url" class="form-control" required
                        value="{{ $project->project_url ?? '' }}">
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
                    <input type="hidden" id="projectCategory" name="project_categories"
                        value="{{ (isset($categories) && !empty($categories)) ? $categories : '' }}">
                    <label for="projectCategories" class="form-label">Categories</label>
                    <div class="select2-primary">
                        <select id="projectCategories" name="projectCategories" class="form-select select2" multiple>
                            <option value="Agriculture" {{ (in_array("Agriculture", $Carr)) ? 'selected' : '' }}>
                                Agriculture</option>
                            <option value="Animals & Pets" {{ (in_array("Animals & Pets", $Carr)) ? 'selected' : '' }}>
                                Animals & Pets</option>
                            <option value="Arms and ammunition" {{ (in_array("Arms and ammunition", $Carr)) ? 'selected' : '' }}>Arms and ammunition</option>
                            <option value="Arts & Entertainment" {{ (in_array("Arts & Entertainment", $Carr)) ? 'selected' : '' }}>Arts & Entertainment</option>
                            <option value="Automobiles" {{ (in_array("Automobiles", $Carr)) ? 'selected' : '' }}>
                                Automobiles</option>
                            <option value="Beauty" {{ (in_array("Beauty", $Carr)) ? 'selected' : '' }}>Beauty</option>
                            <option value="Blogging" {{ (in_array("Blogging", $Carr)) ? 'selected' : '' }}>Blogging
                            </option>
                            <option value="Business" {{ (in_array("Business", $Carr)) ? 'selected' : '' }}>Business
                            </option>
                            <option value="Career & Employment" {{ (in_array("Career & Employment", $Carr)) ? 'selected' : '' }}>Career & Employment</option>
                            <option value="Computer & Electronics" {{ (in_array("Computer & Electronics", $Carr)) ? 'selected' : '' }}>Computer & Electronics</option>
                            <option value="Coupons Offers & Cashback" {{ (in_array("Coupons Offers & Cashback", $Carr)) ? 'selected' : '' }}>Coupons Offers & Cashback</option>
                            <option value="Digital Marketing" {{ (in_array("Digital Marketing", $Carr)) ? 'selected' : '' }}>Digital Marketing</option>
                            <option value="Education" {{ (in_array("Education", $Carr)) ? 'selected' : '' }}>Education
                            </option>
                            <option value="Environment" {{ (in_array("Environment", $Carr)) ? 'selected' : '' }}>
                                Environment</option>
                            <option value="Family" {{ (in_array("Family", $Carr)) ? 'selected' : '' }}>Family</option>
                            <option value="Fashion & Lifestyle" {{ (in_array("Fashion & Lifestyle", $Carr)) ? 'selected' : '' }}>Fashion & Lifestyle</option>
                            <option value="Finance" {{ (in_array("Finance", $Carr)) ? 'selected' : '' }}>Finance
                            </option>
                            <option value="Food & Drink" {{ (in_array("Food & Drink", $Carr)) ? 'selected' : '' }}>Food
                                & Drink</option>
                            <option value="Games" {{ (in_array("Games", $Carr)) ? 'selected' : '' }}>Games</option>
                            <option value="General" {{ (in_array("General", $Carr)) ? 'selected' : '' }}>General
                            </option>
                            <option value="Gift" {{ (in_array("Gift", $Carr)) ? 'selected' : '' }}>Gift</option>
                            <option value="Health & Fitness" {{ (in_array("Health & Fitness", $Carr)) ? 'selected' : '' }}>Health & Fitness</option>
                            <option value="Home & Garden" {{ (in_array("Home & Garden", $Carr)) ? 'selected' : '' }}>
                                Home & Garden</option>
                            <option value="Humor" {{ (in_array("Humor", $Carr)) ? 'selected' : '' }}>Humor</option>
                            <ption value="Internet & Telecom" {{ (in_array("Internet & Telecom", $Carr)) ? 'selected' : '' }}>Internet & Telecom</ption>
                            <option value="Law & Government" {{ (in_array("Law & Government", $Carr)) ? 'selected' : '' }}>Law & Government</option>
                            <option value="Leisure & Hobbies" {{ (in_array("Leisure & Hobbies", $Carr)) ? 'selected' : '' }}>Leisure & Hobbies</option>
                            <option value="Magazine" {{ (in_array("Magazine", $Carr)) ? 'selected' : '' }}>Magazine
                            </option>
                            <option value="Manufacturing" {{ (in_array("Manufacturing", $Carr)) ? 'selected' : '' }}>
                                Manufacturing</option>
                            <option value="Marketing & Advertising" {{ (in_array("Marketing & Advertising", $Carr)) ? 'selected' : '' }}>Marketing & Advertising</option>
                            <option value="Music" {{ (in_array("Music", $Carr)) ? 'selected' : '' }}>Music</option>
                            <option value="News & Media" {{ (in_array("News & Media", $Carr)) ? 'selected' : '' }}>News
                                & Media</option>
                            <option value="Photography" {{ (in_array("Photography", $Carr)) ? 'selected' : '' }}>
                                Photography</option>
                            <option value="Politics" {{ (in_array("Politics", $Carr)) ? 'selected' : '' }}>Politics
                            </option>
                            <option value="Quotes" {{ (in_array("Quotes", $Carr)) ? 'selected' : '' }}>Quotes</option>
                            <option value="Real estate" {{ (in_array("Real estate", $Carr)) ? 'selected' : '' }}>Real
                                estate</option>
                            <option value="Region" {{ (in_array("Region", $Carr)) ? 'selected' : '' }}>Region</option>
                            <option value="Reviews" {{ (in_array("Reviews", $Carr)) ? 'selected' : '' }}>Reviews
                            </option>
                            <option value="Science" {{ (in_array("Science", $Carr)) ? 'selected' : '' }}>Science
                            </option>
                            <option value="Shopping" {{ (in_array("Shopping", $Carr)) ? 'selected' : '' }}>Shopping
                            </option>
                            <option value="Spanish" {{ (in_array("Spanish", $Carr)) ? 'selected' : '' }}>Spanish
                            </option>
                            <option value="Sports" {{ (in_array("Sports", $Carr)) ? 'selected' : '' }}>Sports</option>
                            <option value="Sprituality" {{ (in_array("Sprituality", $Carr)) ? 'selected' : '' }}>
                                Sprituality</option>
                            <option value="Technology" {{ (in_array("Technology", $Carr)) ? 'selected' : '' }}>
                                Technology</option>
                            <option value="Travelling" {{ (in_array("Travelling", $Carr)) ? 'selected' : '' }}>
                                Travelling</option>
                            <option value="Web development" {{ (in_array("Web development", $Carr)) ? 'selected' : '' }}>Web development</option>
                            <option value="Wedding" {{ (in_array("Wedding", $Carr)) ? 'selected' : '' }}>Wedding
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    @php
                        if (old('forbidden_categories')) {
                            $forbidden_categories = old('forbidden_categories');
                        } else {
                            isset($website->forbidden_categories) ? $forbidden_categories = $website->forbidden_categories :
                                '';
                        }
                        $FCarr = array();
                        if (isset($forbidden_categories) && !empty($forbidden_categories))
                            $FCarr =
                                explode(',', $forbidden_categories);
                    @endphp
                    <input type="hidden" id="projectForbiddenCategory" name="project_forbidden_categories"
                        value="{{ (isset($forbidden_categories) && !empty($forbidden_categories)) ? $forbidden_categories : '' }}">
                    <label for="projectForbiddenCategories" class="form-label">Select the forbidden categories you
                        accept</label>
                    <div class="select2-info">
                        <select id="projectForbiddenCategories" name="projectForbiddenCategories"
                            class="select2 form-select" multiple>
                            <option value="Casino" {{ (in_array("Casino", $FCarr)) ? 'selected' : '' }}>Casino
                            </option>
                            <option value="CBD/Marijuana" {{ (in_array("CBD/Marijuana", $FCarr)) ? 'selected' : ''
                                    }}>CBD/Marijuana</option>
                            <option value="Cryptocurrency" {{ (in_array("Cryptocurrency", $FCarr)) ? 'selected' : ''
                                    }}>Cryptocurrency</option>
                            <option value="Vape" {{ (in_array("Vape", $FCarr)) ? 'selected' : '' }}>Vape</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="additional_note">Additional Note</label>
                    <textarea name="additional_note" id="additional_note"
                        class="form-control">{{ $project->additional_note ?? '' }}</textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
                    <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>