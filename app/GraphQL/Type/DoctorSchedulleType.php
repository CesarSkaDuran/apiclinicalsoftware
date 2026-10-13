<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class DoctorSchedulleType extends GraphQLType
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
            'doctor_id' => [
                'type' => Type::int(),
            ],            
            'start_time' => [
                'type' => Type::string(),
            ],
            'end_time' => [
                'type' => Type::string(),
            ],
            'sun' => [
                'type' => Type::string(),
            ],
            'mon' => [
                'type' => Type::string(),
            ],
            'tue' => [
                'type' => Type::string(),
            ],
            'wed' => [
                'type' => Type::string(),
            ],
            'thu' => [
                'type' => Type::string(),
            ],
            'fri' => [
                'type' => Type::string(),
            ],
            'sat' => [
                'type' => Type::string(),
            ],
            'working_days' => [
                'type' => Type::string(),
            ]
        ];
    }
}
