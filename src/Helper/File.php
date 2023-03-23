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

class File
{
    /**
     * Checks if a folder exist and return canonicalized absolute pathname (long version)
     *
     * @param  string  $folder the path being checked.
     * @return mixed returns the canonicalized absolute pathname on success otherwise FALSE is returned
     */
    public static function dir_exists($folder)
    {
        // Get canonicalized absolute pathname
        $path = realpath($folder);

        // If it exist, check if it's a directory
        if ($path !== false and is_dir($path)) {
            // Return canonicalized absolute pathname
            return $path;
        }

        // Path/folder does not exist
        return false;
    }

    public static function getReadableFileSize(int $sizeInBytes, bool $int = false)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        if ($sizeInBytes == 0) {
            return '0 '.$units[1];
        }

        for ($i = 0; $sizeInBytes > 1024; $i++) {
            $sizeInBytes /= 1024;
        }
        if ($int) {
            return round($sizeInBytes, 2);
        }

        return round($sizeInBytes, 2).' '.$units[$i];
    }

    public static function get_files_older($dir, int $older_then): array
    {
        $myFiles = [];
        if (! self::dir_exists($dir)) {
            return $myFiles;
        }
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) {
                continue;
            }
            if (time() - filemtime("$dir/$file") >= 60 * 60 * 24 * $older_then) {
                if ($file != '.gitignore') {
                    $myFiles[] = "$dir/$file";
                }
            }
        }

        return $myFiles;
    }

    public static function delete_files_older($dir, int $older_then)
    {
        if (! self::dir_exists($dir)) {
            return;
        }
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) {
                continue;
            }
            if (is_dir("$dir/$file")) {
                self::delete_files_older("$dir/$file", $older_then);
            } else {
                if (time() - filemtime("$dir/$file") >= 60 * 60 * 24 * $older_then) {
                    unlink("$dir/$file");
                }
            }
        }
    }
}
