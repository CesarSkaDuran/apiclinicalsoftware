<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Patient;

use App\User;



/**

 * CompaniesQuery

 */

class PatientsPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'Patients'

    ];



    public function type()

    {

        return GraphQL::type('patientPagination');
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

        $PatientsQuery = Patient::query();



        $PatientsQuery->where('user_id', $currentUser->id)->distinct();



        // Filter

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];



            $PatientsQuery

                ->where(function ($querySe) use ($searchString) {

                    return $querySe
                        ->orWhere('name', 'like', '%' . $searchString . '%')
                        ->orWhere('identification', 'like', '%' . $searchString . '%');
                        // ->orWhere('patient_id', 'like', '%' . $searchString . '%')
                        // ->orWhereHas('patient', function ($queryPatient) use ($searchString) {

                        //     return $queryPatient->where('name', 'like', '%' . $searchString . '%');
                        // });
                });
        }



        if (isset($args['date']) && $args['date'] !== '.') {

            $PatientsQuery->whereDate('created_at', $args['date']);
        }



        // filter by status

        if (isset($args['status'])) {

            $PatientsQuery->where('status', $args['status']);
        } else {

            $PatientsQuery->where('status', '!=', 9);
        }



        $total = $PatientsQuery->distinct()->count();



        // get data

        if (count($args) > 0) {

            $PatientsQuery = AdvancedQuery::extendQuery($PatientsQuery, $args);

            $Patients = $PatientsQuery->distinct()->get();
        } else {

            // not args, then get all

            $Patients = User::all();
        }



        return ['data' => $Patients, 'total' => $total];
    }
}
