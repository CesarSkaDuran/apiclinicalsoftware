<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ChatMessageType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'chat_id' => [
                'type' => Type::int(),
            ],
            'sender_id' => [
                'type' => Type::string(),
            ],
            'message' => [
                'type' => Type::string(),
            ],
            'is_file' => [
                'type' => Type::int(),
            ],
            'file_url' => [
                'type' => Type::string(),
            ],
            'date' => [
                'type' => Type::string(),
            ],
            'seen' => [
                'type' => Type::int(),
            ]
        ];
    }
}
