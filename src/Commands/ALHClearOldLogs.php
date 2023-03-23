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
* | Filename:   ALHClearOldLogs.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH\Commands;

use DevRaeph\ALH\Helper\File;
use DevRaeph\ALH\Models\AlhLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ALHClearOldLogs extends Command
{
    public $signature = 'alh:clear-logs';

    public $description = 'Clear all old Logs';

    public function handle(): int
    {
        if (config('alh.logging.to_database') && config('alh.general.clear_logs')) {
            if (AlhLog::count() > 0) {
                AlhLog::whereDate('created_at', '<=', now()->subDays(config('alh.general.retention_db')))->delete();
            }
        }

        if (config('alh.logging.to_file') && config('alh.general.clear_logs')) {
            if (config('alh.general.zip_files_on_delete')) {
                Storage::makeDirectory('zip/tmp/');
                $myZip = new ZipArchive();
                $zipName = 'ALH_ARCHIVED_'.now()->format('Y-m-d').'.zip';
                $myZip->open(storage_path('app/zip/tmp/'.$zipName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
                if (config('alh.logging.file_driver')) {
                    foreach (File::get_files_older(storage_path('app').'/'.config('alh.logging.file_path'), config('alh.general.retention_file')) as $file) {
                        $myZip->addFile($file, basename($file));
                    }
                }
                $myZip->close();
                Storage::disk(config('alh.logging.file_driver'))->makeDirectory(config('alh.logging.file_path').'/!archived');
                Storage::move('/zip/tmp/'.$zipName, config('alh.logging.file_path').'/!archived/'.$zipName);
                File::delete_files_older(storage_path('app').'/'.config('alh.logging.file_path'), config('alh.general.retention_file'));
            }
        }
        $this->comment('[ALH] cleared old log entries in DB');

        return self::SUCCESS;
    }
}
