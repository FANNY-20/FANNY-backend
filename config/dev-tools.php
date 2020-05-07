<?php

return [
    'bottleneck' => [
        'duration' => 1000,
        'only_ajax' => true,
    ],

    'debugger' => [
        'enabled' => env('DEBUGGER_ENABLED', false),

        'database' => [
            'enabled' => env('DEBUGGER_DATABASE_ENABLED', true),

            /*
             *  A warning is raised if number of queries is over this value
             *  Setting it to 0 or null disable the warning
             */
            'max_queries' => env('DEBUGGER_DATABASE_MAX_QUERIES', 0),
        ],

        'memory' => [
            'enabled' => env('DEBUGGER_MEMORY_ENABLED', true),

            /*
             *  A warning is raised if memory peak is over this value
             *  Set the value with the unit, Mo for example
             *  Setting it to 0 or null disable the warning
             */
            'max' => env('DEBUGGER_MEMORY_MAX', 0),
        ],

        'message' => [
            'enabled' => env('DEBUGGER_MESSAGE_ENABLED', true),
        ],

        'model' => [
            'enabled' => env('DEBUGGER_MODEL_ENABLED', true),
        ],

        'request' => [
            'enabled' => env('DEBUGGER_REQUEST_ENABLED', true),
        ],

        'response' => [
            'enabled' => env('DEBUGGER_RESPONSE_ENABLED', false),
        ],

        'time' => [
            'enabled' => env('DEBUGGER_TIME_ENABLED', true),

            /*
            *  A warning is raised if duration is over this value
            *  Set the value in ms
            *  Setting it to 0 or null disable the warning
            */
            'max_app_duration' => env('DEBUGGER_TIME_MAX_APP', 0),
        ],
    ],
];
