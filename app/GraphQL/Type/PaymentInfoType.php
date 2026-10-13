<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class PaymentInfoType extends GraphQLType
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
            'bank1' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'bank2' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'efecty' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'sured' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'consulting' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'contact' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'conclusion' => [
                'type' => Type::string(),
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
