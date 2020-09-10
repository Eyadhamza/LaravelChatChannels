<?php

namespace TheProfessor\Laravelchatchannels\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use TheProfessor\Laravelchatchannels\Models\Channel;
use TheProfessor\Laravelchatchannels\Models\Chat;
use TheProfessor\Laravelchatchannels\Models\Message;
use TheProfessor\Laravelchatchannels\Models\Participant;


class ChannelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function migration_is_set()
    {
       $channel= factory(Channel::class)->create();

       $this->assertDatabaseCount('channels',1);
    }

    /** @test */
    public function a_channel_can_have_participants()
    {
        $channel= factory(Channel::class)->create();
        $channel->each(function ($channel) {
            $channel->participants()->save(factory(Participant::class)->make());
        });;

        $this->assertInstanceOf(Participant::class,$channel->participants->first());
    }
    /** @test */
    public function a_channel_can_have_messages()
    {
        $channel= factory(Channel::class)->create();
        $channel->each(function ($channel) {
            $channel->messages()->save(factory(Message::class)->make());
        });;
        $this->assertInstanceOf(Message::class,$channel->messages->first());
    }
}
