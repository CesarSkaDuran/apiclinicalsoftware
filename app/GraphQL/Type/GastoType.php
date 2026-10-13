<?php

namespace App\GraphQL\Type;

use App\GraphQL\Type\Scalar\Timestamp;
use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class GastoType extends GraphQLType
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
            'id_afiliacion' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'id_empresa' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'user_id' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'tercero_id' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'valor' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'status' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'iva' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'fecha' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            // 'empresaCuenta' => [
            //     'type' => GraphQL::type('empresa'),
            //     'description' => 'The user basic info',
            // ],
            // 'sucursal' => [
            //     'type' => GraphQL::type('sucursales'),
            //     'description' => 'The user basic info',
            // ],
            'tercero' => [
                'type' => GraphQL::type('tercero'),
                'description' => 'The user basic info',
            ],
            'sucursal_id' => [
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
