<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChatroomUser extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'chatroom_id', 'user_id', 'is_admin', 'accepted', 'joined_at', 'left_at', 'banned'
    ];

    protected $table = 'chatroom_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }
}
