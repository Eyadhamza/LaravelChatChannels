<?php


namespace TheProfessor\Laravelchatchannels\Traits;

use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participant;

trait Participate
{


    public function createNewParticipant()
    {
        return Participant::firstOrCreate([
            'participatable_type'=>class_basename($this),
            'participatable_id'=>$this->id
        ]);

    }
    public function participant()
    {
        return $this->morphOne('TheProfessor\Laravelchatchannels\Models\Participant', 'participatable');
    }

    public function joinRoom($room)
    {

        if ($room instanceof Chat) {
            $chat = Chat::find($room);
            $this->createNewParticipant()->chats()->syncWithoutDetaching($chat);

            return $chat[0];
        } else {
            $channel = Channel::find($room);
            $this->createNewParticipant()->channels()->syncWithoutDetaching($channel);

            return $channel[0];
        }
    }

    public function sendMessage($room, string $message)
    {
        $room->addMessage($this->id, $message);
    }
    public function allChats()
    {

        return $this->createNewParticipant()->chats()->get();
    }
    public function allChannels()
    {

        return $this->createNewParticipant()->channels()->get();
    }
}
