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

                <div class="form-group mb-3">
                    <label for="categories">Categories</label>
                    <select name="categories" id="categories" class="form-control" required>
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                        <option value="category3">Category 3</option>
                        <option value="category4">Category 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="forbidden_category">Forbidden Category</label>
                    <select name="forbidden_category" id="forbidden_category" class="form-control" required>
                        <option value="forbidden1">Forbidden 1</option>
                        <option value="forbidden2">Forbidden 2</option>
                        <option value="forbidden3">Forbidden 3</option>
                        <option value="forbidden4">Forbidden 4</option>
                    </select>
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