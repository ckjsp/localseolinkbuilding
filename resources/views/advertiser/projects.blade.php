@extends('advertiser.menu')
<<<<<<< HEAD
@push('css')
    <link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
@endpush
@section('sidebar-content')
<div class="container-xxl flex-grow-1 container-p-y">
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

    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
=======

@section('content')
    <div class="container">
        <h1>Project Details</h1>
        <div class="card">
            <div class="card-header">
                Project Information
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $project->project_name }}</h5>
                <p class="card-text">URL: {{ $project->project_url }}</p>
                <p class="card-text">Categories: {{ $project->categories }}</p>
                <p class="card-text">Forbidden Categories: {{ $project->forbidden_category }}</p>
                <p class="card-text">Additional Note: {{ $project->additional_note }}</p>
            </div>
        </div>
    </div>
>>>>>>> google-sign-in
@endsection