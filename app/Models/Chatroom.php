<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    // key is currently not in use could be for encryption
    protected $fillable = [
        'title', 'description', 'is_private', 'enabled', 'key'
    ];

    protected $table = 'chatrooms';

    public function users()
    {
        return $this->belongsToMany(User::class, 'chatroom_users')
                    ->withPivot('is_admin', 'accepted', 'banned', 'joined_at', 'left_at')
                    ->using(ChatroomUser::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
