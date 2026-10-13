<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Shared\AdvancedQuery;
use App\Multimedia;

/**
 * CompaniesQuery
 */
class MultimediasQuery extends Query
{
    protected $attributes = [
        'name' => 'multimedias'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('multimedia'));
    }

    public function args()
    {
        return array_merge([
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $currentUser = auth('api')->user();

        // Prepare query
        $multimediaQuery = Multimedia::query();

        $multimediaQuery->where('record_id', $args['record_id']);

        // Filter
        // if (isset($args['search']) && $args['search'] !== '.') {
        //     $searchString = $args['search'];

        //     $multimediaQuery
        //     ->where(function ($querySe) use ($searchString)
        //     {
        //         return $querySe
        //             ->orWhere('identification', 'like', '%' . $searchString . '%')
        //             ->orWhereHas('patient', function($queryPatient) use ($searchString) {
        //                 return $queryPatient->where('name', 'like', '%' . $searchString . '%');
        //             });
        //     });
        // }

        // filter by status
        if (isset($args['status'])) {
            $multimediaQuery->where('status', $args['status']);
        } else {
            $multimediaQuery->where('status', '!=', 9);
        }

        // get data
        if (count($args) > 0) {
            $multimediaQuery = AdvancedQuery::extendQuery($multimediaQuery, $args);
        }

        $multimedias = $multimediaQuery->get();

        return $multimedias;
    }
}
