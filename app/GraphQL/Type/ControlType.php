<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class ControlType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
            ],
            'date' => [
                'type' => Type::string(),
            ],
            'weight' => [
                'type' => Type::string(),
            ],
            'week' => [
                'type' => Type::string(),
            ],
            'control_t' => [
                'type' => Type::string(),
            ],
            'control_a' => [
                'type' => Type::string(),
            ],
            'control_pam' => [
                'type' => Type::string(),
            ],
            'control_au' => [
                'type' => Type::string(),
            ],
            'pression' => [
                'type' => Type::string(),
            ],
            'fcf' => [
                'type' => Type::string(),
            ],
            'edema' => [
                'type' => Type::string(),
            ],
            'created_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ],
            'updated_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ]
        ];
    }
}
