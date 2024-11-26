
<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id'         => env('PAYPAL_CLIENT_ID', 'AZYzxQS5DGG-2Nk15neSEftc2iIlH3RfAfpYVR6EIMLbnIQJAkWmxGH0NXJaK25rIvNlwmdiwfoCySqR'),
        'client_secret'     => env('PAYPAL_SECRET', ' EN1jmNlw7wt2qBjES-aAXaFrrMdoKaXvixUhPkgWcuj-DjHKJr-Nr3YMYQbOBhj7Cuf1f_ky0rdVVu1p'),
        'app_id'            => 'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => '',
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''),
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
