@extends('advertiser.menu')

@push('css')
<link rel="stylesheet" href="{{ asset_url('libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset_url('libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset_url('libs/toastr/toastr.css') }}">
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

                <div id="checkout-cart" class="content">
                    <div class="row">
                        <div class="col-xl-12 mb-3 mb-xl-0 pt-3">

                            @if(isset($websites) && !empty($websites))
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
                                                <!-- <input type="hidden" id="payment_method" name="payment_method" value="paypal"> -->
                                                <input type="hidden" id="price{{$v->id}}" name="price" value="{{ ($v->guest_post_price*$arrCookie[$k]->quantity) }}">
                                                <input type="hidden" name="selected_project_id" value="{{ session('selected_project_id') }}">

                                                <div class="mb-3">
                                                    <label class="form-label">Payment Method</label><br>
                                                    <input type="radio" name="payment_method" value="paypal" id="paypal-${item.web_id}" class="payment-method-radio" checked>
                                                    <label for="paypal-${item.web_id}" class="form-check-label">PayPal</label>
                                                    <input type="radio" name="payment_method" value="razorpay" id="razorpay-${item.web_id}" class="payment-method-radio">
                                                    <label for="razorpay-${item.web_id}" class="form-check-label">Razorpay</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="attachment_type" value="Guest Post" id="attachmentFile{{ $v->id }}" class="form-check-input attachment-type-radio" checked onchange="toggleAttachmentType({{ $v->id }})">
                                                    <label for="attachmentFile{{ $v->id }}" class="form-check-label">Upload File</label>
                                                    <input type="radio" name="attachment_type" value="Link Insertion" id="attachmentLink{{ $v->id }}" class="form-check-input attachment-type-radio" onchange="toggleAttachmentType({{ $v->id }})">
                                                    <label for="attachmentLink{{ $v->id }}" class="form-check-label">Add Link</label>
                                                </div>

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
                                                        <div class="col-md-4 text-md" id="inputQuantitydiv{{ $v->id }}">
                                                            <label class="form-label">Quantity</label>
                                                            <input type="number" id="inputQuantity{{ $v->id }}" data-price="{{$v->guest_post_price}}" data-web_id="{{$v->id}}" onchange="changeQuantity($(this))" class="form-control" value="{{$arrCookie[$k]->quantity}}" min="1" max="5" />
                                                            <div id="quantityError{{ $v->id }}" class="text-danger" style="display:none;">Quantity cannot exceed 5.</div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 text-center d-flex align-items-end justify-content-center">
                                                        <span class="badge  fs-5 p-2 price-box quantityPrice{{$v->id}}">
                                                            ${{ ($v->guest_post_price * $arrCookie[$k]->quantity) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="post-title-main d-flex mb-3 justify-content-between">

                                                    <div class="col-md-12">
                                                        <div id="linkInputSection{{ $v->id }}" style="display: none;">
                                                            <label class="form-label" for="existingPostUrl{{ $v->id }}">Existing Post URL</label>
                                                            <input type="url" class="form-control" name="existing_post_url" id="existingPostUrl{{ $v->id }}" placeholder="Enter existing post URL">

                                                            <label class="form-label mt-2" for="landingPageUrl{{ $v->id }}">Landing Page URL</label>
                                                            <input type="url" class="form-control" name="landing_page_url" id="landingPageUrl{{ $v->id }}" placeholder="Enter landing page URL">

                                                            <label class="form-label mt-2" for="anchorText{{ $v->id }}">Anchor Text</label>
                                                            <input type="text" class="form-control" name="anchor_text" id="anchorText{{ $v->id }}" placeholder="Enter anchor text">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="post-title-main d-flex mb-3 justify-content-between">
                                                    <div class="col-md-12">


                                                        <div id="uplodefileInputSection{{ $v->id }}">

                                                            <div class="col-md-12 pe-2 ">
                                                                <label class="form-label" for="inputArticleTitle{{$v->id}}">Post Title</label>
                                                                <input type="text" class="form-control inputArticleTitle" name="article_title[]" id="inputArticleTitle{{$v->id}}" required placeholder="Enter post title">

                                                                <div class="valid-feedback"></div>
                                                                <div class="invalid-feedback">Invalid Post Title or Empty Post Title Please Insert Title Without Link.</div>
                                                            </div>
                                                            <label class="form-label" for="inputDocFile{{$v->id}}">Attachments <small>Note: Support only doc, docx</small></label>
                                                            <input type="file" class="form-control attachments-control inputDocFile" name="attachment[]" id="inputDocFile{{$v->id}}" required="">
                                                            <div class="valid-feedback">File type is allowed. You can upload it.</div>
                                                            <div class="invalid-feedback">Invalid file type. Please select a .doc or .docx file.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label" for="inputSpecialInstructions{{$v->id}}">Special Instructions</label>
                                                    <textarea type="text" class="form-control" rows="5" name="special_instructions" id="inputSpecialInstructions{{$v->id}}" required></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="text-center mx-2">

                                                        @if(session('selected_project_id'))
                                                        <button type="submit" class="btn btn-primary checkout-btn">
                                                            <span class="loader-box spinner-border me-1" role="status" aria-hidden="true" style="display: none;"></span>
                                                            Check Out
                                                        </button>
                                                        @else
                                                        <div class="alert alert-warning">
                                                            Please select a project before proceeding.
                                                        </div>
                                                        @endif


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
            </div>
        </div>
    </div>
</div>

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allWebsites as $k => $website)
                @php
                $arrCookie = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

                @endphp
                <tr>
                    <td>{{ $website->id }}</td>
                    <td><a href="{{ $website->website_url }}" target="_blank">{{ $website->website_url }}</a></td>
                    <td>{{ $website->categories }}</td>
                    <td>{{ $website->domain_authority }}</td>
                    <td>${{ $website->guest_post_price }}</td>
                    <td>
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                            data-web_id="{{ $website->id }}"
                            data-price="{{ $website->guest_post_price }}"
                            data-website_url="{{ $website->website_url }}"
                            data-categories="{{ $website->categories }}"
                            data-forbidden_categories="{{ $website->forbidden_categories }}"
                            onclick="addToCart($(this))">
                            Add
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

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

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
        </div>
    </div>
</div>

@endsection

@push('script')


<script>
    $('.inputDocFile').change(function() {
        const selectedFile = this.files[0];
        if (selectedFile) {
            const allowedFileTypes = ['application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];

            if (allowedFileTypes.includes(selectedFile.type)) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).addClass('is-invalid').removeClass('is-valid');
                $('#fileInput').val('');
            }
        }
    });

    function addToCart($this) {
        var $web_id = $this.data('web_id');
        var $user_id = $('#user_id').val();
        var $price = $this.data('price') || 0;
        var $website_url = $this.data('website_url') || '';
        var $categories = $this.data('categories') || '';
        var $forbidden_categories = $this.data('forbidden_categories') || '';

        if ($web_id === undefined || $user_id === undefined) {
            console.error('Missing web_id or user_id:', $web_id, $user_id);
            return;
        }

        var $data = {
            'user_id': $user_id,
            'web_id': $web_id,
            'quantity': 1,
            'price': $price,
            'website_url': $website_url,
            'categories': $categories,
            'forbidden_categories': $forbidden_categories
        };

        var $cartCookie = getCookie('cart');
        var $newCartArr = [];

        if ($cartCookie) {
            $newCartArr = JSON.parse($cartCookie);
        }

        var itemExists = $newCartArr.find(item => item.web_id === $web_id);

        if (itemExists) {
            itemExists.quantity += 1;
        } else {
            $newCartArr.push($data);
        }

        $('.nav-cart-icon').attr('data-item-count', $newCartArr.length);

        setCookie('cart', JSON.stringify($newCartArr), 2);

        updateCartUI($newCartArr);

        showSuccessMessage("Website successfully added to the cart!");

    }

    function showSuccessMessage(message) {
        var toastEl = document.getElementById('liveToast');
        var toastBody = toastEl.querySelector('.toast-body');

        toastBody.textContent = message;

        var toast = new bootstrap.Toast(toastEl, {
            autohide: true,
            delay: 3000
        });
        toast.show();

        refreshPageContent();
    }

    function refreshPageContent() {
        fetch(window.location.href, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, 'text/html');

                var newContent = doc.body.innerHTML;

                document.body.innerHTML = newContent;

            })
            .catch(error => console.error('Error refreshing content:', error));
    }


    function toggleAttachmentType(webId) {
        const fileRadio = document.getElementById(`attachmentFile${webId}`);
        const linkRadio = document.getElementById(`attachmentLink${webId}`);

        const fileInput = document.getElementById(`inputDocFile${webId}`);
        const titleInput = document.getElementById(`inputArticleTitle${webId}`);
        const inputQuantitydiv = document.getElementById(`inputQuantitydiv${webId}`);

        const linkInputSection = document.getElementById(`linkInputSection${webId}`);
        const uplodefileInputSection = document.getElementById(`uplodefileInputSection${webId}`);

        const existingPostUrl = document.getElementById(`existingPostUrl${webId}`);
        const landingPageUrl = document.getElementById(`landingPageUrl${webId}`);
        const anchorText = document.getElementById(`anchorText${webId}`);

        if (fileRadio.checked) {
            // File radio button selected
            fileInput.style.display = 'block';
            titleInput.style.display = 'block';
            inputQuantitydiv.style.display = 'block';

            linkInputSection.style.display = 'none';
            uplodefileInputSection.style.display = 'block';

            fileInput.setAttribute('required', true);
            titleInput.setAttribute('required', true);

            existingPostUrl.removeAttribute('required');
            landingPageUrl.removeAttribute('required');
            anchorText.removeAttribute('required');
        } else if (linkRadio.checked) {
            // Link radio button selected
            fileInput.style.display = 'none';
            titleInput.style.display = 'none';
            inputQuantitydiv.style.display = 'none';

            uplodefileInputSection.style.display = 'none';
            linkInputSection.style.display = 'block';

            fileInput.removeAttribute('required');
            titleInput.removeAttribute('required');

            existingPostUrl.setAttribute('required', true);
            landingPageUrl.setAttribute('required', true);
            anchorText.setAttribute('required', true);
        }
    }

    function updateCartUI(cartItems) {

        var $cartContainer = $('.container');

    }

    function getCookie(name) {

        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();

    }

    function setCookie(name, value, days) {

        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";

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
            $('.nav-cart-icon').attr('data-item-count', $newCartArr.length);
            setCookie('cart', JSON.stringify($newCartArr), 2);
        }

        updateCartUI($newCartArr);

        refreshPageContent();
    }

    function changeQuantity($this) {
        var $quantity = $this.val();
        var $web_id = $this.data('web_id');
        var $price = $this.data('price');
        var $user_id = $('#user_id').val();
        var $newCartArr = [];
        var $cartCookie = getCookie('cart');

        if ($quantity > 5) {
            $('#quantityError' + $web_id).show();
            $this.val(1);
            return;
        } else {
            // Hide error message if quantity is valid
            $('#quantityError' + $web_id).hide();
        }

        if ($cartCookie != '') {
            var $cartArr = JSON.parse($cartCookie);

            $.each($cartArr, function(i, v) {
                if (v.user_id == $user_id && v.web_id == $web_id) {
                    if ($quantity == 0 || $quantity == '' || $quantity == '0') {
                        $cartArr.splice(i, 1);
                    } else {
                        v.quantity = $quantity;

                        $('#quantity' + v.web_id).val($quantity);
                        $('.quantityPrice' + v.web_id).text('$' + $price * $quantity);
                        $('#price' + v.web_id).val($price * $quantity);

                        let $fileUploadSection = $('#uplodefileInputSection' + v.web_id);
                        $fileUploadSection.empty();

                        for (let i = 1; i <= $quantity; i++) {
                            $fileUploadSection.append(`
                                <div class="col-md-12 pe-2">
                                    <label class="form-label" for="inputArticleTitle${v.id}_${i}">Post Title</label>
                                    <input type="text" class="form-control inputArticleTitle" name="article_title[]" id="inputArticleTitle${v.id}_${i}" required placeholder="Enter post title">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Invalid Post Title or Empty Post Title. Please insert a title without a link.</div>
                                </div>
                                <div class="col-md-12 pe-2">
                                    <label for="inputDocFile${v.web_id}_${i}" class="form-label">Attachment ${i} <small>(doc, docx only)</small></label>
                                    <input type="file" class="form-control attachments-control inputDocFile" name="attachment[]" id="inputDocFile${v.web_id}_${i}" required>
                                    <div class="valid-feedback">File type is allowed. You can upload it.</div>
                                    <div class="invalid-feedback">Invalid file type. Please select a .doc or .docx file.</div>
                                </div>
                            `);
                        }
                    }
                }
            });

            toggleAttachmentType($web_id);
        }
    }


    function hasURL(inputString) {
        var urlPattern = /(https?:\/\/[^\s]+)/g;
        return urlPattern.test(inputString);
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

@endif
<script src="{{
        asset_url('libs/bootstrap-select/bootstrap-select.js')
        }}"></script>
<script src="{{ asset_url('libs/select2/select2.js') }}"></script>
<script src="{{ asset_url('js/forms-selects.js') }}"></script>
@endpush