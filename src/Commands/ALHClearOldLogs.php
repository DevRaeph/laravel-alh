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
* | Project:    test-alh
* | Filename:   ALHClearOldLogs.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH\Commands;

use DevRaeph\ALH\Models\AlhLog;
use Illuminate\Console\Command;

class ALHClearOldLogs extends Command
{
    public $signature = 'alh:clear-logs';

    public $description = 'Clear all old Logs';

    public function handle(): int
    {
        if (config('alh.logging.to_database') && config('alh.general.clear_logs')) {
            if (AlhLog::count() > 0) {
                AlhLog::whereDate('created_at', '<=', now()->subDays(config('alh.general.retention')))->delete();
            }
        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
