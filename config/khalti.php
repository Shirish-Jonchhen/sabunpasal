<?php

return [
    'public_key' => env('KHALTI_PUBLIC_KEY'),
    'secret_key' => env('KHALTI_SECRET_KEY'),
    'base_url' => env('KHALTI_BASE_URL', 'https://a.khalti.com/api/v2'),
    'return_url' => env('KHALTI_RETURN_URL', env('APP_URL') . '/payment/khalti/return'),
];
