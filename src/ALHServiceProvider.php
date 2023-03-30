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
* | Filename:   ALHServiceProvider.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH;

use DevRaeph\ALH\Helper\AuthHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class ALHServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->authorization();
    }

    protected function authorization()
    {
        $this->gate();

        AuthHelper::auth(function ($request) {
            return Gate::check('viewALH', [$request->user()]) || app()->environment('local');
        });
    }

    protected function gate()
    {
        Gate::define('viewALH', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }
}
