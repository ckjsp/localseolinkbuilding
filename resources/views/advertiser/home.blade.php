@extends('advertiser.menu')

@section('sidebar-content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <div class="col-lg-3 col-sm-6 mb-4">
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

        <!-- <div class="col-lg-3 col-sm-6 mb-4">
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
        </div> -->

        <!-- <div class="col-lg-3 col-sm-6 mb-4">
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
        </div> -->

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