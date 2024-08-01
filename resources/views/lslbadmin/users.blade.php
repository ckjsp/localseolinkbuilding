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
                    {{ __('My Website') }}
                    <a href="{{ url('/publisher/website/create') }}" class="btn btn-outline-primary float-end"><i class="ti ti-world-plus m-auto p-1"></i> Add Website</a>
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
                @if (count($users) > 0)
                <div class="table-responsive text-nowrap m-3">
                    <table class="table bg-white" id="user-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Company Website URL</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Verify</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $num = 1; @endphp
                            @foreach($users as $k => $v)
                            <tr>
                                <td>{{ $num }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->role->name }}</td>
                                <td>{{ $v->dial_code }} {{ $v->phone_number }}</td>
                                <td>{{ $v->company_website_url }}</td>
                                <td>{{ ($v->status == 1) ? 'Active' : 'Deactive' }}</td>
                                <td>
                                    <button type="button" class="btn p-0 edit-btn text-info" onclick="window.location.href=`{{ url('/lslb-admin/user') }}/{{ $v->id }}/edit`"><i class="ti ti-pencil me-1"></i></button>
                                    <button type="button" class="btn p-0 delete-btn text-danger" data-bs-toggle="modal" data-bs-target="#delete-pop" onclick="$('.delete-yes-btn').attr('data-href',`{{ url('/lslb-admin/user') }}/{{ $v->id }}/delete`);"><i class="ti ti-trash me-1"></i></button>
                                </td>
                                <td class="p-0 text-center">{!! !empty($v->email_verified_at) && $v->email_verified_at != null ?  '<i class="tf-icons ti ti-clock-check text-info"></i>' : '<i class="tf-icons ti ti-clock-cog text-danger"></i>' !!}</td>
                            </tr>
                            @php $num++; @endphp
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
        var table = $('#user-tbl').DataTable();
    </script>
@endpush