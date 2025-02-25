<?php

declare(strict_types=1);

return [
    'access_key' => env('ACCESS_SCREEN_KEY', 'REPLACE_WITH_ACCESS_KEY'),
    'lifetime' => env('ACCESS_SCREEN_KEY_LIFETIME'), // minutes
    'app_name' => env('ACCESS_SCREEN_APP_NAME', env('APP_NAME')),
    'except' => [], // URIs to exclude from access screen.
    'middleware' => ['web'],
    'uri' => env('ACCESS_SCREEN_URI', 'get-access'),
    'title_line1' => env('ACCESS_SCREEN_TITLE_LINE1', 'Please enter the key'),
    'title_line2' => env('ACCESS_SCREEN_TITLE_LINE2', 'to access the application'),
    'description' => env(
        'ACCESS_SCREEN_DESCRIPTION',
        'To proceed using the application, please enter valid access key below.',
    ),
    'input_type' => env('ACCESS_SCREEN_INPUT_TYPE', 'text'),
];
