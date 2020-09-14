<?php


namespace TheProfessor\Laravelchatchannels\Traits;

use TheProfessor\Laravelchatchannels\Models\Participant;
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
        return $this->messages;
    }
    public function getMessage($message)
    {
        return $this->messages()->where('body', 'like', "%{$message}%")->get()[0];
    }
    public function setParticipants($participants)
    {
        $this->participants()->attach($participants);
        $participants->each(function ($participant)
        {
            Participant::create([
                'participatable_type'=>class_basename($participant),
                'participatable_id'=>$participant->id
            ]);
        });
        return $this;
    }
    public function getAllParticipants($room = null)
    {
        $participants = $room ? $room->participants :$this->participants;

        return $participants ;
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
