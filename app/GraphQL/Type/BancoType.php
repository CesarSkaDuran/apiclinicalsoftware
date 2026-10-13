<?php

namespace App\GraphQL\Type;

use App\GraphQL\Type\Scalar\Timestamp;
use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class BancoType extends GraphQLType
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
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'codigo' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'banco' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'monto_actual' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'tipo' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],

            'ingresos_dia' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],

            'estado' => [
                'type' => Type::int(),
                'description' => 'The email of user'
            ],
            'created_at' => [
                'type' => Timestamp::type(),
            ],
            'updated_at' => [
                'type' => Timestamp::type(),
            ],

        ];
    }
}
