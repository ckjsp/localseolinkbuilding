@extends('advertiser.menu')

@section('sidebar-content')
<link rel="stylesheet" href="{{ asset_url('libs/shepherd/shepherd.css') }}" />

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-3">
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
    </div>
    <div class="d-flex justify-content-between my-3">
        <h5 class="card-title">{{ $projects->project_name }}</h5>
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-projects-pop" id="addprojectBtn"
            class="btn btn-primary w-auto">+Add Projects
        </a>
    </div>
    <div class="row">
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
                        <img src="{{ asset_url('img/pages/search-icon.png') }}"
                            style="max-width: 100px;height: fit-content;">
                        <p>Data is being prepared and will be presented here once it is ready.</p>
                    </div>
                    <div class="col-md-3">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#" id="addcompetitorBtn"
                            class="btn btn-primary w-auto">+Add Competitors
                        </a>
                        <button class="btn btn-primary" id="shepherd-example">
                            Start tour
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('advertiser.partials.createprojectmodal')

<script src="{{ asset_url('libs/shepherd/shepherd.js') }}"></script>
<script>
    const startBtn = document.querySelector('#shepherd-example');

    function setupTour(tour) {
        const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat',
            nextBtnClass = 'btn btn-sm btn-primary btn-next';
        tour.addStep({
            title: 'Navbar',
            text: 'This is your navbar',
            attachTo: { element: '.navbar', on: 'bottom' },
            buttons: [
                {
                    action: tour.cancel,
                    classes: backBtnClass,
                    text: 'Skip'
                },
                {
                    text: 'Next',
                    classes: nextBtnClass,
                    action: tour.next
                }
            ]
        });
        tour.addStep({
            title: 'Card',
            text: 'This is a card',
            attachTo: { element: '.tour-card', on: 'top' },
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

    if (startBtn) {
        // On start tour button click
        startBtn.onclick = function () {
            const tourVar = new Shepherd.Tour({
                defaultStepOptions: {
                    scrollTo: false,
                    cancelIcon: {
                        enabled: true
                    }
                },
                useModalOverlay: true
            });

            setupTour(tourVar).start();
        };
    }
</script>
@endsection