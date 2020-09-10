<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Message;
use TheProfessor\Laravelchatchannels\Models\Participant;


class ParticipantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {
       $participant= factory(Participant::class)->create();

       $this->assertDatabaseCount('participants',1);
    }

    /** @test */
    public function a_participant_can_join_chat()
    {
        $participant= factory(Participant::class)->create();

        $chat= factory(Chat::class)->create();

        $participant->joinChat($chat);

        $this->assertCount(1,$participant->chats);
    }
    /** @test */
    public function a_participant_can_join_channel()
    {
        $participant= factory(Participant::class)->create();

        $channel= factory(Channel::class)->create();

        $participant->joinChannel($channel);

        $this->assertCount(1,$participant->channels);
    }

    /** @test */
    public function a_participant_can_send_messages_in_chat()
    {
        $participant= factory(Participant::class)->create();

        $chat= factory(Chat::class)->create();

        $chatRoom = $participant->joinChat($chat);

//        $message= $participant->sendMessage($chatRoom,'hello');


    }


}
