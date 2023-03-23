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
* | Filename:   File.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH\Helper;

use DevRaeph\ALH\Enums\BadgeType;

class Badge
{
    public static function get_badge(BadgeType $badgeType, string $text, bool $asLink = false, string $link = '#', string $class = '', string $data = ''): string
    {
        $typeS = '<span ';
        $typeE = '</span>';
        if ($asLink) {
            $typeS = '<a ';
            $typeE = '</a>';
        }

        $myContent = $typeS.(($asLink) ? ('href="'.$link.'"') : '');
        $myContentEnd = $class.'" '.(($data != '') ? $data : '').' >'.$text.$typeE;

        return match ($badgeType) {
            BadgeType::PRIMARY => $myContent.' class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:hover:bg-blue-300 dark:text-blue-800 '.$myContentEnd,
            BadgeType::DARK => $myContent.' class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:hover:bg-gray-800 dark:text-gray-300 '.$myContentEnd,
            BadgeType::DANGER => $myContent.' class="bg-red-100 hover:bg-red-200 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:hover:bg-red-300 dark:text-red-900 '.$myContentEnd,
            BadgeType::SUCCESS => $myContent.' class="bg-green-100 hover:bg-green-200 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:hover:bg-green-300 dark:text-green-900 '.$myContentEnd,
            BadgeType::WARNING => $myContent.' class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:hover:bg-yellow-300 dark:text-yellow-900 '.$myContentEnd,
            BadgeType::INDIGO => $myContent.' class="bg-indigo-100 hover:bg-indigo-200 text-indigo-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:hover:bg-indigo-300 dark:text-indigo-900 '.$myContentEnd,
            BadgeType::PURPLE => $myContent.' class="bg-purple-100 hover:bg-purple-200 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:hover:bg-purple-300 dark:text-purple-900 '.$myContentEnd,
            BadgeType::PINK => $myContent.' class="bg-pink-100 hover:bg-pink-200 text-pink-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:hover:bg-pink-300 dark:text-pink-900 '.$myContentEnd,
        };
    }

    public static function get_badge_small(BadgeType $badgeType, string $text, bool $asLink = false, string $link = '#', string $class = '', string $data = ''): string
    {
        $typeS = '<span ';
        $typeE = '</span>';
        if ($asLink) {
            $typeS = '<a ';
            $typeE = '</a>';
        }

        $myContent = $typeS.(($asLink) ? ('href="'.$link.'"') : '');
        $myContentEnd = $class.'" '.(($data != '') ? $data : '').' >'.$text.$typeE;

        return match ($badgeType) {
            BadgeType::PRIMARY => $myContent.' class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:hover:bg-blue-300 dark:text-blue-800 '.$myContentEnd,
            BadgeType::DARK => $myContent.' class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:hover:bg-gray-800 dark:text-gray-300 '.$myContentEnd,
            BadgeType::DANGER => $myContent.' class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:hover:bg-red-300 dark:text-red-900 '.$myContentEnd,
            BadgeType::SUCCESS => $myContent.' class="bg-green-100 hover:bg-green-200 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:hover:bg-green-300 dark:text-green-900 '.$myContentEnd,
            BadgeType::WARNING => $myContent.' class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:hover:bg-yellow-300 dark:text-yellow-900 '.$myContentEnd,
            BadgeType::INDIGO => $myContent.' class="bg-indigo-100 hover:bg-indigo-200 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:hover:bg-indigo-300 dark:text-indigo-900 '.$myContentEnd,
            BadgeType::PURPLE => $myContent.' class="bg-purple-100 hover:bg-purple-200 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:hover:bg-purple-300 dark:text-purple-900 '.$myContentEnd,
            BadgeType::PINK => $myContent.' class="bg-pink-100 hover:bg-pink-200 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:hover:bg-pink-300 dark:text-pink-900 '.$myContentEnd,
        };
    }
}
