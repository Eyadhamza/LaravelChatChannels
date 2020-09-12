<?php


namespace TheProfessor\Laravelchatchannels\Traits;

use TheProfessor\Laravelchatchannels\Models\RoomRoles;

trait RoomManagement
{
    public function messages()
    {
        return $this->morphMany('TheProfessor\Laravelchatchannels\Models\Message', 'messagable');
    }
    public function addMessage($sender, $messageBody)
    {
        return $this->messages()->create(['sender_id' => $sender,'body' => $messageBody]);
    }
    public function allMessages()
    {
        return $this->messages()->get();
    }
    public function setParticipants($participants)
    {
        $this->participants()->attach($participants);

        return $this;
    }

    public function givePermissions($participant, string $roleTitle, $ability = [])
    {
        $role = $participant->addRole($roleTitle, $this);

        (new RoomRoles())->seedAbilities();

        $role->allowTo($ability);

        return $role;
    }

    public function allAbilities()
    {
        return $this->roles
            ->map->abilities
            ->flatten()->pluck('title')->unique();
    }
}
