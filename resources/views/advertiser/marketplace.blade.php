@extends('advertiser.menu')
@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush
@section('sidebar-content') @include('advertiser.filter_second')
 <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />
 <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.8/css/select.dataTables.min.css" />

<style>
    /*#websitesTable .accordion-collapse td:not(.accordion-body){ display: none; }*/
</style>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Marketplace') }}
                    </div>
                </div>
            </div>
        </div> -->
    @if(session('success'))
    <div class="alert alert-primary mt-3">{{ session("success") }}</div>
    @endif
    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card mt-2">
                @if (count($websites) > 0)
                <input type="hidden" id="user_id" value="{{ $userDetail->id }}" />
                <input type="hidden" id="user_role" value="{{ $userDetail->role->name }}" />
                <div class="table-responsive text-nowrap m-3">
                    @php $arrCookie = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart']) : array(); @endphp
                    <table class="table" id="websitesTable">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Website URL</th>
                                <th scope="col"><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="Domain Authority">DA</span></th>
                                <th scope="col"><span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secondary" data-bs-original-title="Page Authority">PA</span></th>
                                <th scope="col">Ahrefs</th>
                                <th scope="col">Semrush</th>
                                <th scope="col">TAT</th>
                                <th scope="col">Backlink</th>
                                <th scope="col">Guest Post</th>
                                <th scope="col">Link Insertion</th>
                                <th scope="col">Action</th>
                                <th scope="col" class="text-center"><i class="ti ti-dots"></i></th>
                                <th style="display: none;">Details</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($websites as $k => $v) @php
                            if(array_search($userDetail->id,
                            array_column($arrCookie, 'user_id')) != '' &&
                            array_search($v->id, array_column($arrCookie,
                            'web_id')) != ''){ $cls = 'btn-primary'; $text = '<i class="ti ti-shopping-cart-plus"></i>
                            Added'; }else{ $cls = 'btn-label-primary'; $text =
                            '<i class="ti ti-shopping-cart-plus"></i>
                            Add'; } $categories = explode(',', $v->categories);
                            $forbidden_categories = explode(',',
                            $v->forbidden_categories); @endphp
                            <tr>
                                <td>{{ $v->website_url }}</td>
                                <td>{{ $v->domain_authority }}</td>
                                <td>{{ $v->page_authority }}</td>
                                <td>{{ $v->ahrefs_traffic }}</td>
                                <td>{{ $v->samrush_traffic }}</td>
                                <td>{{ $v->publishing_time }} Days</td>
                                <td>
                                    {{ $v->maximum_no_of_backlinks_allowed }}
                                    {{ ucwords($v->backlink_type) }}
                                </td>
                                <td>${{ $v->guest_post_price }}</td>
                                <td>${{ $v->link_insertion_price }}</td>
                                <td>
                                    <button type="button" class="btn {{
                                            $cls
                                        }} waves-effect waves-light" data-web_id="{{ $v->id }}" onclick="addToCart($(this))" id="AddToCart">
                                        {!! $text !!}
                                    </button>
                                </td>
                                <td>
                                    <button type="button" data-bs-toggle="collapse" data-bs-target="#website-{{ $k }}" aria-controls="website-{{ $k }}" aria-expanded="false" class="accordion accordion-button collapsed"></button>
                                </td>
                            <!--</tr>-->
                            <!--<tr id="website-{{ $k }}" class="accordion-collapse collapse extra-info">-->
                                <td class="accordion-body" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-2 my-3">
                                            <strong>Min Word Count:</strong>
                                            {{ $v->minimum_word_count_required }}
                                        </div>
                                        <div class="col-md-2 my-3"><strong>Spam Score:</strong> {{ $v->spam_score }}</div>
                                        <div class="col-md-3 my-3"><strong>Role:</strong> Guest Post</div>
                                        <div class="col-md-4 my-3"><strong>Link Insertion Price:</strong>${{ $v->link_insertion_price }}</div>
                                        <div class="col-md-3 my-3">
                                            <strong>Maximum no. of
                                                backlinks:</strong>
                                            {{ $v->maximum_no_of_backlinks_allowed }}
                                        </div>
                                        <!-- <div class="col-md-2 my-3"><strong>FC Guest Post Price:</strong>${{ $v->fc_guest_post_price }}</div>
                                        <div class="col-md-3 my-3"><strong>FC Link Insertion Price:</strong>${{ $v->fc_link_insertion_price }}</div> -->
                                        <div class="col-md-4 my-3">
                                            <button type="button" class="border-none badge bg-label-info me-1 p-2" data-bs-toggle="modal" data-bs-target="#guidelines-{{$k}}">
                                                Guidelines
                                            </button>
                                        </div>
                                        <div class="col-md-3 my-3">
                                            <a href="{{ $v->sample_post_url }}">View Sample</a>
                                        </div>
                                    </div>
                                </td>
                                <div class="modal fade" id="guidelines-{{ $k }}" tabindex="-1" style="display: none" aria-hidden="true">
                                    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">
                                                        Guidelines
                                                    </h3>
                                                </div>
                                                <p class="text-wrap">
                                                    {!! $v->guidelines !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-info text-center m-3">
                    No record found!
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-pop" tabindex="-1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __("Delete Record") }}</h3>
                </div>
                <p class="text-wrap">
                    {{ __("Are you sure you wan't to delete this record!") }}
                </p>
                <div class="col-12 text-center">
                    <button type="submit" data-href="" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light delete-yes-btn" onclick="window.location.href = $(this).attr('data-href')">
                        {{ __("Yes") }}
                    </button>
                    <button type="reset" class="btn btn-label-secondary btn-reset waves-effect" onclick="$('#delete-yes-btn').data('href','');" data-bs-dismiss="modal" aria-label="Close">
                        {{ __("No") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
@push('script')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    // let table = new DataTable('#websitesTable', {
    //     responsive: true
    // });
    let table = new DataTable('#websitesTable');
    // var table = $('#websitesTable').DataTable({
    //      select: true,
    //     columnDefs: [{
    //         "defaultContent": "-",
    //         "targets": "_all"
    //       }],
    //      order: [[0, 'desc']],
    //     });
    
    $("AddToCart").click(function() {
        addToCart($(this));
    });

    function addToCart($this) {
        var $web_id = $this.data("web_id");
        var $user_id = $("#user_id").val();
        $newCartArr = [];
        $data = {
            user_id: $user_id,
            web_id: $web_id,
            quantity: 1,
        };
        $cartCookie = getCookie("cart");
        $num = 0;
        if ($cartCookie != "") {
            $cartArr = JSON.parse($cartCookie);
            $.each($cartArr, function(i, v) {
                if (v.user_id == $user_id && v.web_id == $web_id) {
                    $num++;
                    $this
                        .addClass("btn-label-primary")
                        .removeClass("btn-primary");
                    $this.html('<i class="ti ti-shopping-cart-plus"></i> Add');
                } else {
                    $newCartArr[$newCartArr.length] = v;
                }
            });
        }
        if ($num == 0) {
            $data != null ? $newCartArr[$newCartArr.length] = $data : '';
            $this.removeClass("btn-label-primary").addClass("btn-primary");
            $this.html('<i class="ti ti-shopping-cart-plus"></i> Added');
        }
        $('.nav-cart-icon').attr('data-item-count',$newCartArr.length);
        setCookie("cart", JSON.stringify($newCartArr), 2);
    }
</script>
<script>
    $(document).ready(function() {
       
        $(document).ready(function() {
            
            
            //toggle for new tr
            // $('.accordion-button').click(function() { 
               $(".dataTables_wrapper").on("click",".accordion-button", function(){
                var currentRow = $(this).closest('tr');
                var appendedRow = currentRow.next('.appended-row');
                currentRow.next('.appended-row').remove();
                 if (appendedRow.length) {
                    appendedRow.toggle();
                } else {
                    var rowHtml = currentRow.find('td[style="display: none;"]').html();
                    var newRow = $('<tr class="appended-row">').append($('<td>').attr('colspan', '11').html(rowHtml));
                    currentRow.after(newRow);
                }
            });
        });

        var $price_filters = [];
        var $backlink_type = '';
        var $arrCategories = '';

        $('body').on('click', '.priceMinMax', function() {
            var minValPrice = $('#priceMin').val();
            var maxValPrice = $('#priceMax').val();
            if(priceMinMaxFun() == 0){
                $price_filters = [];
                $("input.price_filter:checked").each(function() {
                    $price_filters.push($(this).val());
                });
                $price_filters.push(minValPrice+'-'+maxValPrice);
            }
            tblFilter();
        });

        $('#priceMin').on('keyup change', function() {
            priceMinMaxFun();
        });

        $('#priceMax').on('keyup change', function() {
            priceMinMaxFun();
        });

        function priceMinMaxFun() {
            $flag = 0;
            if ($('#priceMin').val() && $('#priceMax').val()) {
                if (parseInt($('#priceMin').val()) <= parseInt($('#priceMax').val())) {
                    $('.priceMinMax').prop('disabled', false);
                    $("#price_traffic_msg").addClass('d-none');
                } else {
                    $('.priceMinMax').prop('disabled', true);
                    $("#price_traffic_msg").removeClass('d-none');
                    $flag++;
                }
            } else {
                $flag++;
                $('.priceMinMax').prop('disabled', true);
                $("#price_traffic_msg").addClass('d-none');
                $price_filters = [];
                $("input.price_filter:checked").each(function() {
                    $price_filters.push($(this).val());
                });
                tblFilter();
            }
            return $flag;
        }

        $('input.price_filter').on('click', function() {
            $price_filters = [];
            $("input.price_filter:checked").each(function() {
                $price_filters.push($(this).val());
            });
            if(priceMinMaxFun() == 0){
                $price_filters.push($('#priceMin').val()+'-'+$('#priceMax').val());
            }
            tblFilter();
        });

        $('input[name="backlink_type"]').on('click', function() {
            var inp = $(this);
            page = 1;
            if (inp.is(".selected_type")) {
                inp.prop("checked", false).removeClass("selected_type");
                $backlink_type = null;
            } else {
                $backlink_type = $("input[name='backlink_type']:checked").val();
                $(this).addClass('selected_type');
            }
            tblFilter();
        });

        $('#inputCategories1').change(() => {
            var $inputCategories1 = $('#inputCategories1').val();
            $arrCategories = $inputCategories1.join(",");
            tblFilter();
        });

        const tblFilter = () => {
            // $this = $(this);
            // $status = $this.data('item');
            // $statusText = $this.text();
            // $id = $('#id').val();
            $url = $("#url").val();
            $_token = $('input[name="_token"]').val();
            // if ($inputCategories1 != "") {
            $.ajax({
                type: "POST",
                url: $url,
                data: {
                    _token: $_token,
                    categories: $arrCategories,
                    backlink_type: $backlink_type,
                    price_filters: $price_filters,
                },
                success: function(response) {
                    console.log(response);
                    var $websites = response;
                    if($websites.length > 0){
                        var userDetailId = $('#user_id').val();
                        $cartCookie = getCookie("cart");
                        arrCookie = ($cartCookie != '') ? JSON.parse($cartCookie) : [];
    
                        $("#websitesTable tbody").html('');
                        $.each($websites, function(k, v) {
                            var cls = "btn-label-primary";
                            var text = '<i class="ti ti-shopping-cart-plus"></i> Add';
    
                            var userIdIndex = arrCookie.findIndex(function(
                                cookie
                            ) {
                                return cookie.user_id === userDetailId;
                            });
    
                            var webIdIndex = arrCookie.findIndex(function(cookie) {
                                return cookie.web_id === v.id;
                            });
    
                            if (userIdIndex !== -1 && webIdIndex !== -1) {
                                cls = "btn-primary";
                                text = '<i class="ti ti-shopping-cart-plus"></i> Added';
                            }
    
                            var categories = v.categories.split(",");
                            var forbiddenCategories = v.forbidden_categories.split(",");
                            var newRow = '<tr>' +
                                '<td>' + v.website_url + '</td>' +
                                '<td>' + v.domain_authority + '</td>' +
                                '<td>' + v.page_authority + '</td>' +
                                '<td>' + v.ahrefs_traffic + '</td>' +
                                '<td>' + v.samrush_traffic + '</td>' +
                                '<td>' + v.publishing_time + ' Days</td>' +
                                '<td>' + v.maximum_no_of_backlinks_allowed + ' ' + v.backlink_type + '</td>' +
                                '<td>$' + v.guest_post_price + '</td>' +
                                '<td>$' + v.link_insertion_price + '</td>' +
                                '<td><button type="button" class="btn ' + cls + ' waves-effect waves-light" data-web_id="' + v.id + '" onclick="addToCart($(this))">' + text + '</button></td>' +
                                '<td><button type="button" data-bs-toggle="collapse" data-bs-target="#website-' + k + '" aria-controls="website-' + k + '" aria-expanded="false" class="accordion accordion-button collapsed"></button></td>' +
                                // '</tr>' +
                                // '<tr id="website-' + k + '" class="accordion-collapse collapse">' +
                                '<td class="accordion-body" style="display: none;" >' +
                                '<div class="row">' +
                                '<div class="col-md-3 my-3"><strong>Min Word Count:</strong> ' + v.minimum_word_count_required + '</div>' +
                                '<div class="col-md-2 my-3"><strong>Spam Score:</strong>' + v.spam_score + '</div>' +
                                '<div class="col-md-3 my-3"><strong>Role:</strong> Guest Post</div>' +
                                '<div class="col-md-3 my-3"><strong>Link Insertion Price:</strong> $' + v.link_insertion_price + '</div>' +
                                '<div class="col-md-3 my-3"><strong>Maximum no. of backlinks:</strong> ' + v.maximum_no_of_backlinks_allowed + '</div>' +
                                // '<div class="col-md-3 my-3"><strong>FC Guest Post Price:</strong> $' + v.fc_guest_post_price + '</div>' +
                                // '<div class="col-md-3 my-3"><strong>FC Link Insertion Price:</strong> $' + v.fc_link_insertion_price + '</div>' +
                                '<div class="col-md-3 my-3"><button type="button" class="border-none badge bg-label-info me-1 p-2" data-bs-toggle="modal" data-bs-target="#guidelines-' + k + '">Guidelines</button></div>' +
                                '<div class="col-md-3 my-3"><a href="' + v.sample_post_url + '">View Sample</a></div>' +
                                '</div>' +
                                '</td>' +
                                '<div class="modal fade" id="guidelines-' + k + '" tabindex="-1" style="display: none;" aria-hidden="true">' +
                                '<div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">' +
                                '<div class="modal-content p-3 p-md-5">' +
                                '<div class="modal-body">' +
                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                '<div class="text-center mb-4"><h3 class="mb-2">Guidelines</h3></div>' +
                                '<p class="text-wrap">' + v.guidelines + '</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</tr>';
    
                            $("#websitesTable tbody").append(newRow);
                        });
                    }else{
                        var newRow = '<tr><td colspan="9"><div class="text-center text-primary">Opps! Data Not Found</div></td></tr>';
                        $("#websitesTable tbody").html(newRow);
                    }
                },
                error: function(error) {
                    // Handle errors
                    console.log(error);
                },
            });
            // }
        }
    });
</script>
<script src="{{
        asset_url('libs/bootstrap-select/bootstrap-select.js')
    }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>
@endpush