<?php

namespace TheProfessor\Laravelrooms\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use TheProfessor\Laravelrooms\Models\Room;
use TheProfessor\Laravelrooms\Models\Participant;
use TheProfessor\Laravelrooms\Models\RoomRoles;

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

        $room = factory(Room::class)->create();

        $participatable->joinRoom($room);


        $this->assertCount(1, $participatable->allRooms());
    }
    /** @test */
    public function a_participant_can_join_channel()
    {
        $participant = factory(Participant::class)->create();

        $participatable = $participant->participatable;
        $room = factory(Room::class)->create();

        $participatable->joinRoom($room);

        $this->assertCount(1, $participatable->allRooms());
    }

    /** @test */
    public function a_participant_can_send_messages_in_chat()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = factory(Room::class)->create();

        $roomRoom = $participatable->joinRoom($room);

        $participatable->sendMessage($roomRoom, 'hello');

        $this->assertCount(1, $roomRoom->messages);
    }
    /** @test */
    public function a_participant_can_send_messages_in_channel()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $room = factory(Room::class)->create();

        $roomRoom = $participatable->joinRoom($room);

        $participatable->sendMessage($roomRoom, 'hello');

        $this->assertCount(1, $roomRoom->messages);
    }
    /** @test */
    public function participant_can_make_chat()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $participatable->createRoom('my new chat', 'my description');

        $this->assertCount(1, $participatable->allRooms());
    }
    /** @test */
    public function participant_can_make_channel()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $participatable->createRoom('my new channel', 'my description');

        $this->assertCount(1, $participatable->allRooms());
    }
    /** @test */
    public function only_autherized_participant_have_permissions()
    {
        $participant = factory(Participant::class)->create();
        $admin = $participant->participatable;

        $room = $admin->createRoom('My secret chat', 'my secret description');
        $participants = factory(Participant::class, 3)->create();

        $room->setParticipants($participants);

        $role=$room->giveRole($admin,'Admin');
        $room->givePermissions($ability = 'DeleteRoom');

        $this->assertCount(1, $admin->getAllParticipantAbilities($room));
        $this->actingAs($admin);

        $this->assertTrue(Gate::forUser($admin)->allows($ability, $room));


        $role=$room->giveRole($admin,'Admin');
        $room->givePermissions($ability = 'EditRoom');
        $this->assertCount(2, $admin->getAllParticipantAbilities($room));
        $this->assertTrue(Gate::forUser($admin)->allows($ability, $room));
    }
    /** @test */
//
//    public function non_authrized_cant_action()
//    {
//        $participant2 = factory(Participant::class)->create();
//        $notAdmin = $participant2->participatable;
//
//        $room = Room::create(['name'=>'asd','description'=>'asdasd']);
//
//        $room->setParticipants($notAdmin);
//        dd($notAdmin->allRooms());
//        $room->givePermissions($notAdmin,'Member','SendMessage');
//        dd('asdasd');
//        $ability = 'DeleteRoom';
//        $this->actingAs($notAdmin);
//        $this->assertFalse(Gate::forUser($notAdmin)->allows($ability, $room));
//        $this->assertCount(0, $notAdmin->getAllParticipantAbilities($room));
//    }
    /** @test */
    public function user_can_create_channels()
    {
        $participant = factory(Participant::class)->create();
        $participatable = $participant->participatable;
        $participatable->createRoom('my new channel', 'my description',true);
        $this->assertCount(1,$participatable->allRooms());

    }
    /** @test */
    public function only_admins_can_send_messages_in_channels()
    {
        $participant = factory(Participant::class)->create();
        $admin = $participant->participatable;
        $room=$admin->createRoom('my new channel', 'my description',true);
        $role=$room->giveRole($admin,'Admin');
        $room->givePermissions($room->seedAbilities());
        $message= $admin->sendMessage($room,'asdasd');

        dd($room->roles
            ->map->abilities->flatten()->pluck('title')->unique());
        dd($admin->getAllParticipantAbilities($room));
        $this->assertEquals($message->body,'asdasd');
    }
    /** @test */
    public function members_cannot_send_messages_in_channels()
    {
        $participant = factory(Participant::class)->create();
        $member = $participant->participatable;
        $room=$member->createRoomWithoutOwner('my new channel', 'my description',true);



        $message= $member->sendMessage($room,'asdasd');

        $this->assertDatabaseCount('messages',0);
    }
}
