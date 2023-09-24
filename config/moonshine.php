<?php

use MoonShine\Exceptions\MoonShineNotFoundException;
use MoonShine\Models\MoonshineUser;
use App\Models\User;

return [
    'title' => env('MOONSHINE_TITLE', 'Long Time Service Valuation'),
	'logo' => env('MOONSHINE_LOGO', ''),

    'route' => [
        'prefix' => '',
        'middleware' => ['moonshine'],
        'custom_page_slug' => 'custom_page',
        'notFoundHandler' => MoonShineNotFoundException::class
    ],
    'use_migrations' => true,
    'use_notifications' => true,
    'auth' => [
        'enable' => true,
        'fields' => [
            'username' => 'email',
            'password' => 'password',
            'name' => 'name',
            'avatar' => 'avatar'
        ],
        /* Guard is responsible for authenticating a user. 
         * It takes some form of input and validate user identity in it. */
        'guard' => 'admin',
        'guards' => [
            'admin' => [
                /*How to make the validation is implemented by a driver.*/
                'driver'   => 'session',
                /**The driver may use a user provider to retrieve user information.*/
                'provider' => 'admin',
            ],
        ],
        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => User::class,
            ],
        ],
        'footer' => ''
    ],
    'locales' => [
        'en'
    ],
    'middlewares' => [],
    'tinymce' => [
        'file_manager' => 'laravel-filemanager', // or 'laravel-filemanager' prefix for lfm
        'token' => env('MOONSHINE_TINYMCE_TOKEN', ''),
        'version' => env('MOONSHINE_TINYMCE_VERSION', '6')
    ],

    'socialite' => [
        // 'github' => '/images/icons/github-mark.svg'
    ],
    'header' => null, // blade path
    'footer' => [
        'copyright' => 'All Right Reserved. ClientName',
        // 'nav' => [
        //     'https://github.com/moonshine-software/moonshine/blob/1.5.x/LICENSE.md' => 'License',
        //     'https://moonshine.cutcode.dev' => 'Documentation',
        //     'https://github.com/moonshine-software/moonshine' => 'GitHub',
        // ],
    ]
];
