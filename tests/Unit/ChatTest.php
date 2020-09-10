<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Participation;


class ChatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {
       $chat= factory(Chat::class)->create();

       $this->assertDatabaseCount('chats',1);
    }

    /** @test */
    public function a_chat_can_have_participants()
    {
        $chat= factory(Chat::class)->create();
        $chat->each(function ($chat) {
            $chat->participants()->save(factory(Participation::class)->make());
        });;

        $this->assertInstanceOf(Participation::class,$chat->participants->first());
    }
}
