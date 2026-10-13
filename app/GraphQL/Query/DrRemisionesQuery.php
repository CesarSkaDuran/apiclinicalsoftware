<?php

namespace App\GraphQL\Query;

use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Allergie;

use App\AppPatient;
use App\DrRemision;

/**

 * CompaniesQuery

 */

class DrRemisionesQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return Type::listOf(GraphQL::type('drRemisiones'));
    }

    public function args()
    {
        return array_merge([
            'status' => ['name' => 'status', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()]
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
  

        $currentUser = auth('api')->user();

        // $data = Consentimiento::where('user_id', $currentUser->id)->get();

        // return $data;
        // $currentUser = auth('api')->user();


        $proceduresQuery = DrRemision::query();
        $proceduresQuery->where('user_id', $currentUser->id);

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $proceduresQuery
                ->where(function ($querySe) use ($searchString) {
                    return $querySe
                        ->orwhere('nombre', 'like', '%' . $searchString . '%')
                        // ->orWhere('description', 'like', '%' . $searchString . '%')
                        ->limit(500);
                });
        } else {
            $proceduresQuery = DrRemision::where('user_id', $currentUser->id);
        }

        $procedures = $proceduresQuery->get();

        return $procedures;
    }
}
