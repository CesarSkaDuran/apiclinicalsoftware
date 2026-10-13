<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Procedure;

/**

 * MeQuery

 */

class ProcedureQuery extends Query

{

    protected $attributes = [

        'name' => 'me'

    ];



    public function type()

    {
        return Type::listOf(GraphQL::type('procedure'));
    }



    public function args()

    {

        return array_merge([

            'id' => ['name' => 'id', 'type' => Type::id()],
            'search' => ['name' => 'search', 'type' => Type::string()]
        ], []);
    }



    public function resolve($root, $args)

    {
        $proceduresQuery = Procedure::query();

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $proceduresQuery
                ->where('code', 'like', '%' . $searchString . '%')
                ->orWhere('description', 'like', '%' . $searchString . '%')->limit(500);
        }

        $procedures = $proceduresQuery->get();

        return $procedures;
    }
}
