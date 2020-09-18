<?php


namespace TheProfessor\Laravelrooms\Models;

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
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
