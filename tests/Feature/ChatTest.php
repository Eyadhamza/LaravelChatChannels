<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Message;
use TheProfessor\Laravelchatchannels\Models\Participant;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {
        $chat = factory(Chat::class)->create();

        $this->assertDatabaseCount('chats', 1);
    }

    /** @test */
    public function a_chat_can_have_participants()
    {
        $chat = factory(Chat::class)->create();
        $chat->each(function ($chat) {
            $chat->participants()->save(factory(Participant::class)->make());
        });

        $this->assertInstanceOf(Participant::class, $chat->participants->first());
    }
    /** @test */
    public function a_chat_can_have_messages()
    {
        $chat = factory(Chat::class)->create();
        $chat->each(function ($chat) {
            $chat->messages()->save(factory(Message::class)->make());
        });

        $this->assertInstanceOf(Message::class, $chat->messages->first());
    }
    /** @test */
    public function group_of_participants_can_join_to_the_chat()
    {
        $chat= factory(Chat::class)->create();
        $participants=factory(Participant::class,5)->create();
        $chat->setParticipants($participants);
        $this->assertCount(5,$chat->participants);
    }
}
