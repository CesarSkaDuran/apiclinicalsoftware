<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class LaborType extends GraphQLType
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
            'date' => [
                'type' => Type::string(),
            ],
            'time' => [
                'type' => Type::string(),
            ],
            'labor_ta' => [
                'type' => Type::string(),
            ],
            'labor_fcf' => [
                'type' => Type::string(),
            ],
            'membranes' => [
                'type' => Type::string(),
            ],
            'presentation' => [
                'type' => Type::string(),
            ],
            'observations' => [
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
