<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ChatType extends GraphQLType
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
            'first_user_id' => [
                'type' => Type::string(),
            ],
            'second_user_id' => [
                'type' => Type::string(),
            ],
            'messages' => [
                'type' => Type::listOf(GraphQL::type('chatMessage')),
                'description' => 'The user basic info',
            ],
        ];
    }
}
