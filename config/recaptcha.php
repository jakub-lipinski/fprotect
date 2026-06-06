<?php

return [
    'enabled' => env('RECAPTCHA_ENABLED', true),
    'site_key' => env('RECAPTCHA_SITE_KEY', ''),
    'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),
    'min_score' => (float) env('RECAPTCHA_MIN_SCORE', 0.5),
    'action' => env('RECAPTCHA_ACTION', 'contact'),
    'api_domain' => env('RECAPTCHA_API_DOMAIN', 'www.google.com'),
    'timeout' => (int) env('RECAPTCHA_TIMEOUT', 10),
];
