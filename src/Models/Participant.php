<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $guarded = [];

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
    public function joinRoom($room)
    {
        if ($room instanceof Chat) {
            $chat = Chat::find($room);
            $this->chats()->sync($chat);

            return $chat[0];
        } else {
            $channel = Channel::find($room);
            $this->channels()->sync($channel);

            return $channel[0];
        }
    }

    public function sendMessage($room, string $message)
    {
        $room->addMessage($this->id, $message);

    }
}
