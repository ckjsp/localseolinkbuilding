@push('css')

@endpush
<?php 
    $page ='publisher.sidebar'; 
    if(Auth::user()->role->name === 'Advertiser') $page ='advertiser.menu';
    if(Auth::user()->role->name === 'Admin') $page ='lslbadmin.sidebar';
?>
@extends($page)
@section('sidebar-content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <div class="alert alert-primary alert-dismissible" role="alert">
        Fleet page is using Mapbox to display maps. The maps on the fleet page may not load on your localhost or
        domain because you need to add your own access token for Mapbox. <br />For more details refer to the
        <a href="https://docs.mapbox.com/mapbox-gl-js/guides/" target="_blank">Mapbox</a> section in the
        <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation//faq.html#mapbox-not-loading" class="alert-link" target="_blank">documentation</a>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> -->

    <div class="card overflow-hidden">
        <!-- Map Menu Wrapper -->
        <div class="row app-logistics-fleet-wrapper mb-5">
            <div class="alert" id="alert"></div>
            <!-- Map Menu Button when screen is < md -->
            <div class="flex-shrink-0 position-fixed m-4 d-md-none w-auto zindex-1">
                <button class="btn btn-label-white border border-2 zindex-2 p-2" data-bs-toggle="sidebar" data-overlay="" data-target="#app-logistics-fleet-sidebar">
                    <i class="ti ti-menu-2"></i>
                </button>
            </div>

            <!-- Map Menu -->
            <div class="app-logistics-fleet-sidebar col h-100" id="app-logistics-fleet-sidebar">
                <div class="card-header border-0 pt-4 pb-2 d-flex justify-content-between">
                    <h5 class="mb-0 card-title">Fleet</h5>
                    <!-- Sidebar close button -->
                    <i class="ti ti-x ti-xs cursor-pointer close-sidebar d-md-none btn btn-label-secondary p-0" data-bs-toggle="sidebar" data-overlay data-target="#app-logistics-fleet-sidebar"></i>
                </div>
                <!-- Sidebar when screen < md -->
                <div class="card-body p-2 pt-0 logistics-fleet-sidebar-body">
                    <!-- Menu Accordion -->
                    <div class="accordion" id="fleet" data-bs-toggle="sidebar" data-overlay data-target="#app-logistics-fleet-sidebar">
                        <!-- Fleet 1 -->
                        <div class="accordion-item border-0 active mb-0" id="fl-1">
                            <div class="accordion-header" id="fleetOne">
                                <div role="button" class="accordion-button shadow-none align-items-center w-75 bg-label-primary" data-bs-toggle="collapse" data-bs-target="#fleet1" aria-expanded="true" aria-controls="fleet1">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar me-2">
                                                <span class="avatar-initial rounded-circle bg-label-secondary"><i class="ti ti-truck text-body ti-sm"></i></span>
                                            </div>
                                        </div>
                                        <span class="d-flex flex-column">
                                            <span class="h6 mb-0 text-primary">{{ $order[0]->order_id }}</span>
                                            <span class="text-muted">{{ $order[0]->type }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="fleet1" class="accordion-collapse collapse show" data-bs-parent="#fleet">
                                <div class="accordion-body pt-3 pb-0">
                                    <!-- <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="mb-1">Delivery Process</h6>
                                        <p class="text-body mb-1">88%</p>
                                    </div>
                                    <div class="progress" style="height: 5px">
                                        <div class="progress-bar" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> -->
                                    <ul class="timeline ps-3 mt-4 mb-0">
                                        <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                <!-- <i class="ti ti-circle-check"></i> -->
                                                <i class="ti ti-checklist"></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-success text-uppercase fw-medium">Order Placed</small>
                                                </div>
                                                <h6 class="mb-1">{{ $order[0]->website->user->name }}</h6>
                                                <p class="text-muted mb-0">{{ date('M d, H:i A', strtotime($order[0]->created_at)) }}</p>
                                            </div>
                                        </li>
                                        @if($order[0]->status == 'in-progress' || $order[0]->status == 'approved' || $order[0]->status == 'delayed' || $order[0]->status == 'rejected' || $order[0]->status == 'complete')
                                        <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                <i class="ti ti-progress-check"></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-success text-uppercase fw-medium">In-Progress</small>
                                                </div>
                                                <h6 class="mb-1">{{ $order[0]->website->user->name }}</h6>
                                                <p class="text-muted mb-0">{{ $order[0]->website->website_url }}</p>
                                            </div>
                                        </li>
                                        @endif
                                        @if($order[0]->status == 'approved' || $order[0]->status == 'delayed' || $order[0]->status == 'complete')
                                        <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                <i class="ti ti-circle-check"></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-success text-uppercase fw-medium">Approved</small>
                                                </div>
                                                <h6 class="mb-1">{{ $order[0]->website->user->name }}</h6>
                                                <p class="text-muted mb-0">{{ $order[0]->website->website_url }}</p>
                                            </div>
                                        </li>
                                        @endif
                                        @if($order[0]->status == 'delayed')
                                        <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-warning border-0 shadow-none">
                                                <i class="ti ti-clock-exclamation"></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-warning text-uppercase fw-medium">Delayed</small>
                                                </div>
                                                <h6 class="mb-1">{{ $order[0]->website->user->name }}</h6>
                                                <p class="text-muted mb-0">{{ $order[0]->website->website_url }}</p>
                                            </div>
                                        </li>
                                        @endif
                                        @if($order[0]->status == 'rejected')
                                        <li class="timeline-item ms-1 ps-4 border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-danger border-0 shadow-none">
                                                <i class="ti ti-circle-x"></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="text-danger text-uppercase fw-medium">Rejected</small>
                                                </div>
                                                <h6 class="mb-1">{{ $order[0]->website->user->name }}</h6>
                                                <p class="text-muted mb-0">{{ $order[0]->website->website_url }}</p>
                                            </div>
                                        </li>
                                        @endif
                                        <li class="timeline-item ms-1 ps-4 border-transparent">
                                            <span class="timeline-indicator-advanced {{ ($order[0]->status == 'complete') ? 'timeline-indicator-success' : 'timeline-indicator-primary' }} border-0 shadow-none">
                                                <i class="ti ti-file-certificate mt-1"></i>
                                            </span>
                                            <div class="timeline-event ps-0 pb-0">
                                                <div class="timeline-header">
                                                    <small class="{{ ($order[0]->status == 'complete') ? 'text-success' : 'text-primary' }} text-uppercase fw-medium">published</small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mapbox Map container -->
            <div class="col h-100 map-container mb-5">
                <!-- Map -->
                <div id="map" class="h-100 w-100">
                    <h3 class="mt-5 text-center text-primary">{{ $order[0]->article_title }}</h3>
                    <div class="border w-75 m-auto mb-3"> </div>
                    <div class="order-detail-section">
                        <div class="row mb-3">
                            <div class="col-md-6"><strong class="m-2 font-bold">Website: </strong> <a href="{{ $order[0]->website->website_url }}" target="_blank" class="text-primary">{{ $order[0]->website->website_url }}</a></div>
                            @if($userDetail->role->name == 'Advertiser')
                            <div class="col-md-6"><strong class="m-2 font-bold">Current Status: </strong> {{ $order[0]->status }}</div>
                            @else
                            <div class="col-md-6">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $order[0]->id }}">
                                <strong class="m-2 font-bold">Current Status: </strong>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect statusBtnTitle" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $order[0]->status }}
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li class="dropdown-item order-status {{ $order[0]->status == 'new' ? 'active' : '' }}" data-item="new">New</li>
                                        <li class="dropdown-item order-status {{ $order[0]->status == 'in-progress' ? 'active' : '' }}" data-item="in-progress">In-Progress</li>
                                        <li class="dropdown-item order-status {{ $order[0]->status == 'delayed' ? 'active' : '' }}" data-item="delayed">Delayed</li>
                                        <li class="dropdown-item order-status {{ $order[0]->status == 'approved' ? 'active' : '' }}" data-item="approved">Approved</li>
                                        <li class="dropdown-item order-status {{ $order[0]->status == 'rejected' ? 'active' : '' }}" data-item="rejected">Rejected</li>
                                        <li class="dropdown-item order-status {{ $order[0]->status == 'complete' ? 'active' : '' }}" data-item="complete">Complete</li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"><strong class="m-2 font-bold">Article Doc: </strong> <?= !empty($order[0]->attachment) ? '<a href="' . url('/storage/app/' . $order[0]->attachment) . '" target="_blank" class="btn btn-primary">Download Docx </a>' : 'Data Not Found' ?></div>
                            <div class="col-md-6"><strong class="m-2 font-bold">Type: </strong> {{ $order[0]->type }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6"><strong class="m-2 font-bold">Quantity: </strong> {{ $order[0]->quantity }}</div>
                            <div class="col-md-6"><strong class="m-2 font-bold">Total Amount: </strong> ${{ $order[0]->price }}</div>
                        </div>
                        @if($userDetail->role->name == 'Admin')
                            <div class="row mb-3">
                                <div class="col-md-6"><strong class="m-2 font-bold">Payment Method: </strong> {{ $order[0]->payment_method }}</div>
                                <div class="col-md-6"><strong class="m-2 font-bold">Payment Status: </strong> {!! $order[0]->payment_status !!}</div>
                            </div>
                            @if(isset($order[0]->payments[0]->payment_type))
                                <div class="row mb-3">
                                    <div class="col-md-6"><strong class="m-2 font-bold">Payment Type: </strong> {{ $order[0]->payments[0]->payment_type }}</div>
                                </div>
                            @endif
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-12"><strong class="m-2 font-bold">Special Instructions: </strong> {!! $order[0]->special_instructions !!}</div>
                        </div>
                        @if($userDetail->role->name != 'Advertiser')
                            <div class="row mb-3 justify-content-center noteBox-div d-none">
                                <div class="col-md-10">
                                    <label for="noteBox" class="form-label"> Status Notes: </label>
                                    <textarea class="form-control" id="noteBox" rows="7" name="note" value="" placeholder="If you have any specific note regarding status. mention them below."></textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if($userDetail->role->name != 'Advertiser')
                <div class="map-container d-flex justify-content-end mr-5">
                    <div class="btn-group mx-5">
                        <button type="button" class="btn btn-outline-primary mx-5 orderStatus disabled" data-item="{{ $order[0]->status }}">Save Status</button>
                    </div>
                </div>
            @endif
            <!-- Overlay Hidden -->
            <div class="app-overlay d-none"></div>
        </div>
    </div>
</div>
<!--/ Content -->
@endsection

@push('script')
<script>
    $('.order-status').click(function() {
        if(!$(this).hasClass('active')){
            $this = $(this);
            $statusText = $this.text();
            $('.statusBtnTitle').text($statusText);
            $('.order-status').removeClass('active'); 
            $this.addClass('active');
            $('.orderStatus').removeClass('disabled'); 
            $('.orderStatus').data('item', $this.data('item'));
            $('.noteBox-div').removeClass('d-none');
        }
    });

    $('.orderStatus').click(function() {
        $this = $(this);
        $status = $this.data('item');
        $note = $('#noteBox').val();
        $id = $('#id').val();
        $_token = $('input[name="_token"]').val();
        if($note != ''){
            $('#noteBox').removeClass('is-invalid');
            if ($status != '') {
                $.ajax({
                    type: 'POST',
                    url: '<?= route('order.update.status',$order[0]->id) ?>',
                    data: {
                        '_token' : $_token,
                        'status' : $status,
                        'note' : $note,
                    },
                    success: function(response) {
                        var $obj = JSON.parse(response);
                        if($obj.error != ''){
                            $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>'+$obj.error+'</li></ul>');
                        }else{
                            $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>'+$obj.success+'</li></ul>');
                            setTimeout(location.reload(true) ,1000);
                        }
                        $('#noteBox-div').addClass('d-none');
                    },
                    error: function(error) {
                        // Handle errors
                        console.log(error);
                    }
                });
            }
        }else{
            $('#noteBox').addClass('is-invalid');
        }
    });
</script>
@endpush