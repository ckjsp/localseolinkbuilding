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
                @if (isset($withdrawals) && count($withdrawals) > 0)
                @csrf
                <div class="m-3">
                    <input type="hidden" id="url" value="{{ url('order/update-status') }}">
                    <div id="alert"></div>
                    <table class="table bg-white" id="order-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Publisher email</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Email/UPI</th>
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
                                <td>{{ $withdrawal->payment_email }}</td>
                                <td>{{ $withdrawal->status }}</td>
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
@endpush