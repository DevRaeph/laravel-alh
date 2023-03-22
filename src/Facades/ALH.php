<?php

namespace DevRaeph\ALH\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DevRaeph\ALH\ALH
 */
class ALH extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \DevRaeph\ALH\ALH::class;
    }
}
