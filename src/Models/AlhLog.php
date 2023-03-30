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
* | Filename:   AlhLog.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH\Models;

use DevRaeph\ALH\Enums\BadgeType;
use DevRaeph\ALH\Enums\LogType;
use DevRaeph\ALH\Helper\Badge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AlhLog extends Model
{
    protected $table = 'alh_logs';

    protected $guarded = [];

    protected $fillable = ['type', 'message', 'exception', 'code', 'file_line', 'issuer'];

    public function issuer(): MorphTo
    {
        return $this->morphTo('issuer');
    }

    public function getBadgeAttribute()
    {
        return match ($this->type) {
            LogType::ERROR->value => Badge::get_badge(BadgeType::DANGER, \Str::upper($this->type), true, 'javascript:void(0)'),
            LogType::INFO->value => Badge::get_badge(BadgeType::INDIGO, \Str::upper($this->type), true, 'javascript:void(0)'),
            LogType::WARNING->value => Badge::get_badge(BadgeType::WARNING, \Str::upper($this->type), true, 'javascript:void(0)'),
            LogType::SUCCESS->value => Badge::get_badge(BadgeType::SUCCESS, \Str::upper($this->type), true, 'javascript:void(0)'),
            LogType::PENDING->value => Badge::get_badge(BadgeType::PURPLE, \Str::upper($this->type), true, 'javascript:void(0)'),
        };
    }
}
