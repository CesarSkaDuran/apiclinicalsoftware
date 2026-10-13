<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class ConsentimientoPacienteType extends GraphQLType
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
            'record_id' => [
                'type' => Type::string(),
            ],
            'doctor_id' => [
                'type' => Type::int(),
            ],
            'date' => [
                'type' => Timestamp::type(),
            ],
            'created_at' => [
                'type' => Timestamp::type(),
            ],
            'nombre' => [
                'type' => Type::string(),
            ],
            'obs' => [
                'type' => Type::string(),
            ],
            'doctor' => [

                'type' => GraphQL::type('drRemisiones'),

                'description' => 'The user basic info',

            ],

        ];
    }
}
