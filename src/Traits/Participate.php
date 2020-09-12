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
        return $room->addMessage($this->asParticipant()->id, $message);
    }
    public function allChats()
    {
        return $this->asParticipant()->chats()->get();
    }
    public function getParticipantChat($chat)
    {
        return $this->asParticipant()->chats()->where('chat_id', $chat->id)->get()[0];
    }
    public function allChannels()
    {
        return $this->asParticipant()->channels()->get();
    }
    public function getParticipantChannel($channel)
    {
        return $this->asParticipant()->channels()->where('channel_id', $channel->id)->get()[0];
    }
    public function createChat(string $chatName, string $chatDescription)
    {
        $chat = $this->asParticipant()->chats()->create([
            'name' => $chatName,
            'description' => $chatDescription,
        ]);

        return $chat;
    }
    public function createChannel(string $channelName, string $channelDescription)
    {
        $channel = $this->asParticipant()->channels()->create([
            'name' => $channelName,
            'description' => $channelDescription,
        ]);

        return $channel;
    }
    public function addRole($roleTitle, $room)
    {
        if ($room instanceof Chat) {
            return $this->getParticipantChat($room)->roles()->create([
            'title' => $roleTitle,
          ]);
        } else {
            return  $this->getParticipantChannel($room)->roles()->create([
                'title' => $roleTitle,
            ]);
        }
    }
    public function getAllParticipantAbilities($chat)
    {
        return $this->getParticipantChat($chat)->allAbilities();
    }
}
