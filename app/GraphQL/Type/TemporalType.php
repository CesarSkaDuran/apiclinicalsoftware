<?php

namespace App\GraphQL\Type;

use App\GraphQL\Type\Scalar\Timestamp;
use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class TemporalType extends GraphQLType
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
                'description' => 'The email of user'
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],

            'cuatroxmil' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],

            'sucursal_id' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'id_empresa' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'iva' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'empresa' => [
                'type' => GraphQL::type('tercero'),
                'description' => 'The user basic info',
            ],
            'user_id' => [
                'type' => Type::int(),
            ],
            // 'sucursal' => [
            //     'type' => GraphQL::type('sucursales'),
            //     'description' => 'The user basic info',
            // ],
            'valor' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],

            'fecha' => [
                'type' => Type::string(),
            ],
            'obs' => [
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::String(),
            ],
            'created_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ]
        ];
    }
}
