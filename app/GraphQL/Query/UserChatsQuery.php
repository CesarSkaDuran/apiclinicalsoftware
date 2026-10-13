<?php

namespace App\GraphQL\Query;

use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\Chat;

class UserChatsQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('chat'));
    }

    public function args()
    {
        return [
            'status' => ['name' => 'status', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {
        $currentUser = auth('api')->user();

        $chats = Chat::where('first_user_id', $currentUser->chat_id)->orWhere('second_user_id', $currentUser->chat_id)
            ->with(['messages' => function($query) {
                return $query->take(20);
            }])->get();

        return $chats;
    }
}
