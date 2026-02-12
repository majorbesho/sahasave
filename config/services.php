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
    ],

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'model' => env('OPENAI_MODEL', 'gpt-4'),
        'temperature' => env('AI_TEMPERATURE', 0.7),
        'max_tokens' => env('AI_MAX_TOKENS', 4000),
    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => 'your_redirect_url',
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'your_redirect_url',
    ],

    // We need to provide default values to validate types
    'firebase' => [
        'database_url' => env('FIREBASE_DATABASE_URL', ''),
        'project_id' => env('SehaSave.com-c6ec9', ''),
        'private_key_id' => env('db4fd71ac72ee9fdc73a652369e42b6bf28375f6', 'your-key'),
        // replacement needed to get a multiline private key from .env
        'private_key' => str_replace("\\n", "\n", env('MIIEugIBADANBgkqhkiG9w0BAQEFAASCBKQwggSgAgEAAoIBAQCj4mQ6rvt+yZQe\n0uvMv+ERIch3AoIBsWa16+qee9F9K3f3FIa8jHz59rkLG1X+mzpvcPW2f9c1ZKDz\nkNwh0krxAiMQcXMGrpNNV3KOrXvn4pxw6qZqCy2PrV925ZwQRyeDYmDRI7sPA6jB\nEh5/xVrALqv3mvxnk+8xisvV8OAa+8wXJZP/qjf15Sqt4U4SaHdsBudfGr1wLTmR\nkYN22GHfvM4umMbKUcjeATmoSEsvDda1hpPbuVAXABCoK8gnhLKvAfXnKBG43F3a\nnSQ5WDzuAob6GXzUpU3SjXx+SV4lDQ6GR5E60cR16dM0xVX3fPLj8gZycnIuMFeV\nzEPHWqB5AgMBAAECggEAAPoYic+3kyIjI/r/wDLv7EGyX7PYDLSvGLwt3bEkUGD6\nu4V0h0NC1SmH1IJlCEOw4BxXmW8VT3dL4Do5Q7bZe6qp3pjZVcOv5o6Nq2UEZ6Wx\ns/8dsmT70F8F7wmjA4C6SLKLD1tNcjAXhXbrQvmThxdOiJP0qshM5sBtvJb6YQX9\ni7ofraMPBiFgczE9z51yqty8j2447r1jCfqT1RXknjuZ7RsuXWjjbnQtdtBjgEXS\nDlYTh0Oz9LMx+ThnzhACJCaCPrf33vzAvi4RnJCMEhrcENO5a1v8KXq4qaTg3KtZ\nRrgp7OZ2kBEDClE2CqwLqTHlETbeqoPt98E+VMKOsQKBgQDM7x1eblvlU+i8cwB9\nVZD9m0ceTp6MsVK6+/InJ8wJm5eZgzO5LqJ5/3++vbG+rlYAHJ1DesWdYCbokZK+\nnsCIQ5eFBM5Yb7fdre0jqlo1soFeMlXCvbzL0/yScnOFWc/AEsXJEsDNe7f6Brhj\nGQCu9qZQAcycN8b5LT5g57zKaQKBgQDMuLAWZvefY56kBAEieqcpJO7ij08Mtrcf\nm7jgUnBi/utKMMFJLcKUOAbmJDOPOymsdWgy2SROZ+toMmUwN2vhlHPUrmDfgES0\nP1rvvsXISrQTvQIYXJgPBEtUQaOudu5hn14ryDT2siGHDgG0ct1bDE2OTGMCrbH3\n0ZqfyY7DkQKBgG+733NhEFGU0kwNF7M+N/NN+hSYIPHsrIKuY3Tdye1jG+DjHAxX\nVNbXazsACi1AuDsPXt8vzRblGdGrrSqpO6gP0kkAOdEV+FWxQp4zf0PPs6E8KG4p\nLQqk5gyiwkFumkrK8XOT+fMPBVwY1eeR9kFu0XbFxF1YO/AXru7+6nwhAoGAV/Vq\nQtXOwr7MpG/MBQJp2/WwZctpDW9b0srXbho9i2s3sNKt2UE9/uzrmeon9PxYdW6k\nbGR7guyHamdsroDBa1SbR9/8Y0r7Oe6WpbdzxxDBulFVGx59fsY7j2H8b7NNzMfq\ncCk/CFeUrDBKbzuC++GXWPJdAAOdGXsHUmwJWOECfyMdTD41pYkZAUkdCBqpyY+X\nMXZYBKHUftl819aADcjEAHkmarfneebjBYk0XkA0DvgYgL/qtTxEvkR0Aqu4RlOO\nz6wC7iGTY0hP9GwZHAK6OFCeUhmOagzCfLu6wGpAR+c0amNcAR+1CAd33FLX1R7G\nmPJ2w2vDlFaZbCaUO9E=', '')),
        'client_email' => env('firebase-adminsdk-8lkhz@SehaSave.com -c6ec9.iam.gserviceaccount.com', 'e@email.com'),
        'client_id' => env('108762015958605330101', ''),
        'client_x509_cert_url' => env('FIREBASE_CLIENT_x509_CERT_URL', ''),
    ],
    'pusher' => [
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ],
    ],



];
