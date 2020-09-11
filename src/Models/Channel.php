<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;
use TheProfessor\Laravelchatchannels\Traits\RoomManagement;

class Channel extends Model
{
    use RoomManagement;
    protected $guarded = [];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'channel_participant', 'channel_id', 'participant_id');
    }
    public function roles()
    {
        return $this->belongsToMany(RoomRoles::class, 'channel_role', 'channel_id', 'r_role_id');
    }
}
