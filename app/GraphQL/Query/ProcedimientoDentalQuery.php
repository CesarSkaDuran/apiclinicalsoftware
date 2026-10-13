<?php

namespace App\GraphQL\Query;

use App\Categoria;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Shared\AdvancedQuery;
use App\Control;
use App\ProcedimientoDental;

/**
 * CompaniesQuery
 */
class ProcedimientoDentalQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('procedimientoDental'));
    }

    public function args()
    {
        return array_merge([

            'search' => ['name' => 'search', 'type' => Type::string()],

        ], AdvancedQuery::queryParams());
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $currentUser = auth('api')->user();
        $data = ProcedimientoDental::where('user_id',$currentUser->id)->get();
        return $data;
    }
}
