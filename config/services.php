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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],


    'pagseguro' => [
            'environment' => env(
                'PAGSEGURO_ENV',
                'sandbox',
            ),

            'sandbox' => [
                'base_url' =>
                    'https://sandbox.api.pagseguro.com',
            ],

            'production' => [
                'base_url' =>
                    'https://api.pagseguro.com',
            ],

            'token' => env('PAGSEGURO_TOKEN'),

        // 'env' => env('PAGSEGURO_ENV', 'sandbox'),
        // 'email' => env('PAGSEGURO_EMAIL'),
        // 'token' => env('PAGSEGURO_TOKEN'),
        // 'sandbox' => [
        //     'email' => env('PAGSEGURO_SANDBOX_EMAIL'),
        //     'token' => env('PAGSEGURO_SANDBOX_TOKEN'),
        //     'session_url' =>'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions',
        //     'pre_approvals_url' =>'https://ws.sandbox.pagseguro.uol.com.br/v2/preapprovals',
        //     'transactions_url' =>'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions',
        //     'javascript_url' =>'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js',
        // ],

        // 'production' => [
        //     'email' => env('PAGSEGURO_PRODUCTION_EMAIL'),
        //     'token' => env('PAGSEGURO_PRODUCTION_TOKEN'),
        //     'session_url' => 'https://ws.pagseguro.uol.com.br/v2/sessions',
        //     'pre_approvals_url' => 'https://ws.pagseguro.uol.com.br/v2/preapprovals',
        //     'transactions_url' => 'https://ws.pagseguro.uol.com.br/v2/transactions',
        //     'javascript_url' => 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js',
        // ],
    ],
];
