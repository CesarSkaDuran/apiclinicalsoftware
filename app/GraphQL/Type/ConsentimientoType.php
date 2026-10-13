<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class ConsentimientoType extends GraphQLType
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
            'doctor_id' => [
                'type' => Type::int(),
            ],
            'nombre' => [
                'type' => Type::string(),
            ],
            'obs' => [
                'type' => Type::string(),
            ],
            'link' => [
                'type' =>Type::string(),
            ],
            'created_at' => [
                'type' => timestamp::type(),
            ],
            'updated_at' => [
                'type' => timestamp::type(),
            ],

            'doctor' => [

                'type' => GraphQL::type('drRemisiones'),

                'description' => 'The user basic info',

            ],

        ];
    }
}
