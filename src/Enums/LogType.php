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
* | Filename:   LogType.php
* | Created:    22.03.2023 (22:09:24)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH\Enums;

enum LogType: string
{
    case ERROR = 'error';
    case INFO = 'info';
    case WARNING = 'warning';
    case SUCCESS = 'success';
    case PENDING = 'pending';
}
