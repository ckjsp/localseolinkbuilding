@extends('lslbadmin.sidebar')
@push('css')
@endpush
@section('sidebar-content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('My Orders') }}
                    <a href="{{ route('publisher.orders.create') }}" class="btn btn-outline-primary float-end">+ Add Order</a>
                </div>
            </div>
        </div>
    </div> -->
    @if(session('success'))
    <div class="alert alert-primary mt-3">{{ session('success') }}</div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                @if (isset($orders) && count($orders) > 0)
                @csrf
                <div class="m-3">
                    <input type="hidden" id="url" value="{{ url('order/update-status') }}">
                    <div id="alert"></div>
                    <table class="table bg-white" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">ID</th>
                                <th scope="col">Website</th>
                                <th scope="col">Article Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Type</th>
                                <!-- <th scope="col">Time Left</th> -->
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Payment Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($orders as $k => $v)
                            @php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            @endphp
                            <tr>
                                <input type="hidden" id="id" name="id" value="{{ $v->id }}">
                                <td>{{ date('d M, Y', strtotime($v->order_date)) }}</td>
                                <td><a href="{{ route('order.info', $v->order_id) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td><a href="{{ $v->website_url }}" target="_blank" title="Web Site Link ({{ $v->website_url }})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="{{ $v->website_url }}">Link <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                                <td>
                                    @if($v->attachment != '') 
                                        <a href="{{ url('/storage/app/'.$v->attachment) }}">{{ $v->article_title }}</a>
                                    @else 
                                        Data Not Found 
                                    @endif
                                </td>
                                <td>${{ $v->price }}</td>
                                <td>{{ $v->type }}</td>
                                <!-- <td>{{ date('Y-m-d h:i:s A', (strtotime($v->delivery_time) - strtotime(date('Y-m-d h:i:s A')))) }}</td> -->
                                <td>{{ $v->quantity }}</td>
                                <td>
                                    <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect statusBtnTitle{{ $v->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ucwords($v->status) }}
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'new' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="new">New</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'in-progress' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="in-progress">In-Progress</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'delayed' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="delayed">Delayed</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'delivered' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="delivered">Delivered</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'complete' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="complete">Complete</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'rejected' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="rejected">Rejected</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'approved' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="approved">Approved</li>
                                    </ul>
                                </td>
                                <td>{{ ucwords($v->payment_method) }}</td>
                                <td>{{ ucwords($v->payment_status) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-info text-center m-3">No record found!</div>
                    @endif
                </div>
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
            "columns": [
                { "width": "11%" },
                { "width": "9%" },
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
    function orderStatus($this, $id) {
        $status = $this.data('item');
        $statusText = $this.text();
        $_token = $('input[name="_token"]').val();
        $url = $('#url').val();
        if ($status != '') {
            $.ajax({
                type: 'POST',
                url: $url + '/' + $id,
                data: {
                    '_token': $_token,
                    'status': $status,
                },
                success: function(response) {
                    var $obj = JSON.parse(response);
                    if ($obj.error != '') {
                        $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                    } else {
                        $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
                        $('.orderStatus' + $id).removeClass('active');
                        $this.addClass('active');
                        $('.statusBtnTitle' + $id).text($statusText);
                    }
                },
                error: function(error) {
                    // Handle errors
                    $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error + '</li></ul>');
                    // console.log(error);
                }
            });
        }
    }
</script>
@endpush