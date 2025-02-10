@extends('publisher.sidebar')

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
                <input type="hidden" id="url" value="{{ url('order/update-status') }}">
                <div id="alert"></div>
                <div class="card-datatable overflow-x-auto pt-0 table-responsive">
                    <table class="datatables-basic table table-responsive" id="orderTbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">View order</th>
                                <th scope="col">Website</th>
                                <th scope="col">Order Type</th>
                                <th scope="col">Price</th>

                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($orders as $k => $v)
                            @php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            @endphp
                            <!-- data-bs-toggle="collapse" data-bs-target="#order-{{$k}}" aria-controls="order-{{$k}}" aria-expanded="false" -->
                            <tr>
                                <input type="hidden" id="id" name="id" value="{{ $v->id }}">
                                <td>{{ date('d M, Y', strtotime($v->order_date)) }}</td>
                                <td><a href="{{ route('order.info', $v->order_id) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td><a href="{{ $v->website_url }}" target="_blank" title="Web Site Link ({{ $v->website_url }})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="{{ $v->website_url }}">Link <i class="fa-solid fa-arrow-up-right-from-square"></i></a></td>
                                <td>
                                    @if ($v->attachment_type === 'provide_content')
                                    Blog Post
                                    @else
                                    Link Insertion
                                    @endif
                                </td>

                                <td>
                                    @if($v->attachment_type == 'provide_content')
                                    ${{ number_format($v->guest_post_price * $v->quantity, 2) }}
                                    @elseif($v->attachment_type == 'link_insertion')
                                    ${{ number_format($v->link_insertion_price * $v->quantity, 2) }}
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $v->quantity }}</td>

                                <td>
                                    <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect statusBtnTitle{{ $v->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ucwords($v->status) }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'new' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="new">New</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'in-progress' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="in-progress">In-Progress</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'delayed' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="delayed">Delayed</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'delivered' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="delivered">Delivered</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'complete' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="complete">Complete</li>
                                        <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'rejected' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="rejected">Rejected</li>
                                        <!-- <li class="dropdown-item orderStatus{{ $v->id }} {{ $v->status == 'approved' ? 'active' : '' }}" onclick="orderStatus($(this), <?= $v->id ?>)" data-item="approved">Approved</li> -->
                                    </ul>
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


<!-- Rejection Reason Modal -->
<div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionModalLabel">Rejection Reason</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="rejectionForm">
                    <input type="hidden" id="orderId" name="orderId">
                    <input type="hidden" id="status" name="status">
                    <div class="mb-3">
                        <label for="rejectionReason" class="form-label">Reason for Rejection</label>
                        <textarea class="form-control" id="rejectionReason" name="rejectionReason" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Completion URL Modal -->
<div class="modal fade" id="completionModal" tabindex="-1" aria-labelledby="completionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="completionModalLabel">Complete Url</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="completionForm">
                    <input type="hidden" id="orderIdComplete" name="orderIdComplete">
                    <input type="hidden" id="statusComplete" name="statusComplete">
                    <div class="mb-3">
                        <label for="completionUrl" class="form-label">Complete URL</label>
                        <input type="url" class="form-control" id="completionUrl" name="completionUrl" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@push('script')

<script>
    document.getElementById('rejectionForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const rejectionModal = document.getElementById('rejectionModal');
        const bootstrapModal = bootstrap.Modal.getInstance(rejectionModal);
        bootstrapModal.hide();
    });

    document.getElementById('rejectionModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('rejectionForm').reset();
    });
</script>

<script>
    var table = $('#orderTbl').DataTable({
        "order": [
            [0, "desc"]
        ],
        "columns": [{
                "width": "11%"
            },
            null,
            null,
            null,
            null,
            null,
            null
        ]
    });


    function orderStatus($this, $id) {
        var $status = $this.data('item');
        var $statusText = $this.text();
        var $_token = $('input[name="_token"]').val();
        var $url = $('#url').val();

        if ($status === 'rejected') {
            $('#rejectionModal').modal('show');
            $('#rejectionModal #orderId').val($id);
            $('#rejectionModal #status').val($status);
        } else if ($status === 'complete') {
            $('#completionModal').modal('show');
            $('#completionModal #orderIdComplete').val($id);
            $('#completionModal #statusComplete').val($status);
        } else if ($status !== '') {
            $.ajax({
                type: 'POST',
                url: $url + '/' + $id,
                data: {
                    '_token': $_token,
                    'status': $status,
                },
                success: function(response) {
                    var $obj = JSON.parse(response);
                    if ($obj.error !== '') {
                        $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                    } else {
                        $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
                        $('.orderStatus' + $id).removeClass('active');
                        $this.addClass('active');
                        $('.statusBtnTitle' + $id).text($statusText);
                    }
                },
                error: function(error) {
                    $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error + '</li></ul>');
                }
            });
        }
    }

    // Handle Rejection Form Submission
    $('#rejectionForm').on('submit', function(e) {
        e.preventDefault();
        var $id = $('#orderId').val();
        var $status = $('#status').val();
        var $reason = $('#rejectionReason').val();
        var $_token = $('input[name="_token"]').val();
        var $url = $('#url').val();

        $.ajax({
            type: 'POST',
            url: $url + '/' + $id,
            data: {
                '_token': $_token,
                'status': $status,
                'note': $reason,
            },
            success: function(response) {
                var $obj = JSON.parse(response);
                if ($obj.error !== '') {
                    $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                } else {
                    $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
                    $('#rejectionModal').modal('hide');
                    $('.orderStatus' + $id).removeClass('active');
                    $('.statusBtnTitle' + $id).text('Rejected');
                }
            },
            error: function(error) {
                $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error.responseJSON.message + '</li></ul>');
            }
        });
    });

    // Handle Completion Form Submission
    $('#completionForm').on('submit', function(e) {
        e.preventDefault();
        var $id = $('#orderIdComplete').val();
        var $status = $('#statusComplete').val();
        var $urlValue = $('#completionUrl').val();
        var $_token = $('input[name="_token"]').val();
        var $url = $('#url').val();

        $.ajax({
            type: 'POST',
            url: $url + '/' + $id,
            data: {
                '_token': $_token,
                'status': $status,
                'url': $urlValue,
            },
            success: function(response) {
                var $obj = JSON.parse(response);
                if ($obj.error !== '') {
                    $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                } else {
                    $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
                    $('#completionModal').modal('hide');
                    $('.orderStatus' + $id).removeClass('active');
                    $('.statusBtnTitle' + $id).text('Complete');
                }
            },
            error: function(error) {
                $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error.responseJSON.message + '</li></ul>');
            }
        });
    });
</script>
@endpush