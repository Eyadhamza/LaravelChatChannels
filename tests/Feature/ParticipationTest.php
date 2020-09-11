<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participant;
use TheProfessor\Laravelchatchannels\Models\User;

class ParticipantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {

        $participant = factory(Participant::class)->create();

        $this->assertDatabaseCount('participants', 1);
    }

    /** @test */
    public function a_participant_can_join_chat()
    {
        $participant = factory(Participant::class)->create();


        $participant = Participant::find(1);
        $participatable = $participant->participatable;

        $chat = factory(Chat::class)->create();

        $participatable->joinRoom($chat);


        $this->assertCount(1, $participatable->allChats());
    }
    /** @test */
    public function a_participant_can_join_channel()
    {
        $participant = factory(Participant::class)->create();

        $participatable = $participant->participatable;
        $channel = factory(Channel::class)->create();

        $participatable->joinRoom($channel);

        $this->assertCount(1, $participatable->allChannels());
    }

    /** @test */
    public function a_participant_can_send_messages_in_chat()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $chat = factory(Chat::class)->create();

        $chatRoom = $participatable->joinRoom($chat);

        $participatable->sendMessage($chatRoom, 'hello');

        $this->assertCount(1, $chatRoom->messages);
    }
    /** @test */
    public function a_participant_can_send_messages_in_channel()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $channel = factory(Chat::class)->create();

        $channelRoom = $participatable->joinRoom($channel);

        $participatable->sendMessage($channelRoom, 'hello');

        $this->assertCount(1, $channelRoom->messages);
    }
}
