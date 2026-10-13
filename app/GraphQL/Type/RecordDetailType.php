<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use App\GraphQL\Type\Scalar\Timestamp;

/**
 * UserType
 */
class RecordDetailType extends GraphQLType
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
            ],
            'motive' => [
                'type' => Type::string(),
            ],
            'current_illness' => [
                'type' => Type::string(),
            ],
            'menarche' => [
                'type' => Type::string(),
            ],
            'cycles' => [
                'type' => Type::string(),
            ],
            'record_fur' => [
                'type' => Type::string(),
            ],
            'record_g' => [
                'type' => Type::string(),
            ],
            'record_p' => [
                'type' => Type::string(),
            ],
            'record_v' => [
                'type' => Type::string(),
            ],
            'record_a' => [
                'type' => Type::string(),
            ],
            'record_pp' => [
                'type' => Type::string(),
            ],
            'record_up' => [
                'type' => Type::string(),
            ],
            'record_prs' => [
                'type' => Type::string(),
            ],
            'record_fpp' => [
                'type' => Type::string(),
            ],
            'amenorrhea' => [
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











