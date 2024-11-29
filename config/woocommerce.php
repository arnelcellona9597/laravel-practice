<?php

return [

    'url' => env('WC_URL', ''),

    'consumer_key' => env('WC_CONSUMER_KEY', ''),

    'consumer_secret' => env('WC_CONSUMER_SECRET', ''),

    'options' => [

        'version' => 'wc/v3',

        'verify_ssl' => false,
        
        'timeout' => 2000
    ],
    
    'webhook_secret' => env('WC_WEBHOOK_KEY', ''),
];