<?php

namespace App\GraphQL\Query;

use App\Categoria;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Shared\AdvancedQuery;
use App\Control;

/**
 * CompaniesQuery
 */
class CategoriaQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
         return Type::listOf(GraphQL::type('categoria'));
    }

    public function args()
    {
        return array_merge([
          
            'search' => ['name' => 'search', 'type' => Type::string()],

        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $data = Categoria::all();
        return $data;
    }
}
