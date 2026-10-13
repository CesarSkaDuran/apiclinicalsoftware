<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class procedimientoDentalType extends GraphQLType
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
            'categoria_id' => [
                'type' => Type::int(),
            ],
            'valor1' => [
                'type' => Type::int(),
            ],
            'valor2' => [
                'type' => Type::int(),
            ],
            'status' => [
                'type' => Type::int(),
            ],
            'tipo' => [
                'type' => Type::int(),
            ],
            'categoria' => [
                'type' => GraphQL::type('categoria'),
                'description' => 'The user basic info',
            ],
            
        ];
    }
}
