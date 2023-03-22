<?php

namespace DevRaeph\ALH\Commands;

use Illuminate\Console\Command;

class ALHClearOldLogs extends Command
{
    public $signature = 'alh:clear-logs';

    public $description = 'Clear all old Logs';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
