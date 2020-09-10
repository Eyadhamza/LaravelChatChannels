<?php


namespace TheProfessor\Laravelchatchannels\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
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

    public function joinChat($chat)
    {
        $chat=Chat::find($chat);
        return $this->chats()->sync($chat);
    }
}
