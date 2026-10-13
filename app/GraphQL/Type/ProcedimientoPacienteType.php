<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class ProcedimientoPacienteType extends GraphQLType
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
            'status' => [
                'type' => Type::int(),
            ],
            'record_id' => [
                'type' => Type::string(),
            ],
            'patient_id' => [
                'type' => Type::string(),
            ],
            'categoria' => [
                'type' => Type::string(),
            ],
            'procedimiento' => [
                'type' => Type::string(),
            ],
            'valor' => [
                'type' => Type::int(),
            ],
            'cantidad' => [
                'type' => Type::string(),
            ],
            'sesiones' => [
                'type' => Type::int(),
            ],
            'suma_sesion' => [
                'type' => Type::int(),
            ],
            'valor_sesion' => [
                'type' => Type::int(),
            ],
            'tipo' => [
                'type' => Type::int(),
            ],
            'tipo_pago' => [
                'type' => Type::int(),
            ],
            'abono' => [
                'type' => Type::int(),
            ],
            'pieza' => [
                'type' => Type::string(),
            ],
            'otros' => [
                'type' => Type::string(),
            ],
            'obs' => [
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
