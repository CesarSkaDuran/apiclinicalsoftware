<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Income;



/**

 * CompaniesQuery

 */

class IncomesPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

         return GraphQL::type('incomesPagination');

    }



    public function args()

    {

        return array_merge([

            'date' => ['name' => 'date', 'type' => Type::string()],
            'date2' => ['name' => 'date2', 'type' => Type::string()],

            'search' => ['name' => 'search', 'type' => Type::string()],

            'status' => ['name' => 'status', 'type' => Type::int()],

        ], AdvancedQuery::queryParams());

    }



    public function resolve($root, $args, $context, ResolveInfo $info)

    {

        $currentUser = auth('api')->user();

        

        // Prepare query

        $incomesQuery = Income::query();



        $incomesQuery->where('user_id', $currentUser->id);



        // Filter

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $incomesQuery->where('concept', 'like', '%' . $searchString . '%');
            $incomesQuery->orWhere('company', 'like', '%' . $searchString . '%');

        }



        if (isset($args['date']) && !isset($args['date2'])) {

            $incomesQuery->whereDate('date', '>=', $args['date']);

        }

        if (!isset($args['date']) && isset($args['date2'])) {

            $incomesQuery->whereDate('date', '=<', $args['date']);

        }

        if (isset($args['date']) && isset($args['date2'])) {

            $incomesQuery->whereBetween('date',  [$args['date'], $args['date2']]);

        }
        
        if (!isset($args['date']) && !isset($args['date2'])) {

            $incomesQuery->whereDate('date',  date('Y-m-d'));

        }



        // filter by status

        if (isset($args['status'])) {

            $incomesQuery->where('status', $args['status']);

        } else {

            $incomesQuery->where('status', '!=', 9);            

        }



        $total = $incomesQuery->count();



        // get data

        if (count($args) > 0) {

            $incomesQuery = AdvancedQuery::extendQuery($incomesQuery, $args);

            $incomes = $incomesQuery->get();

        } else {

            // not args, then get all

            $incomes = Income::all();

        }



        return ['data' => $incomes, 'total' => $total];

    }

}

