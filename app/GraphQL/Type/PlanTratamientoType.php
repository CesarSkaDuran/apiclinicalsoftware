<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;
use GraphQL;
/**
 * UserType
 */
class PlanTratamientoType extends GraphQLType
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
            'user_id' => [
                'type' => Type::int(),
            ],
            'nombre' => [
                'type' => Type::string(),
            ],
            'record_id' => [
                'type' => Type::string(),
            ],
            'patient_id' => [
                'type' => Type::string(),
            ],
            'valor' => [
                'type' => Type::int(),
            ],
            'status' => [
                'type' => Type::int(),
            ],
            'user' => [
                'type' => GraphQL::type('user'),

                'description' => 'The user basic info',
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
