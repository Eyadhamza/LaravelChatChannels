<?php


namespace TheProfessor\Laravelchatchannels\Models;


use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded=[];

    public function participants()
    {
        return $this->belongsToMany(Participation::class, 'channel_participant', 'channel_id', 'participant_id');
    }

}
