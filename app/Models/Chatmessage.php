<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chatmessage extends Model
{
    use HasFactory, BelongsTo;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chatmessages';


    /**
     * Get the chatroom where the message has been send.
     */
    public function chatroom() {
        $this->belongsTo(Chatroom::class);
    }

    /**
     * Get the user that created the message.
     */
    public function user() {
        $this->belongsTo(User::class);
    }
}
