<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $guarded = [];

    public function participants()
    {

        return $this->belongsToMany(Participation::class, 'chat_participant', 'chat_id', 'participant_id');
    }
}
