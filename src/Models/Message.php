<?php


namespace TheProfessor\Laravelchatchannels\Models;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];

    public function messageeable()
    {
        return $this->morphTo();
    }

}
