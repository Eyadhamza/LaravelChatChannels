<?php


namespace TheProfessor\Laravelrooms\Traits;

use Illuminate\Support\Facades\Gate;
use TheProfessor\Laravelrooms\Models\Participant;
use TheProfessor\Laravelrooms\Models\Room;



trait Participate
{
    public function asParticipant()
    {
        return Participant::firstOrCreate([
            'participatable_type' => class_basename($this),
            'participatable_id' => $this->id,
        ]);
    }
    public function participant()
    {
        return $this->morphOne('TheProfessor\Laravelrooms\Models\Participant', 'participatable');
    }

    public function joinRoom($room)
    {
        $room = Room::find($room);
        $this->asParticipant()->rooms()->syncWithoutDetaching($room);
        return $room[0];

    }

    public function sendMessage($room, string $message)
    {

        if ($room->isChannel){

            if (Gate::forUser(auth()->user())->allows('SendMessage', $room)){

                return $room->addMessage($this->asParticipant()->id, $message);
            }
            else{

                return 403;
            }
        }
        else{
            return $room->addMessage($this->asParticipant()->id, $message);

        }
    }
    public function allRooms()
    {
        return $this->asParticipant()->rooms()->get();
    }
    public function getParticipantRoom($room)
    {
        return $this->asParticipant()->rooms()->where('room_id', $room->id)->get()[0];
    }

    public function createRoom(string $roomName, string $roomDescription,bool $isChannel=false)
    {
        $room = $this->asParticipant()->rooms()->create([
            'name' => $roomName,
            'description' => $roomDescription,
            'isChannel'=>$isChannel
        ]);
        $role=$room->giveRole($this,'Owner');
        $room->givePermissions($ability = 'DeleteRoom');


        return $room;
    }
    public function createRoomWithoutOwner(string $roomName, string $roomDescription,bool $isChannel=false)
    {
        $room = $this->asParticipant()->rooms()->create([
            'name' => $roomName,
            'description' => $roomDescription,
            'isChannel'=>$isChannel
        ]);

        return $room;
    }


    public function addRole($roleTitle, $room)
    {

        return $this->getParticipantRoom($room)->roles()->create([
            'title' => $roleTitle,
        ]);
    }
    public function getAllParticipantAbilities($room)
    {
        return $this->getParticipantRoom($room)->allAbilities();
    }
    public function getAllParticipantRoles($room)
    {
        return $this->getParticipantRoom($room)->allRoles();
    }
}
