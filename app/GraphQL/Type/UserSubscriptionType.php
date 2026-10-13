<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class UserSubscriptionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'subscription' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'date' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'payment_method' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'payment_ref' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ]
        ];
    }
}
