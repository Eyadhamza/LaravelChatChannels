<?php

namespace TheProfessor\Laravelrooms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelrooms\Models\Room;
use TheProfessor\Laravelrooms\Models\Message;
use TheProfessor\Laravelrooms\Models\Participant;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {
        $room = factory(Room::class)->create();

        $this->assertDatabaseCount('rooms', 1);
    }

    /** @test */
    public function a_room_can_have_participants()
    {
        $room = factory(Room::class)->create();
        $room->each(function ($room) {
            $room->participants()->save(factory(Participant::class)->make());
        });

        $this->assertInstanceOf(Participant::class, $room->participants->first());
    }
    /** @test */
    public function a_room_can_have_messages()
    {
        $room = factory(Room::class)->create();
        $room->each(function ($room) {
            $room->messages()->save(factory(Message::class)->make());
        });

        $this->assertInstanceOf(Message::class, $room->messages->first());
    }
    /** @test */
    public function group_of_participants_can_join_to_the_room()
    {
        $room = factory(Room::class)->create();
        $participants = factory(Participant::class, 5)->create();

        $room->setParticipants($participants);

        $this->assertCount(5, $room->participants);
    }
    /** @test */
    public function a_room_can_give_roles()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = $participatable->createRoom('my new room', 'my description');

        $room->givePermissions($participatable, 'Admin');
        $room->givePermissions($participatable, 'AY HAGA');
        $room->givePermissions($participatable, 'AY HAGTEN');

        $this->assertCount(4, $room->roles);
        $this->assertDatabaseCount('r_roles', 4);

        $channel = $participatable->createRoom('my second channel', 'my second description');
        $channel->givePermissions($participatable, 'Admin');
        $channel->givePermissions($participatable, 'hr');
    }
    /** @test */
    public function permissions_are_set()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = $participatable->createRoom('my new room', 'my description');

        $role = $room->givePermissions($participatable, 'Admin', 'DeleteRoom');

        $this->assertCount(1, $role->abilities);
    }
    /** @test */
    public function get_all_participant_of_this_room_or_certain_room()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = $participatable->createRoom('my new room', 'my description');

        $this->assertCount(1, $room->getAllParticipants());

        $this->assertCount(1, (new Room)->getAllParticipants($room));
    }
    /** @test */
    public function get_message_of_this_or_certain_message()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = $participatable->createRoom('my new room', 'my description');
        $room->each(function ($room) {
            $room->messages()->save(factory(Message::class)->make());
        });
        $message = Message::find(1);

        $room->getMessage($message->body);
        $this->assertDatabaseCount('messages', 1);
    }
    /** @test */
    public function Private_Public_room_is_set()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = $participatable->createRoom('my new room', 'my description');
        $room->makePublic();
        $this->assertEquals('Public',$room->visibility);
        $room->makePrivate();
        $this->assertEquals('Private',$room->visibility);
    }
//    /** @test */
//    public function global_search_for_rooms()
//    {
//
//    }
    /** @test */
    public function channel_settings_for_users()
    {

        $participant = factory(Participant::class)->create();
        $admin = $participant->participatable;
        $this->actingAs($admin);
        $room = $admin->createRoom('my new room', 'my description');
        $room->givePermissions($admin, 'Admin', 'DeleteRoom');
        $this->assertTrue($room->channelAdmin());
    }
}
