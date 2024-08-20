@extends('advertiser.menu')

@section('sidebar-content')
@push('css')
    <link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/toastr/toastr.css') }}">

@endpush
<link rel="stylesheet" href="{{ asset_url('libs/shepherd/shepherd.css') }}" />
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y pt-5 mt-5">
    <div class="row mb-5">

        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <a href="{{ url('/advertiser/orders') }}"><span
                                    class="avatar-initial rounded bg-label-primary"><i
                                        class="ti ti-truck ti-md"></i></span></a>
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
                            <span class="avatar-initial rounded bg-label-warning"><i
                                    class="ti ti-alert-triangle ti-md"></i></span>
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
                            <span class="avatar-initial rounded bg-label-danger"><i
                                    class="ti ti-git-fork ti-md"></i></span>
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
    @if($projects->isEmpty())
        <div class="row text-center justify-content-center">
            <img src="{{ asset('img/pages/add-folder.png') }}" style="max-width: 170px;margin: 0 auto;">
            <h5>Unlock High-Quality Backlinks and Boost<br /> Traffic with a New Project</h5>
            <p>Reach engaged audiences, build brand awareness, and drive conversions</br> through strategic guest posting
                campaigns.</p>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn"
                class="btn btn-primary w-auto">+Add Projects
            </a>
        </div>
    @else
        <div class="d-flex justify-content-between my-3">
            <h5 class="card-title" id="selected-project-name">
                Select a project
            </h5>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn"
                class="btn btn-primary w-auto">+Add Projects
            </a>
            <button id="shepherd-example">Start Tour</button>
        </div>
        @foreach($projects as $project)
            <div class="row mb-3" id="project-card-{{ $project->id }}">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $project->project_name }}</h5>
                        <div class="d-flex gap-3">
                            <p class="card-text"> {{ $project->project_url }}</p>
                            <span> {{ $project->created_at }} </span>
                        </div>
                    </div>
                    <hr />
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3 border rounded p-4 pb-0 bg-light">
                                <div>
                                    <p>Total Backlinks built from LP</p>
                                    <h4>0</h4>
                                </div>
                                <div>
                                    <p>Total Paid</p>
                                    <h4>$0</h4>
                                </div>
                                <div>
                                    <p>Total Content Written</p>
                                    <h4>0</h4>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center border rounded">
                                <img src="{{ asset('img/pages/search-icon.png') }}"
                                    style="max-width: 100px;height: fit-content;">
                                <p>Data is being prepared and will be presented here once it is ready.</p>
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#" id="addcompetitorBtn"
                                    class="btn btn-primary w-auto">+Add Competitors
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @include('advertiser.partials.createprojectmodal')
</div>
<style>
    #projectCategories~.select2 .select2-search__field {
        width: 100% !important;
    }
