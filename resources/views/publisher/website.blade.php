@extends('publisher.sidebar')

@section('sidebar-content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card tble">
                <div class="card-header dply">
                    {{ __('My Website') }}
                    <a href="{{ url('/publisher/website/create') }}" class="btn btn-outline-primary float-end"><i
                            class="ti ti-world-plus m-auto p-1"></i> Add Website</a>
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
                @if(count($websites) > 0)
                <div class="card-datatable table-responsive pt-0">
                    <table class="table dataTable table-responsive web_tab" id="websiteTbl">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Website URL</th>
                                <th scope="col"><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="Domain Authority">DA</span></th>
                                <th scope="col"><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="Page Authority">PA</span></th>
                                <th scope="col">Ahrefs Traffic</th>
                                <th scope="col">Semrush Traffic</th>
                                <!--<th scope="col">Google Analytics</th>-->
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Google Analytics</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($websites as $k => $v)
                            @php
                            $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',', $v->forbidden_categories);
                            @endphp
                            <tr class="table-body" data-bs-toggle="collapse" data-bs-target="#website-{{$k}}" aria-controls="website-{{$k}}" aria-expanded="false">
                                <td>{{ $v->website_url }}</td>
                                <td>{{ $v->domain_authority }}</td>
                                <td>{{ $v->page_authority }}</td>
                                <td>{{ $v->ahrefs_traffic }}</td>
                                <td>{{ $v->samrush_traffic }}</td>
                                <!--<td>{{ $v->google_analytics }}</td>-->
                                <td>${{ $v->guest_post_price }}</td>
                                <td>{{ ucwords($v->status) }}</td>
                                <td class="p-0 text-center">
                                    @if($v->site_verification_file != '')
                                    <a href="{{ url('/storage/app/' . $v->site_verification_file) }}" target="_blank"><i class="tf-icons ti ti-clock-cog"></i></a>
                                    @else
                                    <i class="tf-icons ti ti-clock-x text-danger"></i>
                                    @endif
                                </td>
                                <!-- <td class="p-0 text-center"><a href="{{ url('/publisher/website') }}/{{ $v->id }}/verify"><i class="tf-icons ti ti-clock-cog"></i></a></td> -->
                                <td>
                                    <button type="button" class="btn p-0 edit-btn text-info" onclick="window.location.href=`{{ url('/publisher/website') }}/{{ $v->id }}/edit`"><i class="ti ti-pencil me-1"></i></button>
                                    <button type="button" class="btn p-0 delete-btn text-danger" data-bs-toggle="modal" data-bs-target="#delete-pop" onclick="$('.delete-yes-btn').attr('data-href',`{{ url('/publisher/website') }}/{{ $v->id }}/delete`);"><i class="ti ti-trash me-1"></i></button>
                                    <!-- <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        </div>
                                    </div> -->
                                </td>
                            </tr>
                            <tr id="website-{{$k}}" class="accordion-collapse collapse" collapse="8">
                                <td class="accordion-body" colspan="8">
                                    <div id="historyCollapse" class="accordion-collapse collapse show category-table col-12" aria-labelledby="historyHeading" data-bs-parent="#historyAccordion">
                                        <div class="row">
                                            <div class="col-md-3 my-2"><strong>Role :</strong> {{ $v->website_url }}</div>
                                            <div class="col-md-3 my-2"><strong>Spam Score :</strong> {{ $v->spam_score }}</div>
                                            <div class="col-md-3 my-2"><strong>Min Word Count :</strong>{{ $v->minimum_word_count_required }}</div>
                                            <div class="col-md-3 my-2"><strong>Backlink :</strong> {{ $v->backlink_type }}</div>
                                            <div class="col-md-3 my-2"><strong>TAT:</strong> {{ $v->publishing_time }} Days</div>
                                            <!-- <div class="col-md-3 my-2"><strong>FC Guest Post Price :</strong> ${{ $v->fc_guest_post_price }}</div> -->
                                            <div class="col-md-3 my-2"><strong>Link Insertion Price :</strong>${{ $v->link_insertion_price }}</div>
                                            <!-- <div class="col-md-3 my-2"><strong>FC Link Insertion Price :</strong>${{ $v->fc_link_insertion_price }}</div> -->
                                            <div class="col-md-3 my-2"><strong>Maximum no.of backlinks :</strong>{{ $v->maximum_no_of_backlinks_allowed }}</div>
                                            <div class="col-md-3 my-2"><span class="border-none badge bg-label-info me-1 p-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="{!! (count($forbidden_categories) >= 1) ? implode(', ', $forbidden_categories) : $forbidden_categories[0] !!}" tooltip-position="right"> Forbidden Categories</span></div>
                                            <div class="col-md-3 my-2"><span class="border-none badge bg-label-info me-1 p-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="{{ (count($categories) >= 1) ? implode(', ', $categories) : $categories[0] }}" tooltip-position="right">Categories</span></div>
                                            <div class="col-md-3 my-2"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#guidelines-{{$k}}">Guidelines</button></div>
                                            <div class="col-md-3 my-2"><a href="{{ $v->sample_post_url }}" target="_blank">View Sample</a></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="modal fade" id="guidelines-{{$k}}" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                                            <div class="modal-content p-3 p-md-5">
                                                <div class="modal-body">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    <div class="text-center mb-4">
                                                        <h3 class="mb-2">Guidelines</h3>
                                                    </div>
                                                    <p class="text-wrap">{!! $v->guidelines !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    <button type="submit" data-href=""
                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light delete-yes-btn"
                        onclick="window.location.href = $(this).attr('data-href')">{{ __('Yes') }}</button>
                    <button type="reset" class="btn btn-label-secondary btn-reset waves-effect"
                        onclick="$('#delete-yes-btn').data('href','');" data-bs-dismiss="modal"
                        aria-label="Close">{{ __('No')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($websites) <= 0)
    <div class="modal fade" id="info-pop" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('By continuing, you agree to the following conditions.') }}</h3>
                </div>
                <ul style="line-height: 2;">
                    <li>
                        <strong>Add Website metrics:</strong>
                        <ul>
                            <li>
                                <p>{{ __('A minimum of 50 articles of a website should be indexed on Google. Link Publishers only considers websites with REAL high-quality traffic. PBN websites are immediately rejected from our list of accepted websites.') }}</p>
                                <p>{{ __('Note: Including PBN websites may result in an account ban.') }}</p>
                            </li>
                            <li>{{ __('A domain must have at least six months of age.') }}</li>
                            <li>{{ __('Domain Authority of a website must be no less than 15.') }}</li>
                            <li>{{ __('Website Ahrefs or Semrush Organic Traffic should be greater than 250.') }}</li>
                            <li>{{ __('MOZ Spam Score of a website can be no more than 15%.') }}</li>
                        </ul>
                    </li>
                    <li><strong>{{ __('Content on websites must be unique, readable and frequently updated.') }}</strong></li>
                    <li><strong>{{ __('Websites violating any laws are banned.') }}</strong></li>
                    <li><strong>{{ __('Websites not conforming to the ethical standards and highest moral is prohibited.') }}</strong></li>
                    <li><strong>{{ __('Forbidden categories that are accepted: CBD, Casino, Vape ,Cryptocurrency') }}</strong></li>
                    <li><strong>{{ __("We are also authorized to assess the website from an end-user's perspective. Thus, we may reject a website if our expectations are not met.") }}</strong></li>
                </ul>
                <div class="col-12 text-center">
                    <button type="reset" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light agree-btn" data-bs-dismiss="modal" aria-label="Close">{{ __('Agree & Continue')}}</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        var table = $('#websiteTbl').DataTable();
        $(window).ready(function() {
            $('#info-pop').modal('show');
        });
    </script>
    @endif

    @endsection