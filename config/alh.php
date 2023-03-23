<?php
/*
*       ____                        __                    _
*      / __ \  ___  _   __  ___    / /  ____    ____ _   (_)   _  __
*     / / / / / _ \| | / / / _ \  / /  / __ \  / __ `/  / /   | |/_/
*    / /_/ / /  __/| |/ / /  __/ / /  / /_/ / / /_/ /  / /   _>  <
*   /_____/  \___/ |___/  \___/ /_/   \____/  \__, /  /_/   /_/|_|
*                                         /____/
*  ___________________________________________________________________
* | Author:     Develogix Agency e.U. - Raphael Planer
* | E-Mail:     office@develogix.at
* | Project:    Another Logging Helper
* | Filename:   alh.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/
return [
    'logging' => [
        'in_production' => env('ALH_LOG_IN_PRODUCTION', false),
        'to_database' => env('ALH_TO_DB', false),
        'to_file' => env('ALH_TO_FILE', true),
        'file_driver' => env('ALH_FILE_DRIVER', 'local'), //enter disk name
        'file_path' => env('ALH_FILE_PATH', 'logs_alh'),
        'separate_by_type' => env('ALH_SEPARATE_BY_TYPE', false),
    ],
    'general' => [
        'clear_logs' => false,
        'retention_db' => env('ALH_LOG_RETENTION_DB', 7), //Keep Logs for 7 days by default
        'retention_file' => env('ALH_LOG_RETENTION_FILE', 7), //Keep Logs for 7 days by default
        'zip_files_on_delete' => true,
    ],

];
