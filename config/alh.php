<?php

return [
    'logging' => [
        'in_productions' => env('ALH_LOG_IN_PRODUCTION', false),
        'to_file' => env('ALH_TO_FILE', true),
        'to_database' => env('ALH_TO_DB', true),
    ],
    'general' => [
        'clear_logs' => false,
        'retention' => env('ALH_LOG_RETENTION', 7), //Keep Logs for 7 days by default
    ],

];
