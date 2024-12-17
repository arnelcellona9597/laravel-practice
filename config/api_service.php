<?php

return [

    'base_url' => env('API_SERVICE_BASE_URL', "http://systems.shireburn.cloud:18003"),

    'api_key'  => env('API_SERVICE_KEY', ''),

    'company_key'  => env('API_SERVICE_COMPANY_KEY', ''),
    
    'by_pass_published_checking' => env('BY_PASS_PUBLISHED_CHECKING', false),

    'skip_products' =>  env('SKIP_PRODUCTS', ''),
];