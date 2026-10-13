<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class UserType extends GraphQLType
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
                'description' => 'The id of the user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'identification' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'type' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'verified' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'The status of user'
            ],
            'chat_id' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'app_patient' => [
                'type' => GraphQL::type('appPatient'),
                'description' => 'The user basic info',
            ],
            'doctor' => [
                'type' => GraphQL::type('doctor'),
                'description' => 'The user basic info',
            ],
            'info' => [
                'type' => GraphQL::type('userInfo'),
                'description' => 'The user basic info',
            ],
            'subscription' => [
                'type' => GraphQL::type('userSubscription'),
                'description' => 'The user basic info',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ]
        ];
    }
}
