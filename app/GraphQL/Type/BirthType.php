<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class BirthType extends GraphQLType
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
            'date' => [
                'type' => Type::string(),
            ],
            'time' => [
                'type' => Type::string(),
            ],
            'type' => [
                'type' => Type::string(),
            ],
            'episiotomy' => [
                'type' => Type::string(),
            ],
            'alum' => [
                'type' => Type::string(),
            ],
            'blood_loss' => [
                'type' => Type::string(),
            ],
            'oxytocic' => [
                'type' => Type::string(),
            ],
            'anesthesia' => [
                'type' => Type::string(),
            ],
            'sex' => [
                'type' => Type::string(),
            ],
            'weight' => [
                'type' => Type::string(),
            ],
            'height' => [
                'type' => Type::string(),
            ],
            'size' => [
                'type' => Type::string(),
            ],
            'observations' => [
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
