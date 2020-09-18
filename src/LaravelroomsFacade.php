<?php

namespace TheProfessor\Laravelrooms;

use Illuminate\Support\Facades\Facade;

class LaravelroomsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravelrooms';
    }
}
