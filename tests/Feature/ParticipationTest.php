<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participant;

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

        $chat = factory(Chat::class)->create();

        $participant->joinRoom($chat);

        $this->assertCount(1, $participant->chats);
    }
    /** @test */
    public function a_participant_can_join_channel()
    {
        $participant = factory(Participant::class)->create();

        $channel = factory(Channel::class)->create();

        $participant->joinRoom($channel);

        $this->assertCount(1, $participant->channels);
    }

    /** @test */
    public function a_participant_can_send_messages_in_chat()
    {
        $participant = factory(Participant::class)->create();

        $chat = factory(Chat::class)->create();

        $chatRoom = $participant->joinRoom($chat);

        $participant->sendMessage($chatRoom, 'hello');

        $this->assertCount(1, $chatRoom->messages);
    }
    /** @test */
    public function a_participant_can_send_messages_in_channel()
    {
        $participant = factory(Participant::class)->create();

        $channel = factory(Chat::class)->create();

        $channelRoom = $participant->joinRoom($channel);

        $participant->sendMessage($channelRoom, 'hello');

        $this->assertCount(1, $channelRoom->messages);
    }
}
