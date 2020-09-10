<?php


namespace TheProfessor\Laravelchatchannels\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isInstanceOf;

class Participant extends Model
{
    use HasFactory;
    protected $table='participants';
    protected $guarded=[];

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }
    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function joinChat($chat)
    {
        $chat=Chat::find($chat);
        $this->chats()->sync($chat);
        return $chat;
    }
    public function joinChannel($channel)
    {
        $channel=Channel::find($channel);
        $this->channels()->sync($channel);
        return $channel;
    }

}
