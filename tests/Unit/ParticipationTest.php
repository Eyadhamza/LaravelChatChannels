<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Message;
use TheProfessor\Laravelchatchannels\Models\Participation;


class ParticipationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {
       $participant= factory(Participation::class)->create();

       $this->assertDatabaseCount('participants',1);
    }

    /** @test */
    public function a_participant_can_join_chat()
    {
        $participant= factory(Participation::class)->create();
        $chat= factory(Chat::class)->create();
        dd($participant->joinChat($chat));
    }

//    /** @test */
//    public function a_participant_can_send_messages()
//    {
//        $participant= factory(Participation::class)->create();
//
//    }


}
