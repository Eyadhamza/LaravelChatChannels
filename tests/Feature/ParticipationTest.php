<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
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
    /** @test */
    public function participant_can_make_chat()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $participatable->createChat('my new chat', 'my description');

        $this->assertCount(1, $participatable->allChats());
    }
    /** @test */
    public function participant_can_make_channel()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $participatable->createChat('my new channel', 'my description');

        $this->assertCount(1, $participatable->allChats());
    }
    /** @test */
    public function only_autherized_participant_have_permissions()
    {
        $participant = factory(Participant::class)->create();
        $admin = $participant->participatable;

        $chat = $admin->createChat('My secret chat', 'my secret description');
        $participants = factory(Participant::class, 3)->create();

        $chat->setParticipants($participants);

        $chat->givePermissions($admin, 'Admin', $ability = 'DeleteChat');

        $this->assertCount(1, $admin->getAllParticipantAbilities($chat));
        $this->actingAs($admin);

        $this->assertTrue(Gate::forUser($admin)->allows($ability, $chat));

        $chat->givePermissions($admin, 'Admin', $ability2 = 'EditChat');

        $this->assertCount(2, $admin->getAllParticipantAbilities($chat));
        $this->assertTrue(Gate::forUser($admin)->allows($ability2, $chat));
    }
    /** @test */

    public function non_authrized_cant_action()
    {
        $participant2 = factory(Participant::class)->create();
        $notAdmin = $participant2->participatable;
        $chat = $notAdmin->createChat('My secret chat', 'my secret description');

        $chat->setParticipants($participant2);
        $ability = 'DeleteChat';
        $this->actingAs($notAdmin);
        $this->assertFalse(Gate::forUser($notAdmin)->allows($ability, $chat));
        $this->assertCount(0,$notAdmin->getAllParticipantAbilities($chat));
    }
}
