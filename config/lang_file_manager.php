<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | The locales displayed in the dropdown menu to select the language.
    |
    */

    'locales'    => [
        'it' => 'Italiano',
        'en' => 'Inglese',
        'es' => 'Spagnolo',
        'fr' => 'Francese',
        'de' => 'Tedesco',
    ],

    /*
    |--------------------------------------------------------------------------
    | Extra middleware
    |--------------------------------------------------------------------------
    |
    | The middleware to be added to the routes published by this package.
    |
    */

    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Placeholders
    |--------------------------------------------------------------------------
    |
    | The list of placeholders to show above each field.
    |
    */

    'placeholders' => [
        'auth' => [
            'throttle' => ':seconds'
        ],
    ],

];
