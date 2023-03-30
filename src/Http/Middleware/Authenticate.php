<?php
/*
 *    _____              ______                    _
 *   (____ \            (_____ \                  | |
 *    _   \ \ ____ _   _ _____) ) ____  ____ ____ | | _
 *   | |   | / _  ) | | (_____ ( / _  |/ _  )  _ \| || \
 *   | |__/ ( (/ / \ V /      | ( ( | ( (/ /| | | | | | |
 *   |_____/ \____) \_/       |_|\_||_|\____) ||_/|_| |_|
 *                                          |_|
 *  ---------------------------------------------------------
 * | Author:    Raphael Planer aka DevRaeph
 * | Email:     me@devraeph.com
 * | Project:   package-tester
 * | File:      Authenticate.php
 * | Created:   30.03.2023
 * | Copyright (c) Raphael Planer.
 * | All Rights Reserved
 * |__________________________________________________________
 */

namespace DevRaeph\ALH\Http\Middleware;

use DevRaeph\ALH\Helper\AuthHelper;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|null
     */
    public function handle($request, $next)
    {
        return AuthHelper::check($request) ? $next($request) : abort(403);
    }
}

