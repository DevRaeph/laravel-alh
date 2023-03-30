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
 * | File:      AuthHelper.php
 * | Created:   30.03.2023
 * | Copyright (c) Raphael Planer.
 * | All Rights Reserved
 * |__________________________________________________________
 */

namespace DevRaeph\ALH\Helper;

use Closure;

class AuthHelper
{
    public static $authUsing;

    public static function auth(Closure $callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }
}
