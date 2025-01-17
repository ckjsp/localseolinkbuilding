@extends(Auth::user()->role->name === 'Advertiser' ? 'advertiser.menu' : 'publisher.sidebar')
@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
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
                @if (isset($payments) && count($payments) > 0)
                <div class="card-datatable table-responsive pt-0">
                    @if($userDetail->role->name == 'Advertiser')
                    <table class="datatables-basic table" id="payment-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order Date</th>
                                <th scope="col">View Order</th>
                                <th scope="col">Transaction Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Transaction Method</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $num = 1; ?>
                            @foreach($payments as $k => $v)
                            <tr>
                                <td>{{ date('d M, Y',strtotime($v->order_date)) }}</td>
                                <td><a href="{{ route('order.info', $v->o_id) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td>{{ $v->payment_type }}</td>
                                <td>${{ $v->payment_amount }}</td>
                                <td>{{ $v->payment_method }}</td>
                                <td>{{ date('d M, Y', strtotime($v->created_at)) }}</td>
                                <td>{{ ucwords($v->payment_status) }}</td>
                            </tr>
                            <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <table class="datatables-basic table" id="payment-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">View Order</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Transaction Date</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $num = 1; ?>
                            @foreach($payments as $k => $v)
                            <tr>
                                <td>{{ $num }}</td>
                                <td><a href="{{ route('order.info', $v->o_id) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="View Order Detail">Order <i class="fa-regular fa-eye"></i></a></td>
                                <td>{{ $v->payment_id }}</td>
                                <td>${{ $v->payment_amount }}</td>
                                <td>{{ date('d M, Y', strtotime($v->created_at)) }}</td>
                                <td>{{ ucwords($v->payment_status) }}</td>
                            </tr>
                            <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                @else
                <div class="alert alert-info text-center m-3">No record found!</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    var table = $('#payment-tbl').DataTable();
</script>
<script src="{{
        asset_url('libs/bootstrap-select/bootstrap-select.js')
        }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>
@endpush