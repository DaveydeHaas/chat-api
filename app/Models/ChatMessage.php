<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatroom_id', 'user_id', 'message', 'created_at', 'updated_at'
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chat_messages';


    /**
     * Get the chatroom where the message has been send.
     */
    public function chatroom()
    {
        return $this->belongsTo(Chatroom::class);
    }

    /**
     * Get the user that created the message.
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
