<?php

namespace App\GraphQL\Type;

use App\GraphQL\Type\Scalar\Timestamp;
use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */

class TerceroType extends GraphQLType
{
    protected $attributes = [
        'name' => 'sale',
        'description' => 'An user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'codigo' => [
                'type' => Type::string(),
            ],
            'tipo_terceros' => [
                'type' => Type::int(),
            ],
            'tipo_naturaleza' => [
                'type' => Type::int(),
            ],
            'regimen' => [
                'type' => Type::int(),
            ],

            'nombre' => [
                'type' => Type::string(),
            ],

            'apellido' => [
                'type' => Type::string(),
            ],

            'email' => [
                'type' => Type::string(),
            ],

            'tipo_documento' => [
                'type' => Type::int(),
            ],

            'documento' => [
                'type' => Type::string(),
            ],
            'dv' => [
                'type' => Type::string(),
            ],
            'ciudad' => [
                'type' => Type::string(),
            ],

            'direccion' => [
                'type' => Type::string(),
            ],

            'telefono' => [
                'type' => Type::string(),
            ],

            'fecha_nacimiento' => [
                'type' => Type::string(),
            ],

            'cupo' => [
                'type' => Type::string(),
            ],

            'ruta' => [
                'type' => Type::string(),
            ],

            'cuenta_contable_id' => [
                'type' => Type::int(),
            ],


            'user_id' => [
                'type' => Type::int(),
            ],


            'created_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ],
            'updated_at' => [
                'type' => Timestamp::type(),
                'description' => 'The email of user'
            ],
        ];
    }
}
