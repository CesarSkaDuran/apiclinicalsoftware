<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Diagnostic;

/**

 * MeQuery

 */

class DiagnosticQuery extends Query

{

    protected $attributes = [

        'name' => 'me'

    ];



    public function type()

    {
        return Type::listOf(GraphQL::type('diagnostic'));
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
        $diagnosesQuery = Diagnostic::query();

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $diagnosesQuery
                ->where('cod_four', 'like', '%' . $searchString . '%')
                ->orWhere('des_four', 'like', '%' . $searchString . '%')->limit(500);
        }

        $diagnoses = $diagnosesQuery->get();

        return $diagnoses;
    }
}
