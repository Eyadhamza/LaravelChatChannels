<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;

class RoomAbilities extends Model
{
    protected $guarded = [];
    protected $table = 'r_abilities';

    public function roles()
    {
        return $this->belongsToMany(RoomRoles::class, 'r_ability_r_role', 'r_ability_id', 'r_role_id');
    }
}
