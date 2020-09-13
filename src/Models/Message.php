<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function messagable()
    {
        return $this->morphTo();
    }

    public function participant()
    {

        return $this->belongsTo(Participant::class);
    }

    public function getSender($id)
    {
        $participant=Participant::where('id',$id)->get()->first();

        return $participant;
    }
//    public function sender($value)
//    {
//        $participant=Participant::where('id',$value)->get()[0];
//        dd($participant->participatable);
//        return $participant;
//    }
}
