@extends('advertiser.menu')

@push('css')
@endpush

@section('sidebar-content')
<?php $arrCookie = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart']) : array(); ?>
<!-- Content -->
<input type="hidden" id="user_id" value="{{ $userDetail->id }}">
<input type="hidden" id="user_role" value="{{ $userDetail->role->name }}">

<div class="container-xxl flex-grow-1 container-p-y mt-5">
    @if(session('success'))
    <div class="alert alert-primary mt-3">{{ session('success') }}</div>
    <input type="hidden" id="tempWebId" data-web_id="<?= session('website_id') ?>">
    @endif
    <h5 class="shadow-lg p-3 bg-white rounded">My Shopping Bag ({{ count($arrCookie) }} Items)</h5>
    <div class="row">
        <!-- Checkout Wizard -->
        <div class="wizard-icons wizard-icons-example mb-5">
            <div class="bs-stepper-content">
                <!-- <form id="wizard-checkout-form" onSubmit="return false"> -->
                <!-- Cart -->
                <div id="checkout-cart" class="content">
                    <div class="row">
                        <!-- Cart left -->
                        <div class="col-xl-12 mb-3 mb-xl-0 pt-3">
                            <!-- Offer alert -->
                            <!-- <div class="alert alert-success mb-3" role="alert">
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0">
                                            <i class="ti ti-bookmarks ti-sm alert-icon alert-icon-lg"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-medium fs-5 mb-2">Available Offers</div>
                                            <ul class="list-unstyled mb-0">
                                                <li>- 10% Instant Discount on Bank of America Corp Bank Debit and Credit cards</li>
                                                <li>- 25% Cashback Voucher of up to $60 on first ever PayPal transaction. TCA</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div> -->
                            @if(isset($websites) && !empty($websites))
                            <!-- Shopping bag -->
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="container">
                                <div class="mb-3">
                                    @foreach($websites as $k => $v)
                                    <div class="card mb-4 web_id_{{$v->id}}">
                                        <div class="card-body">
                                            <form action="{{ route('advertiser.orders.store') }}" method="post" id="cartform-{{ $v->id }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="quantity{{$v->id}}" name="quantity" value="{{$arrCookie[$k]->quantity}}" />
                                                <input type="hidden" id="user_id" name="user_id" value="{{ $userDetail->id }}">
                                                <input type="hidden" id="website_id" name="website_id" value="{{ $v->id }}">
                                                <input type="hidden" id="payment_method" name="payment_method" value="paypal">
                                                <input type="hidden" id="price{{$v->id}}" name="price" value="{{ ($v->guest_post_price*$arrCookie[$k]->quantity) }}">
                                                <input type="hidden" id="type" name="type" value="guest post">
                                                <div class="d-flex mt-4">
                                                    <button type="button" class="btn-close btn-pinned" data-web_id="{{ $v->id }}" onclick="removeFromCart($(this))" aria-label="Close"></button>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6 d-flex align-items-start flex-column">
                                                        <a href="{{ $v->website_url }}" class="badge text-primary p-3 pb-0 px-0 fs-5" target="_blank">
                                                            {{ $v->website_url }}
                                                        </a>
                                                        <div>
                                                            <p class="m-0 fs-6">Categories: <span>{{ $v->categories }}</span></p>
                                                            <p class="m-0 fs-6">Forbidden Categories: <span>{{ $v->forbidden_categories }}</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="col-md-4 text-md">
                                                            <label class="form-label">Quantity</label>
                                                            <input type="number" id="inputQuantity" data-price="{{$v->guest_post_price}}" data-web_id="{{$v->id}}" onchange="changeQuantity($(this))" class="form-control" value="{{$arrCookie[$k]->quantity}}" min="1" max="5" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center d-flex align-items-end justify-content-center">
                                                        <span class="badge  fs-5 p-2 price-box quantityPrice{{$v->id}}">
                                                            ${{ ($v->guest_post_price * $arrCookie[$k]->quantity) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- <div class="d-flex mb-3">
                                                        <div class="col-md-9 m-0">
                                                            <p class="m-0 fs-6">Category: <span>xyz, xyz1</span></p>
                                                        </div>
                                                    </div> -->
                                                <div class="post-title-main d-flex mb-3 justify-content-between">
                                                    <div class="col-md-6 pe-2 ">
                                                        <label class="form-label" for="inputArticleTitle{{$v->id}}">Post Title</label>
                                                        <input type="text" class="form-control inputArticleTitle" name="article_title" id="inputArticleTitle{{$v->id}}" required placeholder="Enter post title">
                                                        <div class="valid-feedback"></div>
                                                        <div class="invalid-feedback">Invalid Post Title or Empty Post Title Please Insert Title Without Link.</div>
                                                    </div>
                                                    <!-- <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="inputDocFile{{$v->id}}">Attachments <small>Note: Support only doc, docx
                                                        </small><label>
                                                        <input type="file" class="form-control attachments-control inputDocFile" name="attachment" id="inputDocFile{{$v->id}}" required="">
                                                        <div class="valid-feedback">File type is allowed. You can upload it.</div>
                                                        <div class="invalid-feedback">Invalid file type. Please select a .doc or .docx file.</div>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="inputDocFile{{$v->id}}">Attachments <small>Note: Support only doc, docx</small></label>
                                                        <input type="file" class="form-control attachments-control inputDocFile" name="attachment" id="inputDocFile{{$v->id}}" required="">
                                                        <div class="valid-feedback">File type is allowed. You can upload it.</div>
                                                        <div class="invalid-feedback">Invalid file type. Please select a .doc or .docx file.</div>
                                                    </div>
                                                    <!-- <div class="col-md-6 pe-2">
                                                            <label class="form-label" for="inputDocFile{{$v->id}}">Attachments<small>Note: Support
                                                                    only doc, docx</small></label>
                                                            <input type="file" class="form-control inputDocFile" name="attachment" id="inputDocFile{{$v->id}}" required>
                                                            <div class="valid-feedback">File type is allowed. You can upload it.
                                                            </div>
                                                            <div class="invalid-feedback">Invalid file type. Please select a .doc or .docx file.</div>
                                                        </div> -->
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label" for="inputSpecialInstructions{{$v->id}}">Special Instructions</label>
                                                    <textarea type="text" class="form-control" rows="5" name="special_instructions" id="inputSpecialInstructions{{$v->id}}" required></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="text-center mx-2">
                                                        <button type="button" class="btn btn-primary checkout-btn" data-formid="cartform-{{ $v->id }}" data-webid="{{ $v->id }}" data-web_userid="{{ $v->user_id }}" onclick="orderPlace($(this))">
                                                            <span class="loader-box spinner-border me-1" role="status" aria-hidden="true" style="display: none;"></span>
                                                            Check Out
                                                        </button>
                                                    </div>
                                                    <div class="text-center mx-2">
                                                        <button type="button" class="btn btn-danger btn-label-danger" data-web_id="{{ $v->id }}" onclick="removeFromCart($(this))">Remove</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <!--/ Checkout Wizard -->
</div>

<!-- resources/views/advertiser/cart.blade.php -->
<div class="container-xxl flex-grow-1 container-p-y mt-5">
    <h5 class="shadow-lg p-3 bg-white rounded">Similar Website</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Website URL</th>
                    <th>Categories</th>
                    <th>Da</th>
                    <th>Guest Post</th>
                    <th>Actions</th> <!-- Added for buttons -->
                </tr>
            </thead>
            <tbody>
                @foreach($allWebsites as $k => $website)
                    @php
                        $arrCookie = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
                        $isAdded = array_search($website->id, array_column($arrCookie, 'web_id')) !== false;
                        $cls = $isAdded ? 'btn-primary' : 'btn-label-primary';
                        $text = $isAdded ? '<i class="ti ti-shopping-cart-plus"></i> Added' : '<i class="ti ti-shopping-cart-plus"></i> Add';
                    @endphp
                    <tr>
                        <td>{{ $website->id }}</td>
                        <td><a href="{{ $website->website_url }}" target="_blank">{{ $website->website_url }}</a></td>
                        <td>{{ $website->categories }}</td>
                        <td>{{ $website->domain_authority }}</td>
                        <td>${{ $website->guest_post_price }}</td>
                        <td>
                            <button type="button" class="btn {{ $cls }} waves-effect waves-light" data-web_id="{{ $website->id }}"
                                onclick="addToCart($(this))">
                                {!! $text !!}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--/ Content -->
<div class="modal fade" id="billing-pop" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">{{ __('Click To Payment') }}</h3>
                </div>
                <form action="{{ route('stripe.charge') }}" method="POST">
                    @csrf
                    <div class="hidden-input">
                        <input type="hidden" id="order_id" name="order_id" value="">
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="u_id" name="u_id" value="{{ $userDetail->id }}">
                        <input type="hidden" id="price" name="price" value="">
                    </div>
                    <div id="stripe-btn">
                        <script></script>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="loader-main-box" id="page-loader">
    <div class="loader-box spinner-border spinner-border-lg text-primary" role="status">
        <span class="loader-text visually-hidden">Loading...</span>
    </div>
</div>
@endsection

@push('script')
<script>
    $('.inputDocFile').change(function() {
        const selectedFile = this.files[0]; // Get the selected file

        if (selectedFile) {
            const allowedFileTypes = ['application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ]; // MIME types for .doc and .docx

            if (allowedFileTypes.includes(selectedFile.type)) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                // Valid file type
            } else {
                $(this).addClass('is-invalid').removeClass('is-valid');
                // Invalid file type
                $('#fileInput').val(''); // Clear the file input
            }
        }
    });

    $('AddToCart').click(function() {
        addToCart($(this));
    });

    function addToCart($this) {
        var $web_id = $this.data('web_id');
        var $user_id = $('#user_id').val();
        $newCartArr = [];
        $data = {
            'user_id': $user_id,
            'web_id': $web_id,
            'quantity': 1,
        };
        $cartCookie = getCookie('cart')
        $num = 0;
        if ($cartCookie != '') {
            $cartArr = JSON.parse($cartCookie);
            $.each($cartArr, function(i, v) {
                if (v.user_id == $user_id && v.web_id == $web_id) {
                    $num++;
                    $this.addClass('btn-label-primary').removeClass('btn-primary');
                    $this.html('<i class="ti ti-shopping-cart-plus"></i> Add');
                } else {
                    $newCartArr[$newCartArr.length] = v;
                }
            });
        }

        if ($num == 0) {
            $newCartArr[$newCartArr.length] = $data;
            $this.removeClass('btn-label-primary').addClass('btn-primary');
            $this.html('<i class="ti ti-shopping-cart-plus"></i> Added');
        }
        $('.nav-cart-icon').attr('data-item-count',$newCartArr.length);
        setCookie('cart', JSON.stringify($newCartArr), 2);
    }

    function removeFromCart($this) {
        var $web_id = $this.data('web_id');
        var $user_id = $('#user_id').val();
        $newCartArr = [];
        $cartCookie = getCookie('cart')
        $num = 0;
        if ($cartCookie != '') {
            $cartArr = JSON.parse($cartCookie);
            $.each($cartArr, function(i, v) {
                if (v.user_id == $user_id && v.web_id == $web_id) {
                    $num++;
                    $('.web_id_' + $web_id).remove();
                } else {

                    (v != null) ? $newCartArr[$newCartArr.length] = v: '';
                }
            });
            $('.nav-cart-icon').attr('data-item-count',$newCartArr.length);
            setCookie('cart', JSON.stringify($newCartArr), 2);
        }
    }

    function changeQuantity($this) {
        var $quantity = $this.val();
        var $web_id = $this.data('web_id');
        var $price = $this.data('price');
        var $user_id = $('#user_id').val();
        $newCartArr = [];
        $cartCookie = getCookie('cart')
        $num = 0;
        if ($cartCookie != '') {
            $cartArr = JSON.parse($cartCookie);
            $.each($cartArr, function(i, v) {
                if (v.user_id == $user_id && v.web_id == $web_id) {
                    if ($quantity == 0 || $quantity == '' || $quantity == '0') {
                        v = null;
                    } else {
                        v.quantity = $quantity;
                        $('#quantity' + $web_id).val($quantity);
                        $('.quantityPrice' + $web_id).text('$' + $price * $quantity);
                        $('#price' + $web_id).val($price * $quantity);
                    }
                }
                (v != null) ? $newCartArr[$newCartArr.length] = v: '';
            });
            $('.nav-cart-icon').attr('data-item-count',$newCartArr.length);
            setCookie('cart', JSON.stringify($newCartArr), 2);
        }
    }

    function hasURL(inputString) {
        var urlPattern = /(https?:\/\/[^\s]+)/g;
        return urlPattern.test(inputString);
    }

    function orderPlace($this) { 
        var $website_id = $this.data('webid');
        var $web_userid = $this.data('web_userid');
        var $user_id = $('#user_id').val();
        var $payment_method = 'stripe';
        var $price = $('#price' + $web_userid).val();
        var $type = 'guest post';
        var $inputDocFile = $('#inputDocFile' + $website_id).val();
        var $inputArticleTitle = $('#inputArticleTitle' + $website_id).val();
        var $inputSpecialInstructions = $('#inputSpecialInstructions' + $website_id).val();
        $flag = 0;

        if ($inputDocFile != '') {
            $('#inputDocFile' + $website_id).removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputDocFile' + $website_id).addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputArticleTitle != '' && !hasURL($inputArticleTitle)) {
            $('#inputArticleTitle' + $website_id).removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputArticleTitle' + $website_id).addClass('is-invalid').removeClass('is-valid');
        }
        if ($inputSpecialInstructions != '') {
            $('#inputSpecialInstructions' + $website_id).removeClass('is-invalid').addClass('is-valid');
        } else {
            $flag++;
            $('#inputSpecialInstructions' + $website_id).addClass('is-invalid').removeClass('is-valid');
        }

        if ($flag == 0) { 
            $('#page-loader').show();
            $('.checkout-btn').attr('disabled','');
            $('.checkout-btn .loader-box').show();
            formid = $this.data('formid');
            // $('#' + formid).submit();
            var url = $('#' + formid).attr("action"); 
            let formData = new FormData($('#' + formid)[0]);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(response) { console.log('hello'+ response);
                    var $obj = JSON.parse(response);
                    if ($obj.success == false) {
                        $('#alert').attr('class', '').addClass('alert alert-danger').html(
                            '<ul class="m-auto"><li>' + $obj.error + '</li></ul>');
                    } else {
                        $('#order_id').val($obj.order_id);
                        $('#id').val($obj.id);
                        $price = $('#price' + $obj.website_id).val();
                        $('#price').val($price);

                        $('#stripe-btn script').attr('data-key', '{{ config("services.stripe.key") }}');
                        $('#stripe-btn script').attr('data-amount', ($price * 100));
                        $('#stripe-btn script').attr('data-name', 'Local SEO Link Building');
                        $('#stripe-btn script').attr('data-description', 'Payment Description');
                        $('#stripe-btn script').attr('data-image', 'https://stripe.com/img/documentation/checkout/marketplace.png');
                        $('#stripe-btn script').attr('data-locale', 'auto');
                        $('#stripe-btn script').attr('data-currency', 'usd');
                        $('#stripe-btn script').attr('class', 'stripe-button');
                        $('#stripe-btn script').attr('src', 'https://checkout.stripe.com/checkout.js');
                        $('#billing-pop').modal('show');
                    }
                    $('#page-loader').hide();
                    $('.checkout-btn').removeAttr('disabled');
                    $('.checkout-btn .loader-box').hide();
                },
                error: function(error) {
                    // Handle errors
                    console.log(error);
                    $('#page-loader').hide();
                    $('.checkout-btn').removeAttr('disabled');
                    $('.checkout-btn .loader-box').hide();
                }
            });
        }
    }

    fetch('<?= url('public/json/country.json') ?>').then(response => response.json()).then(data => {
        $inputBillingCountry = $('#inputBillingCountry').data('val');
        $inputBillingCountry = ($inputBillingCountry != '') ? $inputBillingCountry : 'india';
        data.map(function($v) {
            $slct2 = $inputBillingCountry == ($v.name).toLowerCase() ? "selected" : "";
            $opt2 = '<option value="' + ($v.name).toLowerCase() + '" data-code="' + $v.dial_code +
                '" ' +
                $slct2 + '>' + $v.name + '</option>';
            $('#inputBillingCountry').append($opt2);
        });
    });
