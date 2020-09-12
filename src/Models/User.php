<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use TheProfessor\Laravelchatchannels\Traits\Participate;

class User extends Authenticatable
{
    use Participate;
    protected $guarded = [];
    //just for testing
}
