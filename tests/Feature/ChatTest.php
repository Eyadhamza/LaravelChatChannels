<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $chat = factory(Chat::class)->create();
        $participants = factory(Participant::class, 5)->create();
        $chat->setParticipants($participants);
        $this->assertCount(5, $chat->participants);
    }
    /** @test */
    public function a_room_can_give_roles()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $chat = $participatable->createChat('my new chat', 'my description');

        $chat->givePermissions($participatable, 'Admin');
        $chat->givePermissions($participatable, 'AY HAGA');
        $chat->givePermissions($participatable, 'AY HAGTEN');

        $this->assertCount(3, $chat->roles);
        $this->assertDatabaseCount('r_roles', 3);

        $channel = $participatable->createChannel('my second channel', 'my second description');
        $channel->givePermissions($participatable, 'Admin');
        $channel->givePermissions($participatable, 'hr');
        $this->assertCount(2, $channel->roles);
    }
    /** @test */
    public function permissions_are_set()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $chat = $participatable->createChat('my new chat', 'my description');

        $role = $chat->givePermissions($participatable, 'Admin', 'DeleteChat');

        $this->assertCount(1, $role->abilities);
    }
}
