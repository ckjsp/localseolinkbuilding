@extends('advertiser.menu')

@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
@endpush

@section('sidebar-content')
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
                <div class="table-responsive">
                    <table class="table" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Website</th>
                                <th scope="col">Article Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Status</th>
                                <th scope="col">Orders Status</th>
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
                                <td><a href="{{ $v->website->website_url }}" target="_blank" title="Web Site Link ({{ $v->website->website_url }})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="{{ $v->website->website_url }}">{{ $v->website->website_url }}</a></td>
                                <td>
                                    @if($v->attachment != '')
                                    @php
                                    // Assuming $v->article_title is an array or a comma-separated string
                                    $titles = is_array($v->article_title) ? implode(", ", $v->article_title) : $v->article_title;
                                    @endphp

                                    <a href="{{ url('/storage/app/'.$v->attachment) }}" target="_blank" title="Attachment Link">{{ $titles }}</a>
                                    @else
                                    Data Not Found
                                    @endif
                                </td>
                                <td>${{ $v->price }}</td>
                                <td>{{ $v->attachment_type }}</td>
                                <td>{{ $v->quantity }}</td>
                                <td>{{ ucwords($v->payment_status) }}</td>
                                <td>{{ ucwords($v->status) }}</td>
                                <td>
                                    <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect statusBtnTitle{{ $v->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ucwords($v->advertiser_status) }}
                                    </button>
                                    @if($v->status == 'complete')

                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->advertiser_status == 'new' ? 'active' : '' }}" onclick="updateOrderStatus({{ $v->id }}, 'new')">New</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->advertiser_status == 'complete' ? 'active' : '' }}" onclick="updateOrderStatus({{ $v->id }}, 'complete')">Complete</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->advertiser_status == 'change' ? 'active' : '' }}" onclick="showChangeModal({{ $v->id }})">Change</li>
                                    </ul>
                                    @endif
                                </td>
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

<!-- Modal for Change Status -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changeStatusForm">
                    <div class="mb-3">
                        <label for="changeReason" class="form-label">Change</label>
                        <textarea class="form-control" id="changeReason" name="reason" rows="3" required></textarea>
                    </div>
                    <input type="hidden" id="orderId" name="order_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitChange()">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function updateOrderStatus(orderId, status) {
        if (status !== 'change') {
            $.ajax({
                url: "{{ route('update.order.status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: orderId,
                    status: status,
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Error updating status.');
                    }
                }
            });
        }
    }

    function showChangeModal(orderId) {
        $('#orderId').val(orderId);
        $('#changeStatusModal').modal('show');
    }

    function submitChange() {
        const reason = $('#changeReason').val();
        const orderId = $('#orderId').val();

        if (reason.trim() === '') {
            alert('Reason is required.');
            return;
        }

        $.ajax({
            url: "{{ route('update.order.status') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: orderId,
                status: 'change',
                reason: reason,
            },
            success: function(response) {
                if (response.success) {
                    $('#changeStatusModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error updating status.');
                }
            }
        });
    }
</script>
<script>
    var table = $('#order-tbl').DataTable({
        "columns": [{
                "width": "11%"
            },
            null, // Column 2 (Order ID)
            null, // Column 3 (Website)
            null, // Column 4 (Article Title)
            null, // Column 5 (Price)
            null, // Column 6 (Type)
            null, // Column 7 (Quantity)
            null, // Column 8 (Payment Status)
            null, // Column 9 (Status)
            null
        ]
    });
</script>
<script src="{{
        asset_url('libs/bootstrap-select/bootstrap-select.js')
        }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>

@endpush