@extends(Auth::user()->role->name === 'Advertiser' ? 'advertiser.menu' : 'publisher.sidebar')

@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@section('sidebar-content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
    @endif

    <div class="row justify-content-center mt-5">
        <div class="withdraw-section text-center mt-4">
            <form action="{{ route('wallet.withdraw') }}" method="POST" id="withdrawForm">
                @csrf
                <div class="form-group mb-3">
                    <div class="row">
                        <!-- Input for UPI ID -->
                        <div class="col-2">
                            <input type="text" id="upi_id" name="upi_id" class="form-control" placeholder="Enter your UPI ID" required>
                        </div>

                        <!-- Hidden input for wallet balance -->
                        <input type="hidden" id="wallet_balance" name="wallet_balance" value="{{ $wallet_balance }}">

                        <div class="col-2">
                            <button type="submit" class="btn btn-success w-100">Withdraw</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <table class="datatables-basic table" id="payment-tbl">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Transaction Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Transaction Type</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $num = 1; ?>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $num }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ date('d M, Y', strtotime($payment->transaction_date)) }}</td>
                            <td>{{ ucwords($payment->status) }}</td>
                            <td>{{ ucwords($payment->transaction_type) }}</td>
                        </tr>
                        <?php $num++; ?>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#payment-tbl').DataTable();
</script>
<script src="{{ asset_url('libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>
@endpush