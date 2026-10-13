<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $guarded = [
        'id'
    ];

    public function messages()
    {
        return $this->hasMany('App\ChatMessage', 'chat_id', 'id')->orderBy('date', 'desc');
    }
}
