<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function messageeable()
    {
        return $this->morphTo();
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
//    public function sender($value)
//    {
//        $participant=Participant::where('id',$value)->get()[0];
//        dd($participant->participatable);
//        return $participant;
//    }
}
