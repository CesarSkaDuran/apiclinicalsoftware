<?php

namespace App\GraphQL\Type;

use Folklore\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

/**
 * UserType
 */
class ProcedimientoDentalPaginationType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Company pagination',
        'description' => 'A pagination'
    ];

    public function fields()
    {
        return [
            'data' => [
                'type' => Type::listOf(GraphQL::type('procedimientoDental')),
                'description' => 'companies'
            ],
            'total' => [
                'type' => Type::int(),
                'description' => 'The total'
            ]
        ];
    }
}
