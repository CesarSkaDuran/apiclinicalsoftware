<?php

namespace App\GraphQL\Type;

use App\GraphQL\Type\Scalar\Timestamp;
use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */

class DetalleGastoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'newPropect',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],

            'gasto_id' => [
                'type' => Type::int(),
            ],

            'nombre' => [
                'type' => Type::string(),
            ],

            'valor' => [
                'type' => Type::int(),
            ],

            'status' => [
                'type' => Type::int(),
            ],

            'created_at' => [
                'type' => Timestamp::type(),
            ],
            'updated_at' => [
                'type' => TimeStamp::type(),
            ],


        ];
    }
}