</script>
@if(session('success'))
<script>
    removeFromCart($('#tempWebId'));
</script>
<script>
    // Ensure this script runs after the DOM is fully loaded
$(document).ready(function() {
    // Bind click event to AddToCart buttons
    $("button[data-web_id]").click(function () {
        addToCart($(this));
    });
});

function addToCart($button) {
    var web_id = $button.data("web_id");
    var user_id = $("#user_id").val(); // Ensure you have a hidden input or similar element with ID user_id

    var cartCookie = getCookie("cart");
    var cartArr = cartCookie ? JSON.parse(cartCookie) : [];
    var newCartArr = [];
    var itemExists = false;

    // Check if the item is already in the cart
    $.each(cartArr, function(i, item) {
        if (item.user_id == user_id && item.web_id == web_id) {
            itemExists = true;
        } else {
            newCartArr.push(item);
        }
    });

    // Add or remove item based on its existence
    if (itemExists) {
        $button.removeClass("btn-primary").addClass("btn-label-primary");
        $button.html('<i class="ti ti-shopping-cart-plus"></i> Add');
    } else {
        newCartArr.push({ user_id: user_id, web_id: web_id, quantity: 1 });
        $button.removeClass("btn-label-primary").addClass("btn-primary");
        $button.html('<i class="ti ti-shopping-cart-plus"></i> Added');
    }

    // Update cart icon count
    $('.nav-cart-icon').attr('data-item-count', newCartArr.length);

    // Save updated cart to cookie
    setCookie("cart", JSON.stringify(newCartArr), 2);
}

// Function to get a cookie by name
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

// Function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

</script>
@endif


@endpush