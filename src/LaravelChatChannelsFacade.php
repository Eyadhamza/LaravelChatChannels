<?php

namespace TheProfessor\Laravelchatchannels;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TheProfessor\Laravelchatchannels\Laravelchatchannels
 */
class LaravelchatchannelsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravelchatchannels';
    }
}
