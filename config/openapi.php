<?php

declare(strict_types=1);

return [

    'collections' => [

        'default' => [

            'info' => [
                'title' => "Baha'i Library Online",
                'description' => null,
                'version' => '0.0.0',
            ],

            'servers' => [
                [
                    'url' => env('https://0.0.0.0'),
                ],
            ],

            'tags' => [

                [
                    'name' => 'auth',
                    'description' => 'Application auth related endpoints',
                ],

            ],

            'security' => [
                // GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement::create()->securityScheme('JWT'),
            ],

            // Route for exposing specification.
            // Leave uri null to disable.
            'route' => [
                'uri' => '/openapi',
                'middleware' => [],
            ],

            // Register custom middlewares for different objects.
            'middlewares' => [
                'paths' => [
                    //
                ],
            ],

        ],

    ],

    // Directories to use for locating OpenAPI object definitions.
    'locations' => [
        'callbacks' => [
            app_path('OpenApi/Callbacks'),
        ],

        'request_bodies' => [
            app_path('OpenApi/RequestBodies'),
        ],

        'responses' => [
            app_path('OpenApi/Responses'),
        ],

        'schemas' => [
            app_path('OpenApi/Schemas'),
        ],

        'security_schemes' => [
            app_path('OpenApi/SecuritySchemes'),
        ],
    ],

];
