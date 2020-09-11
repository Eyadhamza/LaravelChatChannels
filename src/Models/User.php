<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;
use TheProfessor\Laravelchatchannels\Traits\Participate;

class User extends Model
{
    use Participate;
    protected $guarded = [];

    public function trying()
    {
        $user=User::create(['name'=>'asdasdasd']);
        $chat=factory(Chat::class)->create();

        $user->joinRoom($chat);

        //till here all works as expected
        return $user->Allchats();

    }
}
