@extends('advertiser.menu')

@section('sidebar-content')

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
        <h5 class="card-title">{{ $project->project_name }}</h5>
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
</div>
@include('advertiser.partials.createprojectmodal')
<script>
    //import Shepherd from "shepherd.js";
    //import "shepherd.js/dist/css/shepherd.css";

    // Initialize Shepherd
    const tour = new Shepherd.Tour({
        defaults: {
            classes: "shepherd-theme-arrows",
        },
    });

    // Add steps to the tour
    tour.addStep("projects-menu-step", {
        title: "Projects Menu",
        text: "This is the Projects menu.",
        attachTo: { element: "#projects-menu-item", on: "right" },
        buttons: [
            {
                text: "Next",
                action: tour.next,
            },
        ],
    });

    tour.addStep("step-2", {
        text: "This is the second step!",
        attachTo: {
            element: ".step-2-element",
            on: "right",
        },
        buttons: [
            {
                text: "Back",
                action: tour.back,
            },
            {
                text: "Next",
                action: tour.next,
            },
        ],
    });

    tour.addStep("step-3", {
        text: "This is the third step!",
        attachTo: {
            element: ".step-3-element",
            on: "left",
        },
        buttons: [
            {
                text: "Back",
                action: tour.back,
            },
            {
                text: "Next",
                action: tour.next,
            },
        ],
    });

    tour.addStep("step-4", {
        text: "This is the fourth step!",
        attachTo: {
            element: ".step-4-element",
            on: "top",
        },
        buttons: [
            {
                text: "Back",
                action: tour.back,
            },
            {
                text: "Finish",
                action: tour.complete,
            },
        ],
    });

    // Start the tour on button click
    document.getElementById("start-tour").addEventListener("click", () => {
        tour.start();
    });
</script>
@endsection