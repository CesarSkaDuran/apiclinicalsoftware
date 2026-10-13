<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Folklore\GraphQL\Support\Facades\GraphQL;

class DoctorType extends GraphQLType
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
            'name' => [
                'type' => Type::string(),
            ],
            'specialization' => [
                'type' => Type::string(),
            ],
            'image' => [
                'type' => Type::string(),
            ],
            'university' => [
                'type' => Type::string(),
            ],
            'details' => [
                'type' => Type::string(),
            ],
            'address' => [
                'type' => Type::string(),
            ],
            'phone' => [
                'type' => Type::string(),
            ],
            'experience' => [
                'type' => Type::string(),
            ],
            'avatar_url' => [
                'type' => Type::string(),
            ],
            'consultation_price' => [
                'type' => Type::string(),
            ],
            'in_place_price' => [
                'type' => Type::string(),
            ],
            'virtual_price' => [
                'type' => Type::string(),
            ],
            'informed_consent_link' => [
                'type' => Type::string(),
            ],
            'schedulle' => [
                'type' => GraphQL::type('doctorSchedulle'),
            ],
            'accounts' => [
                'type' => GraphQL::type('paymentInfo'),
            ],
            'bio' => [
                'type' => Type::string(),
            ],
            'chat_id' => [
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::int(),
            ]
        ];
    }
}
