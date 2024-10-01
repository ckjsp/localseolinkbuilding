@extends('advertiser.menu')

@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@section('sidebar-content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('My Orders') }}
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-primary mt-3">{{ session('success') }}</div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                @if (isset($orders) && count($orders) > 0)
                <div class="table-responsive m-3">
                    <table class="table" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Website</th>
                                <th scope="col">Article Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Type</th>
                                <!-- <th scope="col">Time Left</th> -->
                                <th scope="col">Quantity</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Status</th>
                                <!-- <th scope="col">Payment Type</th> -->
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($orders as $k => $v)
                            @php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            @endphp
                            <tr aria-expanded="false">
                                <td>{{ date('d M, Y',strtotime($v->order_date)) }}</td>
                                <td><a href="{{ route('order.info', $v->order_id) }}" title="{{ $v->order_id }}">{{($v->order_id) }}</a></td>
                                <td><a href="{{ $v->website->website_url }}" target="_blank" title="Web Site Link ({{ $v->website->website_url }})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="{{ $v->website->website_url }}">Link <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                                <td>
                                    @if($v->attachment != '')
                                    <a href="{{ url('/storage/app/'.$v->attachment) }}" target="_blank" title="Attachment Link">{{ $v->article_title }}</a>
                                    @else
                                    Data Not Found
                                    @endif
                                </td>
                                <td>${{ $v->price }}</td>
                                <td>{{ $v->type }}</td>
                                <!-- <td>{{ date('Y-m-d h:i:s A', (strtotime($v->delivery_time) - strtotime(date('Y-m-d h:i:s A')))) }}</td> -->
                                <td>{{ $v->quantity }}</td>
                                <td>{{ ucwords($v->payment_status) }}</td>
                                <td>{{ ucwords($v->status) }}</td>
                                <!-- <td>{{ ucwords($v->payment_method) }}</td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-info text-center m-3">No record found!</div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Delete Record') }}</h3>
                </div>
                <p class="text-wrap">{{ __("Are you sure you wan't to delete this record!") }}</p>
                <div class="col-12 text-center">
                    <button type="submit" data-href="" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light delete-yes-btn" onclick="window.location.href = $(this).attr('data-href')">{{ __('Yes') }}</button>
                    <button type="reset" class="btn btn-label-secondary btn-reset waves-effect" onclick="$('#delete-yes-btn').data('href','');" data-bs-dismiss="modal" aria-label="Close">{{ __('No')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    var table = $('#order-tbl').DataTable({
        "columns": [{
                "width": "11%"
            },
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
        ]
    });
</script>
<script src="{{
        asset_url('libs/bootstrap-select/bootstrap-select.js')
        }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>

@endpush