<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class PopqType extends GraphQLType
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
            'popq_Aa' => [
                'type' => Type::string(),
            ],
            'popq_Ba' => [
                'type' => Type::string(),
            ],
            'popq_C' => [
                'type' => Type::string(),
            ],
            'popq_gh' => [
                'type' => Type::string(),
            ],
            'popq_pb' => [
                'type' => Type::string(),
            ],
            'popq_tvl' => [
                'type' => Type::string(),
            ],
            'popq_Ap' => [
                'type' => Type::string(),
            ],
            'popq_Bp' => [
                'type' => Type::string(),
            ],
            'popq_D' => [
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
