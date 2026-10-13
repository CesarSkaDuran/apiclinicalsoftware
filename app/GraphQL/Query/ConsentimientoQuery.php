<?php

namespace App\GraphQL\Query;

use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\Chat;
use App\Consentimiento;

class ConsentimientoQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('consentimiento'));
    }

    public function args()
    {
        return [
            // 'status' => ['name' => 'status', 'type' => Type::int()]
            'search' => ['name' => 'search', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context)
    {
        $currentUser = auth('api')->user();

        // $data = Consentimiento::where('user_id', $currentUser->id)->get();

        // return $data;
        // $currentUser = auth('api')->user();


        $proceduresQuery = Consentimiento::query();
        $proceduresQuery->where('user_id', $currentUser->id);

        if ($args['search'] !== '.') {

            $searchString = $args['search'];

            $proceduresQuery
            ->where(function ($querySe) use ($searchString) {
                return $querySe
                    ->orwhere('nombre', 'like', '%' . $searchString . '%')
                    // ->orWhere('description', 'like', '%' . $searchString . '%')
                    ->limit(500);
            });
                
           
        } else {
            $proceduresQuery = Consentimiento::where('user_id', $currentUser->id);
        }

        $procedures = $proceduresQuery->get();

        return $procedures;
    }
}
