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
* | Filename:   ALH.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH;

use DevRaeph\ALH\Enums\LogType;
use DevRaeph\ALH\Models\AlhLog;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ALH
{
    private string $path;

    private string $fileName;

    private ?Model $issuer;

    private bool $toDB = false;

    private bool $toFile = false;

    private LogType $logType;

    private string $message;

    private ?\Exception $exception;

    private ?string $bt_line;

    private ?string $bt_function;

    private ?string $bt_file;

    public function __construct()
    {
        $this->toDB = false;
        $this->toFile = false;
        $this->path = config('alh.logging.file_path');
        $this->fileName = 'ALH_LOG_'.now()->format('Y-m-d').'.log';
    }

    /**
     * Log only to DataBase
     *
     * @return $this
     */
    public function toDB(): ALH
    {
        $this->toDB = true;

        return $this;
    }

    /**
     * Log only to File
     *
     * @return $this
     */
    public function toFile(): ALH
    {
        $this->toFile = true;

        return $this;
    }

    /**
     * Set issuer if any exists
     *
     * @param  Model  $issuer
     * @return $this
     */
    public function setIssuer(?Model $issuer): ALH
    {
        $this->issuer = $issuer;

        return $this;
    }

    /**
     * Log error message
     *
     * @param  string  $message message of the log
     * @param  \Exception|null  $exception Exception if any exists
     *
     * @throws \Exception
     */
    public function error(string $message, ?\Exception $exception = null): void
    {
        $this->logType = LogType::ERROR;
        $this->log($message, $exception);
    }

    /**
     * Log warning message
     *
     * @param  string  $message message of the log
     * @param  \Exception|null  $exception Exception if any exits
     *
     * @throws \Exception
     */
    public function warning(string $message, ?\Exception $exception = null): void
    {
        $this->logType = LogType::WARNING;
        $this->log($message, $exception);
    }

    /**
     * Log success message
     *
     * @param  string  $message message of the log
     *
     * @throws \Exception
     */
    public function success(string $message): void
    {
        $this->logType = LogType::SUCCESS;
        $this->log($message, null);
    }

    /**
     * Log info message
     *
     * @param  string  $message message of the log
     *
     * @throws \Exception
     */
    public function info(string $message): void
    {
        $this->logType = LogType::INFO;
        $this->log($message, null);
    }

    /**
     * Log pending message
     *
     * @param  string  $message message of the log
     *
     * @throws \Exception
     */
    public function pending(string $message): void
    {
        $this->logType = LogType::PENDING;
        $this->log($message, null);
    }

    private function log(string $message, ?\Exception $exception = null): ALH
    {
        if (config('app.env') == 'production' && ! config('alh.logging.in_production')) {
            if (! config('app.debug')) {
                return $this;
            }
        }

        $this->message = $message;
        $this->exception = $exception;

        if (config('alh.logging.separate_by_type')) {
            $this->fileName = 'ALH_'.\Str::upper($this->logType->value).'_'.now()->format('Y-m-d').'.log';
        }

        $i = 1;
        if (! $this->toDB && ! $this->toFile) {
            $i = 2;
            if (config('alh.logging.to_database') && config('alh.logging.to_file')) {
                $this->toDB = true;
                $this->toFile = true;
            } elseif (config('alh.logging.to_database')) {
                $this->toDB = true;
            } elseif (config('alh.logging.to_file')) {
                $this->toFile = true;
            } else {
                throw new \Exception('[ALH] no driver configured!');
            }
        }

        $dbgt = debug_backtrace();
        $this->bt_file = (\Str::contains($dbgt[$i]['file'], '/'))
            ? mb_substr($dbgt[$i]['file'], strrpos($dbgt[$i]['file'], '/') + 1)
            : mb_substr($dbgt[$i]['file'], strrpos($dbgt[$i]['file'], '\\') + 1);
        $this->bt_line = (string)$dbgt[$i]['line'];
        $this->bt_function = $dbgt[$i]['function'];

        if ($this->toDB) {
            $this->logToDB();
        }

        if ($this->toFile) {
            $this->logToFile();
        }

        return $this;
    }

    private function logToDB(): void
    {
        $loggingInstance = AlhLog::create([
            'type' => $this->logType->value,
            'message' => $this->message,
            'exception' => ($this->exception != null) ? $this->exception->getMessage() : null,
            'code' => ($this->exception != null) ? $this->exception->getCode() : null,
            'file_line' => $this->bt_file.' @ '.$this->bt_line.' - '.$this->bt_function,
        ]);
        if (isset($this->issuer) && $this->issuer != null) {
            $loggingInstance->issuer()->save($this->issuer);
        }
    }

    private function getLogFile(): Filesystem
    {
        $myStorage = Storage::disk(config('alh.logging.file_driver'));
        if (! $myStorage->directoryExists(config('alh.logging.file_path'))) {
            $myStorage->makeDirectory(config('alh.logging.file_path'));
            $myStorage->put(config('alh.logging.file_path').'/.gitignore', '');
        }

        if (! $myStorage->exists($this->path.'/'.$this->fileName)) {
            $myStorage->put($this->path.'/'.$this->fileName, '');
        }

        return $myStorage;
    }

    private function logToFile(): void
    {
        $storage = $this->getLogFile();
        $data = '[ALH]['.\Str::upper($this->logType->value).'] '.
            now()->format('Y-m-d H:i:s').' | '.
            $this->message.
            ((isset($this->bt_file)) ? ' | '.$this->bt_file.' @ '.$this->bt_line.' - '.$this->bt_function : '').
            (($this->exception) ? ' | '.$this->exception->getMessage() : '');
        $storage->prepend($this->path.'/'.$this->fileName, $data);
    }
}
