@extends('lslbadmin.sidebar')
@push('css')
@endpush
@section('sidebar-content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

    @if(session('success'))
    <div class="alert alert-primary mt-3">{{ session('success') }}</div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                @if (isset($withdrawals) && count($withdrawals) > 0)
                @csrf
                <div class="m-3">
                    <input type="hidden" id="url" value="{{ url('order/update-status') }}">
                    <div id="alert"></div>
                    <table class="table" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Publisher email</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment info</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $withdrawal->publisher->email }}</td>
                                <td>{{ $withdrawal->transaction_date }}</td>
                                <td>{{ $withdrawal->amount }}</td>
                                <td>
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">Payment type :</span>
                                        {{ $withdrawal->user->preferred_method ?? 'N/A' }}
                                    </div>
                                    @if($withdrawal->user->preferred_method == 'paypal')
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">Payment email:</span>
                                        {{ $withdrawal->payment_email }}
                                    </div>
                                    @elseif($withdrawal->user->preferred_method == 'razorpay')
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">Payment id :</span>
                                        {{ $withdrawal->payment_email }}
                                    </div>
                                    @else
                                    <div class="d-flex mb-1">
                                        <span class="fw-bolder pe-1">payment_info:</span>
                                        N/A
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-select status-dropdown" data-id="{{ $withdrawal->transaction_id }}">
                                        <option value="pending" {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ $withdrawal->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                    </select>
                                </td>

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
    $(document).ready(function() {
        $('#order-tbl').DataTable({
            "order": [
                [5, 'desc']
            ]
        });
    });
</script>
<script>
    $(document).on('change', '.status-dropdown', function() {
        const withdrawalId = $(this).data('id');
        const newStatus = $(this).val();

        $.ajax({
            url: '{{ route("updateWithdrawalStatus") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: withdrawalId,
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            }
        });
    });
</script>
@endpush