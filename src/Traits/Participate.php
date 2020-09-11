<?php


namespace TheProfessor\Laravelchatchannels\Traits;

use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participant;

trait Participate
{
    public function participant()
    {
        return $this->morphOne('TheProfessor\Laravelchatchannels\Models\Participant', 'participatable');
    }

    public function joinRoom($room)
    {


        if ($room instanceof Chat) {
            $chat = Chat::find($room);
            $this->participant->chats()->sync($chat);

            return $chat[0];
        } else {
            $channel = Channel::find($room);
            $this->participant->channels()->sync($channel);

            return $channel[0];
        }
    }

    public function sendMessage($room, string $message)
    {
        $room->addMessage($this->id, $message);
    }
}
