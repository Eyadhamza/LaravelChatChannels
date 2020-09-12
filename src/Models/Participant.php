<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $guarded = [];

    public function participatable()
    {
        return $this->morphTo();
    }
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
}
