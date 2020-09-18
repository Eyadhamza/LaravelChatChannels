<?php


namespace TheProfessor\Laravelrooms\Traits;

use TheProfessor\Laravelrooms\Models\Participant;
use TheProfessor\Laravelrooms\Models\RoomRoles;

trait RoomManagement
{

    public function messages()
    {
        return $this->morphMany('TheProfessor\Laravelrooms\Models\Message', 'messagable');
    }
    public function addMessage($sender, $messageBody, $images = null, $filenames = null)
    {
        return $this
            ->messages()
            ->create(['sender_id' => $sender,'body' => $messageBody,'images' => $images,'filenames' => $filenames]);
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
        $participants->each(function ($participant) {
            Participant::create([
                'participatable_type' => class_basename($participant),
                'participatable_id' => $participant->id,
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

        $allAbilities=(new RoomRoles())->seedAbilities();


            $role->allowTo($ability);

        return $role;
    }

    public function allAbilities()
    {

        return $this->roles
            ->map->abilities
            ->flatten()->pluck('title')->unique();
    }
    public function allRoles()
    {
        return $this->roles
            ->map
            ->pluck('title')
            ->unique();
    }
    public function makePublic()
    {
        $this->visibility='Public';
        return $this;
    }
    public function makePrivate()
    {
        $this->visibility='Private';
        return $this;
    }

    public function channelAdmin():bool
    {
        $participant=Participant::where('id',auth()->id())->get()[0];

        $admin = $participant->participatable;

        $adminRoles=$admin->getAllParticipantRoles($this)[0];

        return $adminRoles->contains('Admin')||$adminRoles->contains('Owner');

    }
}
