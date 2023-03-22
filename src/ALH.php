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
* | Project:    test-alh
* | Filename:   ALH.php
* | Created:    22.03.2023 (21:42:39)
* | Copyright (C) 2023 Develogix Agency e.U. All Rights Reserved
* | Website:    https://develogix.at
*/

namespace DevRaeph\ALH;

use DevRaeph\ALH\Enums\LogType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ALH
{
    protected Model $issuer;

    protected bool $toDB = false;

    protected bool $toFile = false;

    protected LogType $logType;

    protected string $message;

    protected ?\Exception $exception;

    public function __construct()
    {
    }

    public function toDB()
    {
        $this->toDB = true;

        return $this;
    }

    public function toFile()
    {
        $this->toFile = true;

        return $this;
    }

    public function setIssuer(Model $issuer)
    {
        $this->issuer = $issuer;

        return $this;
    }

    public function error(string $message, ?\Exception $exception = null): bool
    {
        $this->logType = LogType::ERROR;
        $this->message = $message;
        $this->exception = $exception;

        return $this->log();
    }

    private function getFileLine(): string
    {
        $dbgt = debug_backtrace();
        $fileName = (\Str::contains($dbgt[4]['file'], '/'))
            ? mb_substr($dbgt[4]['file'], strrpos($dbgt[4]['file'], '/') + 1)
            : mb_substr($dbgt[4]['file'], strrpos($dbgt[4]['file'], '\\') + 1);
        $line = $dbgt[4]['line'];

        return $fileName.' @ line '.$line;
    }

    private function log(): bool
    {
        if (! $this->toDB && ! $this->toFile) {
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

        if ($this->toDB) {
            $this->logToDB();
        }

        if ($this->toFile) {
            $this->logToFile();
        }

        return true;
    }

    private function logToDB()
    {
        return true;
    }

    private function logToFile()
    {
        Log::error('[ALH] ['.\Str::upper($this->logType->value).'] '.
            now()->format('Y-m-d H:i:s').' | '.
            $this->message.
            (($this->getFileLine()) ? ' | '.$this->getFileLine() : '').
            (($this->exception) ? ' | '.$this->exception->getMessage() : '')
        );

        return true;
    }
}