</style>
<script src="{{ asset_url('libs/shepherd/shepherd.js') }}"></script>
<script src=" {{ asset_url('libs/toastr/toastr.js') }}"></script>
<script src="{{ asset('js/projects.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#projectCategories').select2();
        $('#projectForbiddenCategories').select2();
        $(document).on('click', '#addprojectBtn', function () {
            $('#project-form')[0].reset();
            $('input[name="project_id"]').val('');
            $('#projectCategories').val(null).trigger('change');
            $('#projectForbiddenCategories').val(null).trigger('change');
            $('#project-form').attr('action', `{{ route('advertiser.projects.store') }}`);
        });

        $(document).on('submit', '#project-form', function (e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log('response', response);
                    if (response.status == 1) {
                        var success = response.message;
                        $('#project-form').prev('.alert.alert-danger').remove();
                        $('#add-projects-pop').modal('hide');
                        loadProjectsMenu();
                        toastr.success(success, 'Success!', {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            onHidden: function () {
                                if (!localStorage.getItem('project_tour_completed')) {
                                    startProjectTour();
                                }
                            }
                        });
                    } else if (response.status == 0) {
                        var errors = response.message;
                        var errorHtml = '<div class="alert alert-danger">';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var errorMessages = errors[key];
                                errorMessages.forEach(function (message) {
                                    errorHtml += '<ul class="m-0"><li>' + message + '</li></ul>';
                                });
                            }
                        }
                        errorHtml += '</div>';
                        $('#project-form').before(errorHtml);
                        setTimeout(function () {
                            $('#project-form').prev('.alert.alert-danger').remove();
                        }, 2500);
                    }
                },
                error: function (xhr) {
                    console.log('xhr', xhr);
                    if (xhr.responseJSON) {
                        var response = xhr.responseJSON;
                        console.log('responseJSON', response);
                        if (response.status === '0') {
                            var errors = response.errors;
                            var errorHtml = '<div class="alert alert-danger">';

                            // Loop through each error and append it to the errorHtml string
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorMessages = errors[key];
                                    errorMessages.forEach(function (message) {
                                        errorHtml += '<ul class="m-0"><li>' + message + '</li></ul>';
                                    });
                                }
                            }
                            errorHtml += '</div>';
                            $('#project-form').before(errorHtml);
                            setTimeout(function () {
                                $('#project-form').prev('.alert.alert-danger').remove();
                            }, 2500);
                        } else {
                            console.log("Error: responseJSON is undefined");
                        }
                    } else {
                        console.log("Error: responseJSON is undefined");
                    }
                }
            });
        });

        function startProjectTour() {
            const tourVar = new Shepherd.Tour({
                defaultStepOptions: {
                    scrollTo: true,
                    cancelIcon: {
                        enabled: true
                    }
                },
                useModalOverlay: true
            });

            const tour = setupTour(tourVar);
            tour.on('cancel', saveTourCookie);
            tour.on('complete', saveTourCookie);

            tour.start();
        }

        function setupTour(tour) {
            const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat',
                nextBtnClass = 'btn btn-sm btn-primary btn-next';
            tour.addStep({
                title: 'Navbar',
                text: "Add Projects to check Which orders belong to </br>which client, stay organized, and effortlessly </br> keep track of progress and spending. It's straightforward!",
                attachTo: { element: '#hover-dropdown-demo', on: 'bottom' },
                buttons: [
                    {
                        action: tour.cancel,
                        classes: backBtnClass,
                        text: 'Skip'
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next,
                    }
                ]
            });
            tour.addStep({
                title: 'Card',
                text: 'This is a card',
                attachTo: { element: '.project-list', on: 'top' },
                beforeShowPromise: function () {
                    return new Promise(function (resolve) {
                        const projectList = document.querySelector('.project-list');
                        if (projectList) {
                            projectList.style.display = 'block';
                        }
                        resolve();
                    });
                },
                buttons: [
                    {
                        text: 'Skip',
                        classes: backBtnClass,
                        action: tour.cancel
                    },
                    {
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next
                    }
                ]
            });
            tour.addStep({
                title: 'Footer',
                text: 'This is the Footer',
                attachTo: { element: '.footer', on: 'top' },
                buttons: [
                    {
                        text: 'Skip',
                        classes: backBtnClass,
                        action: tour.cancel
                    },
                    {
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Next',
                        classes: nextBtnClass,
                        action: tour.next
                    }
                ]
            });
            tour.addStep({
                title: 'About US',
                text: 'Click here to learn about us',
                attachTo: { element: '.footer-link', on: 'top' },
                buttons: [
                    {
                        text: 'Back',
                        classes: backBtnClass,
                        action: tour.back
                    },
                    {
                        text: 'Finish',
                        classes: nextBtnClass,
                        action: tour.cancel
                    }
                ]
            });

            return tour;
        }

        function saveTourCookie() {
            localStorage.setItem('project_tour_completed', 'true');
            window.location.reload();
        }

        $('#add-projects-pop').on('show.bs.modal', function () {
            $('#project-form').find('.invalid-feedback').remove();
            $('#project-form').find('.is-invalid').removeClass('is-invalid');
        });
    });
</script>

@endsection
@push('script')
    <script src="{{ asset_url('libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset_url('libs/select2/select2.js') }}"></script>
    <script src="{{ asset_url('js/forms-selects.js') }}"></script>
@endpush