
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
* | Filename:   web.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

use DevRaeph\ALH\Http\Controllers\ALHController;
use Illuminate\Support\Facades\Route;

Route::get('alh-logs', [ALHController::class, 'index'])->name('alh.index');
