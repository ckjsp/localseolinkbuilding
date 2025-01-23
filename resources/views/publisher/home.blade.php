@extends('publisher.sidebar')

@section('sidebar-content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-4 cursor-pointer">
                            <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0 linksCard" data-href="{{ route('publisher.website') }}">
                                <div>
                                    <h4 class="mb-2">{{ $websiteCount }}</h4>
                                    <p class="mb-0 fw-medium">{{ __('Total Websites') }}</p>
                                </div>
                                <span class="avatar me-sm-4">
                                    <span class="avatar-initial bg-label-info rounded">
                                        <i class="ti ti-world ti-lg"></i>
                                    </span>
                                </span>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4">
                        </div>
                        <div class="col-sm-6 col-lg-4 cursor-pointer">
                            <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0 linksCard" data-href="{{ route('publisher.orders') }}">
                                <div>
                                    <h4 class="mb-2">{{$orderCount}}</h4>
                                    <p class="mb-0 fw-medium">{{ __('Total Orders') }}</p>
                                </div>
                                <span class="avatar p-2 me-lg-4">
                                    <span class="avatar-initial bg-label-danger rounded"><i class="ti ti-briefcase ti-sm"></i></span>
                                </span>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none">
                        </div>
                        <!-- <div class="col-sm-6 col-lg-4 cursor-pointer">
                            <div class="d-flex justify-content-between align-items-start pb-3 pb-sm-0 card-widget-3 linksCard" data-href="{{ route('publisher.sales') }}">
                                <div>
                                    <h4 class="mb-2">0</h4>
                                    <p class="mb-0 fw-medium">{{ __('Total Sales') }}</p>
                                </div>
                                <span class="avatar p-2 me-sm-4">
                                    <span class="avatar-initial bg-label-primary rounded"><i class="ti ti-chart-pie-2 ti-sm"></i></span>
                                </span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection

@push('script')
<!-- Page JS -->
<script src="{{ asset_url('js/dashboards-analytics.js') }}"></script>
<script>
    $('.linksCard').click(function() {
        window.location.href = $(this).attr('data-href');
    });
</script>
@endpush