@extends('lslbadmin.sidebar')
@push('css')
@endpush
@section('sidebar-content')
<!-- Content -->
<div class="mx-3 flex-grow-1 container-p-y">
    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('My Website') }}
                    <a href="{{ url('/publisher/website/create') }}" class="btn btn-outline-primary float-end"><i
                            class="ti ti-world-plus m-auto p-1"></i> Add Website</a>
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
                @if (count($websites) > 0)
                @csrf
                <input type="hidden" id="url" value="{{ url('lslb-admin/website-status-update') }}">
                <div id="alert"></div>
                <div class="m-3 table-responsive">
                    <table class="table" id="website-tbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Website URL</th>
                                <th scope="col"><span data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="tooltip-secondary"
                                        data-bs-original-title="Domain Authority">DA</span></th>
                                <th scope="col"><span data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="tooltip-secondary"
                                        data-bs-original-title="Page Authority">PA</span></th>
                                <th scope="col">Ahrefs Traffic</th>
                                <th scope="col">Semrush Traffic</th>
                                <!--<th scope="col">Google Analytics</th>-->
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Google Analytics</th>
                                <th scope="col">Action</th>
                                <th scope="col"><i class="ti ti-dots"></i></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($websites as $k => $v)
                            @php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            @endphp
                            <tr class="table-body">
                                <td>{{ $v->website_url }}</td>
                                <td>{{ $v->domain_authority }}</td>
                                <td>{{ $v->page_authority }}</td>
                                <td>{{ $v->ahrefs_traffic }}</td>
                                <td>{{ $v->samrush_traffic }}</td>
                                <!--<td>{{ $v->google_analytics }}</td>-->
                                <td>${{ $v->guest_post_price }}</td>
                                <td>
                                    <button type="button"
                                        class="btn btn-label-primary dropdown-toggle waves-effect statusBtnTitle{{ $v->id }}"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ ucwords($v->status) }}
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li class="dropdown-item webStatus{{ $v->id }} {{ $v->status == 'pending' ? 'active' : '' }}" onclick="webStatus($(this), <?= $v->id ?>)" data-item="pending">Pending</li>
                                        <li class="dropdown-item webStatus{{ $v->id }} {{ $v->status == 'in-review' ? 'active' : '' }}" onclick="webStatus($(this), <?= $v->id ?>)" data-item="in-review">In Review</li>
                                        <li class="dropdown-item webStatus{{ $v->id }} {{ $v->status == 'approve' ? 'active' : '' }}" onclick="webStatus($(this), <?= $v->id ?>)" data-item="approve">Approve</li>
                                        <li class="dropdown-item webStatus{{ $v->id }} {{ $v->status == 'rejected' ? 'active' : '' }}" onclick="webStatus($(this), <?= $v->id ?>)" data-item="rejected">Rejected</li>
                                    </ul>
                                </td>
                                <td class="p-0 text-center">
                                    @if($v->site_verification_file != '')
                                    <a href="{{ url('/storage/app/'.$v->site_verification_file) }}" target="_blank"><i
                                            class="tf-icons ti ti-clock-cog"></i></a>
                                    @else
                                    <i class="tf-icons ti ti-clock-x text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn p-0 edit-btn text-info"
                                        onclick="window.location.href=`{{ url('/lslb-admin/website') }}/{{ $v->id }}/edit`"><i
                                            class="ti ti-pencil me-1"></i></button>
                                    <button type="button" class="btn p-0 delete-btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-pop"
                                        onclick="$('.delete-yes-btn').attr('data-href',`{{ url('/lslb-admin/website') }}/{{ $v->id }}/delete`);"><i
                                            class="ti ti-trash me-1"></i></button>
                                </td>
                                <td> <button type="button" class="btn p-0 edit-btn text-dark"
                                        onclick="getSiteDetail($(this))"
                                        data-i="<?= htmlspecialchars(json_encode($v)) ?>"><i
                                            class="ti ti-file-dots fs-3"></i></button> </td>
                                <!-- <td> <i class="ti ti-file-dots"></i> <button type="button" data-bs-toggle="collapse" data-bs-target="#website-{{$k}}" aria-controls="website-{{$k}}" aria-expanded="false" class="accordion accordion-button collapsed bg-light"></button> </td> -->
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
                    <button type="submit" data-href=""
                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light delete-yes-btn"
                        onclick="window.location.href = $(this).attr('data-href')">{{ __('Yes') }}</button>
                    <button type="reset" class="btn btn-label-secondary btn-reset waves-effect"
                        onclick="$('#delete-yes-btn').data('href','');" data-bs-dismiss="modal" aria-label="Close">{{
                        __('No')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showDetail-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-lg modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Website Info') }}</h3>
                </div>
                <div class="container">
                    <div class="row my-2">
                        <div class="col border rounded mx-2">
                            <p scope="col" class="m-2"><strong>Spam Score :</strong> <span class="spam_score"></span>
                            </p>
                        </div>
                        <div class="col border rounded mx-2">
                            <p class="m-2"><strong>Min Word Count:</strong><span
                                    class="minimum_word_count_required"></span></p>
                        </div>
                        <div class="col border rounded mx-2">
                            <p class="m-2"><strong>Backlink :</strong> <span class="backlink_type"></span></p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row my-2">
                        <div class="col border rounded mx-2">
                            <p class="m-2"><strong>TAT:</strong> <span class="publishing_time"></span></p>
                        </div>
                        <div class="col border rounded mx-2">
                            <p scope="col" class="m-2"><strong>Link Insertion Price:</strong>$<span
                                    class="link_insertion_price"></span></p>
                        </div>
                        <div class="col border rounded mx-2">
                            <p scope="col" class="m-2"><strong>Maximum no.of backlinks:</strong><span
                                    class="maximum_no_of_backlinks_allowed"></span></p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row my-2">
                        <div class="col border rounded mx-2">
                            <p class="m-1"><strong> Forbidden Categories</strong></p>
                            <p class="mod_forbidden_categories m-1 text-primary"></p>
                        </div>
                        <div class="col border rounded mx-2">
                            <p class="m-1"><strong>Categories</strong></p>
                            <p class="tool-tip mod_categories m-1 text-primary"></p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row my-2">
                        <div class="col mx-2 d-flex justify-content-center">
                            <button scope="col" class="btn btn-label-primary m-2"><a class="sample_post_url"
                                    href="">View Sample</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Rejection Modal -->
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
@endsection

@push('script')
<script>
    var table = $('#website-tbl').DataTable();

    function webStatus($this, $id) {
        $status = $this.data('item');
        $statusText = $this.text();
        $_token = $('input[name="_token"]').val();
        $url = $('#url').val();

        if ($status === 'rejected') {
            $('#orderId').val($id);
            $('#status').val($status);
            $('#rejectionModal').modal('show');
        } else {
            updateStatus($id, $status, '');
        }
    }

    $('#rejectionModal').on('hidden.bs.modal', function() {
        $('#rejectionReason').val(''); // Clear the textarea
        $('#rejectionForm')[0].reset(); // Reset the form
    });

    $('#rejectionForm').submit(function(e) {
        e.preventDefault();

        var $id = $('#orderId').val();
        var $status = $('#status').val();
        var $reason = $('#rejectionReason').val();
        $_token = $('input[name="_token"]').val();
        $url = $('#url').val();

        if ($reason === '') {
            alert('Please provide a reason for rejection.');
            return;
        }

        updateStatus($id, $status, $reason);
    });

    function updateStatus($id, $status, $reason) {
        if ($status != '') {
            $.ajax({
                type: 'POST',
                url: $url + '/' + $id,
                data: {
                    '_token': $_token,
                    'status': $status,
                    'rejectionReason': $reason
                },
                success: function(response) {
                    var $obj = JSON.parse(response);
                    if ($obj.error != '') {
                        $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                    } else {
                        $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
                        $('.webStatus' + $id).removeClass('active');
                        $('li[data-item="' + $status + '"]').addClass('active');
                        $('.statusBtnTitle' + $id).text($status);
                        $('#rejectionModal').modal('hide');
                    }
                },
                error: function(error) {
                    // Handle errors
                    $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error + '</li></ul>');
                }
            });
        }
    }

    function getSiteDetail($this) {
        var v = $this.data('i');
        $categories = (v.categories).split(',');
        $forbidden_categories = (v.forbidden_categories).split(',');
        $('.spam_score').html(v.spam_score);
        $('.minimum_word_count_required').html(v.minimum_word_count_required);
        $('.backlink_type').html(v.backlink_type);
        $('.publishing_time').html(v.publishing_time);
        $('.link_insertion_price').html(v.link_insertion_price);
        $('.maximum_no_of_backlinks_allowed').html(v.maximum_no_of_backlinks_allowed);
        $('.sample_post_url').attr('href', v.sample_post_url);
        $('.mod_forbidden_categories').html(($forbidden_categories.length >= 1) ? $forbidden_categories.join(', ') : $forbidden_categories[0]);
        $('.mod_categories').html(($categories.length >= 1) ? $categories.join(', ') : $categories[0]);
        $('#showDetail-pop').modal('show');

        // $status = $this.data('item');
        // $statusText = $this.text();
        // $_token = $('input[name="_token"]').val();
        // $url = $('#url').val();
        // if ($status != '') {
        //     $.ajax({
        //         type: 'POST',
        //         url: $url + '/' + $id,
        //         data: {
        //             '_token': $_token,
        //             'status': $status,
        //         },
        //         success: function (response) {
        //             var $obj = JSON.parse(response);
        //             if ($obj.error != '') {
        //                 $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
        //             } else {
        //                 $('#alert').attr('class', '').addClass('alert alert-success').html('<ul class="m-auto"><li>' + $obj.success + '</li></ul>');
        //                 $('.webStatus' + $id).removeClass('active');
        //                 $this.addClass('active');
        //                 $('.statusBtnTitle' + $id).text($statusText);
        //             }
        //         },
        //         error: function (error) {
        //             // Handle errors
        //             $('#alert').attr('class', '').addClass('alert alert-danger').html('<ul class="m-auto"><li>' + error + '</li></ul>');
        //             // console.log(error);
        //         }
        //     });
        // }
    }
</script>
@endpush