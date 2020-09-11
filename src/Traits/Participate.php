<?php


namespace TheProfessor\Laravelchatchannels\Traits;

use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participant;

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
        return $this->morphOne('TheProfessor\Laravelchatchannels\Models\Participant', 'participatable');
    }

    public function joinRoom($room)
    {
        if ($room instanceof Chat) {
            $chat = Chat::find($room);
            $this->asParticipant()->chats()->syncWithoutDetaching($chat);

            return $chat[0];
        } else {
            $channel = Channel::find($room);
            $this->asParticipant()->channels()->syncWithoutDetaching($channel);

            return $channel[0];
        }
    }

    public function sendMessage($room, string $message)
    {
        $room->addMessage($this->asParticipant()->id, $message);
    }
    public function allChats()
    {
        return $this->asParticipant()->chats()->get();
    }
    public function allChannels()
    {
        return $this->asParticipant()->channels()->get();
    }
    public function createChat(string $chatName, string $chatDescription)
    {

        $chats = $this->asParticipant()->chats()->create([
            'name' => $chatName,
            'description' => $chatDescription,
        ]);
        return $this;
    }
    public function createChannel(string $channelName, string $channelDescription)
    {

        $channels = $this->asParticipant()->channels()->create([
            'name' => $channelName,
            'description' => $channelDescription,
        ]);
        return $this;
    }
}
