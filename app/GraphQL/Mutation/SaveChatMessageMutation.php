<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Chat;
use App\ChatMessage;

/**
 * CreateFileMutation
 */

class SaveChatMessageMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('chatResponse');
    }

    public function args()
    {
        return [
            'sender_id' => ['name' => 'sender_id', 'type' => Type::string()],
            'receiver_id' => ['name' => 'receiver_id', 'type' => Type::string()],
            'message' => ['name' => 'message', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'is_file' => ['name' => 'is_file', 'type' => Type::int()],
            'file_url' => ['name' => 'file_url', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();

        $chat = Chat::where(function($query) use($args, $currentUser) {
            return $query->where('first_user_id', $currentUser->chat_id)->where('second_user_id', $args['receiver_id']);
        })->orWhere(function($query2) use ($args, $currentUser) {
            return $query2->where('first_user_id', $args['receiver_id'])->where('second_user_id', $currentUser->chat_id);
        })->first();        
        
        if (!$chat) {
            $chat = Chat::create([
                'first_user_id' => $currentUser->chat_id,
                'second_user_id' => $args['receiver_id'],
            ]);
        }

        ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => $currentUser->chat_id,
            'message' => urldecode(htmlspecialchars_decode($args['message'])),
            'date' => $args['date'],
            'is_file' => 0,
            'file_url' => null,
        ]);

        return ['success' => true];
    }
}
