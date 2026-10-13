<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Shared\AdvancedQuery;

/**
 * MeQuery
 */
class MeQuery extends Query
{
    protected $attributes = [
        'name' => 'me'
    ];

    public function type()
    {
        return GraphQL::type('user');
    }

    public function args()
    {
        return array_merge([
            'company_id' => ['name' => 'company_id', 'type' => Type::id()]
        ], []);
    }

    public function resolve($root, $args)
    {
        return auth('api')->user();
    }
}
