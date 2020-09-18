<?php


namespace TheProfessor\Laravelrooms\Traits;

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
        return $this->morphOne('TheProfessor\Laravelroomchannels\Models\Participant', 'participatable');
    }

    public function joinRoom($room)
    {
        $room = Room::find($room);
        $this->asParticipant()->rooms()->syncWithoutDetaching($room);
        return $room[0];

    }

    public function sendMessage($room, string $message)
    {
        return $room->addMessage($this->asParticipant()->id, $message);
    }
    public function allRooms()
    {
        return $this->asParticipant()->rooms()->get();
    }
    public function getParticipantRoom($room)
    {
        return $this->asParticipant()->rooms()->where('room_id', $room->id)->get()[0];
    }
//    public function allChannels()
//    {
//        return $this->asParticipant()->channels()->get();
//    }
//    public function getParticipantChannel($channel)
//    {
//        return $this->asParticipant()->channels()->where('channel_id', $channel->id)->get()[0];
//    }
    public function createRoom(string $roomName, string $roomDescription)
    {
        $room = $this->asParticipant()->rooms()->create([
            'name' => $roomName,
            'description' => $roomDescription,
        ]);

        return $room;
    }
//    public function createChannel(string $channelName, string $channelDescription)
//    {
//        $channel = $this->asParticipant()->channels()->create([
//            'name' => $channelName,
//            'description' => $channelDescription,
//        ]);
//
//        return $channel;
//    }
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
}
