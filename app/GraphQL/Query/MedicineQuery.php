<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Medicine;

/**

 * MeQuery

 */

class MedicineQuery extends Query

{

    protected $attributes = [

        'name' => 'me'

    ];



    public function type()

    {
        return Type::listOf(GraphQL::type('medicine'));
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
        $medicinesQuery = Medicine::query();

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $medicinesQuery
                ->where('name', 'like', '%' . $searchString . '%')
                ->orWhere('atc_code', 'like', '%' . $searchString . '%')
                ->orWhere('cum', 'like', '%' . $searchString . '%');
        }

        $medicines = $medicinesQuery->get();

        return $medicines;
    }
}
