<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '2148581772195938',
        'client_secret' => 'cd81725c17cee8e7f1a76724272dfe1a',
        'redirect' => 'https://cms.com/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '606410528411-jdp7jvst1u00jffsd43bvb41qc5rhod1.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://cms.com/auth/google/callback',
    ],

];
