<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Folklore\GraphQL\Support\Query;
use App\Patient;

/**
 * CompaniesQuery
 */
class PatientsQuery extends Query
{
    protected $attributes = [
        'name' => 'patients'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('patient'));
    }

    public function args()
    {
        return array_merge([
            'search' => ['name' => 'search', 'type' => Type::string()],
            'skip' => ['name' => 'skip', 'type' => Type::int()],
            'take' => ['name' => 'take', 'type' => Type::int()],
        ]);
    }

    public function rules()
    {
        return [
            
        ];
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();

        $skip = isset($args['skip']) ? $args['skip'] : 0;
        $take = isset($args['take']) ? $args['take'] : 30;

        $query = Patient::where('status', 1);
        $query->where('user_id', $currentUser->id);

        if (isset($args['search']) && $args['search'] != '.') {
            $searchString = $args['search'];

            $query
            ->where(function ($querySe) use ($searchString)
            {
                return $querySe
                        ->orWhere('name', 'like', '%' . $searchString . '%')
                        ->orWhere('identification', 'like', '%' . $searchString . '%');
            });
        }

        // $result = $query->skip($skip)->take($take)->orderBy('created_at', 'desc')->get();
        $result = $query->orderBy('created_at', 'desc')->get();
        return $result;

    }
}
