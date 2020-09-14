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
        $participant = Participant::where('id', $id)->get()->first();


        return $participant;
    }
}
