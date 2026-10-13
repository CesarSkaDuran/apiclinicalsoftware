<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class UserInfoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'birth_date' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'city' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'sex' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'profession' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'profile_img' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'notification_token' => [
                'type' => Type::int(),
                'description' => 'The email of user'
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
