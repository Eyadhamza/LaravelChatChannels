<?php


namespace TheProfessor\Laravelrooms\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use TheProfessor\Laravelrooms\Traits\Participate;


class User extends Authenticatable
{
    use Participate;
    protected $guarded = [];
    //just for testing
}
