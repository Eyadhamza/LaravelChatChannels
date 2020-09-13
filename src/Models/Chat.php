<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;
use TheProfessor\Laravelchatchannels\Traits\RoomManagement;

class Chat extends Model
{
    use RoomManagement;
    protected $guarded = [];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'chat_participant', 'chat_id', 'participant_id');
    }
    public function roles()
    {
        return $this->belongsToMany(RoomRoles::class, 'chat_role', 'chat_id', 'r_role_id');
    }

}
