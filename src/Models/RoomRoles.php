<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRoles extends Model
{
    protected $guarded = [];
    protected $table = 'r_roles';

    public function abilities()
    {
        return $this->belongsToMany(RoomAbilities::class, 'r_ability_r_role', 'r_role_id', 'r_ability_id');
    }
    public function seedAbilities()
    {
        RoomAbilities::insert([
            ['title' => 'DeleteChat'],
            ['title' => 'EditChat'],
            ['title' => 'ViewChat'],
        ]);
    }
    public function chats()
    {
        return $this->belongsToMany(RoomRoles::class, 'chat_role', 'r_role_id', 'chat_id');
    }
    public function channels()
    {
        return $this->belongsToMany(RoomRoles::class, 'channel_role', 'r_role_id', 'chat_id');
    }
    public function allowTo($ability)
    {
        if (is_string($ability)) {
            $ability = RoomAbilities::whereTitle($ability)->firstOrFail();
        }

        $this->abilities()->sync($ability, false);
    }
}
