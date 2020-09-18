<?php


namespace TheProfessor\Laravelrooms\Models;

use Illuminate\Database\Eloquent\Model;
use TheProfessor\Laravelrooms\Traits\RoomManagement;

class Room extends Model
{
    use RoomManagement;
    protected $guarded = [];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'participant_room', 'room_id', 'participant_id');
    }
    public function roles()
    {
        return $this->belongsToMany(RoomRoles::class, 'room_role', 'room_id', 'r_role_id');
    }
}
