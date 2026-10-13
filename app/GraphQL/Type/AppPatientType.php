<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class AppPatientType extends GraphQLType
{
    protected $attributes = [
        'name' => 'appPatient',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the user'
            ],
            'user_id' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'identity' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'birth_date' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'sex' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'avatar_url' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'The status of user'
            ],
            'user' => [

                'type' => GraphQL::type('user'),

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
