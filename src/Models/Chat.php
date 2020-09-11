<?php


namespace TheProfessor\Laravelchatchannels\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded = [];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'chat_participant', 'chat_id', 'participant_id');
    }
    public function messages()
    {
        return $this->morphMany('TheProfessor\Laravelchatchannels\Models\Message', 'messagable');
    }
    public function addMessage($sender, $messageBody)
    {
        return $this->messages()->create(['sender_id' => $sender,'body' => $messageBody]);
    }
    public function setParticipants($participants)
    {
        $this->participants()->attach($participants);
        return $this;
    }
    public function roles()
    {
        return $this->belongsToMany(RoomRoles::class,'chat_role','chat_id','r_role_id');
    }
}
