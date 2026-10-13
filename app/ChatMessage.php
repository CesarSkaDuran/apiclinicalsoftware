<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chats_messages';

    protected $guarded = [
        'id'
    ];
}
