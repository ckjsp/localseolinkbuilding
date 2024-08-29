<div class="modal fade" id="add-projects-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Edit User Detail') }}</h3>
                </div>
                <form method="POST" action="{{ route('advertiser.projects.store') }}" class="needs-validation"
                    id="project-form" novalidate>
                    <input type="hidden" id="project_id" name="project_id" value="">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="project_name">Project Name<span style="color: red;">*</span></label>
                        <input type="text" name="project_name" id="project_name" class="form-control" required value=""
                            placeholder="Enter Project Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="project_url">Project URL<span style="color: red;">*</span></label>
                        <input type="text" name="project_url" id="project_url" class="form-control" required value=""
                            placeholder="Enter Project URLa">
                    </div>
                    <div class="form-group mb-3 col-12 row">
                        <label for="" class="">Categories<span style="color: red;">*</span></label>
                        <div class="col-md-6 mb-4">
                            <div class="select2-primary">
                                <select id="projectCategories" name="projectCategories[]" class="select2" multiple=""
                                    data-select2-id="select2Multiple" tabindex="-1" aria-hidden="true">
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Animals & Pets">Animals & Pets</option>
                                    <option value="Arms and ammunition">Arms and ammunition</option>
                                    <option value="Arts & Entertainment">Arts & Entertainment</option>
                                    <option value="Automobiles">Automobiles</option>
                                    <option value="Beauty">Beauty</option>
                                    <option value="Blogging">Blogging</option>
                                    <option value="Business">Business </option>
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
                        <div class="col-md-6 mb-4">
                            <div class="select2-primary">
                                <select id="projectForbiddenCategories" name="projectForbiddenCategories[]"
                                    class="select2" multiple="" data-select2-id="select2Multiple" tabindex="-1"
                                    aria-hidden="true">
                                    <option value="Casino">Casino</option>
                                    <option value="CBD/Marijuana">CBD/Marijuana</option>
                                    <option value="Cryptocurrency">Cryptocurrency</option>
                                    <option value="Vape">Vape</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="additional_note">Additional Note</label>
                        <textarea name="additional_note" id="additional_note" class="form-control"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit"
                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
                        <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script src="{{ asset_url('js/projects.js') }}"></script>