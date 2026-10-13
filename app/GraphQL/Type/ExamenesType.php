<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class ExamenesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',

    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'record_id' => [
                'type' => Type::string(),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'code' => [
                'type' => Type::string(),
            ],

            'otros' => [
                'type' => Type::string(),
            ],
            'orina' => [
                'type' => Type::string(),
            ],
            'quimica_sanguinea' => [
                'type' => Type::string(),
            ],
            'material_fecal' => [
                'type' => Type::string(),
            ],
            'varios' => [
                'type' => Type::string(),
            ],
            'hematologia' => [
                'type' => Type::string(),
            ],
            'obs' => [
                'type' => Type::string(),
            ],
            'ecografias' => [
                'type' => Type::string(),
            ],
            'resonancias' => [
                'type' => Type::string(),
            ],
            'tac' => [
                'type' => Type::string(),
            ],
            'radioIntraorales' => [
                'type' => Type::string(),
            ],
            'radioExtraorales' => [
                'type' => Type::string(),
            ],
            'fotoIntraorales' => [
                'type' => Type::string(),
            ],
            'fotoExtraorales' => [
                'type' => Type::string(),
            ],
            'modelos' => [
                'type' => Type::string(),
            ],
            'paquete_diagnostico' => [
                'type' => Type::string(),
            ],
            'cefalometria' => [
                'type' => Type::string(),
            ],
            'tomografia' => [
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
