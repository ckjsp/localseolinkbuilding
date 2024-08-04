@extends('advertiser.menu')

@section('sidebar-content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <a href="{{ url('/advertiser/orders') }}"><span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span></a>
                        </div>
                        <h4 class="ms-1 mb-0">{{$orderCount}}</h4>
                    </div>
                    <p class="mb-1">Total Orders</p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">{{$successOrderCount}}</span>
                        <small class="text-muted">Completed Orders</small>
                    </p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">{{$pendingOrderCount}}</span>
                        <small class="text-muted">Pending Orders</small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-alert-triangle ti-md"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">$0</h4>
                    </div>
                    <p class="mb-1">Total Funds Added</p>
                </div>
            </div>
        </div>
         
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-git-fork ti-md"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">Total Content Writing</p>
                </div>
            </div>
        </div>
        
        <!-- <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i class="ti ti-clock ti-md"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">13</h4>
                    </div>
                    <p class="mb-1">Late vehicles</p>
                    <p class="mb-0">
                        <span class="fw-medium me-1">-2.5%</span>
                        <small class="text-muted">than last week</small>
                    </p>
                </div>
            </div>
        </div> -->

    </div>
    <div class="row text-center">
        <img src="{{ asset('img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;">
        <h5>Unlock High-Quality Backlinks and Boost<br/> Traffic with a New Project</h5>
        <p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest posting campaigns.</p>
        <a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#add-projects-pop" id="addprojectBtn"
                                    class="btn btn-primary">+Add Profile
                                </a>
    </div>
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
                    <form method="POST" action="{{ route('advertiser.projects.store') }}" class="needs-validation"
                        id="user-update-form" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="project_name">Project Name</label>
                            <input type="text" name="project_name" id="project_name" class="form-control" required>
                        </div>
            
                        <div class="form-group">
                            <label for="project_url">Project URL</label>
                            <input type="text" name="project_url" id="project_url" class="form-control" required>
                        </div>
            
                        <div class="form-group">
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
</div>
<!--/ Content -->

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Advertiser Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection