<?php

namespace App\GraphQL\Query;

use App\Departamento;
use App\Tercero;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

/**
 * MeQuery
 */
class TerceroQuery extends Query
{
    protected $attributes = [
        'name' => 'procedure'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('tercero'));
    }

    public function args()

    {

        return array_merge([

            'id' => ['name' => 'id', 'type' => Type::id()],
            'search' => ['name' => 'search', 'type' => Type::string()],

        ], []);
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();
        $proceduresQuery = Tercero::query();
        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $proceduresQuery
               
                ->where('documento', 'like', '%' . $searchString . '%')
                ->orWhere('nombre', 'like', '%' . $searchString . '%')->limit(500);
        } else {
            $proceduresQuery->where('user_id', $currentUser->id)->get();
        }

        $procedures = $proceduresQuery->where('user_id', $currentUser->id)->get();

        return $procedures;
    }
}
