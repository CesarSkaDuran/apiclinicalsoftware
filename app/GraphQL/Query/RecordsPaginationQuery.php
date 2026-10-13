<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Record;



/**

 * CompaniesQuery

 */

class RecordsPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

         return GraphQL::type('recordsPagination');

    }



    public function args()

    {

        return array_merge([

            'date' => ['name' => 'date', 'type' => Type::string()],

            'search' => ['name' => 'search', 'type' => Type::string()],

            'status' => ['name' => 'status', 'type' => Type::int()],

        ], AdvancedQuery::queryParams());

    }



    public function resolve($root, $args, $context, ResolveInfo $info)

    {

        $currentUser = auth('api')->user();

        

        // Prepare query

        $recordsQuery = Record::query();



        $recordsQuery->where('user_id', $currentUser->id)->groupBy();



        // Filter

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];



            $recordsQuery

            ->where(function ($querySe) use ($searchString)

            {

                return $querySe

                    ->orWhere('identification', 'like', '%' . $searchString . '%')
                    ->orWhere('patient_id', 'like', '%' . $searchString . '%')
                    ->orWhereHas('patient', function($queryPatient) use ($searchString) {

                        return $queryPatient->where('name', 'like', '%' . $searchString . '%');

                    });

            });

        }



        if (isset($args['date']) && $args['date'] !== '.') {

            $recordsQuery->whereDate('created_at', $args['date']);

        }



        // filter by status

        if (isset($args['status'])) {

            $recordsQuery->where('status', $args['status']);

        } else {

            $recordsQuery->where('status', '!=', 9);            

        }



        $total = $recordsQuery->groupBy('identification')->count();



        // get data

        if (count($args) > 0) {

            $recordsQuery = AdvancedQuery::extendQuery($recordsQuery, $args);

            $records = $recordsQuery->groupBy('identification')->get();

        } else {

            // not args, then get all

            $records = User::all();

        }



        return ['data' => $records, 'total' => $total];

    }

}

