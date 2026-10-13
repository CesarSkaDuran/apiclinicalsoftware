<?php



namespace App\GraphQL\Query;


use Illuminate\Support\Facades\Auth;
use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Doctor;



/**

 * CompaniesQuery

 */

class DoctorsPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

        return GraphQL::type('doctorPagination');
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

        $DoctorsQuery = Doctor::query();

       

        // $DoctorsQuery->where('user_id', $currentUser->id);



        // Filter

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];



            $DoctorsQuery

                ->where(function ($querySe) use ($searchString) {

                    return $querySe

                        ->orWhere( 'name', 'like', '%' . $searchString . '%');

                });
        }



        if (isset($args['date']) && $args['date'] !== '.') {

            $DoctorsQuery->whereDate('date', $args['date']);
        }



        // filter by status

        if (isset($args['status'])) {

            $DoctorsQuery->where('status', $args['status']);
        } else {

            $DoctorsQuery->where('status', '!=', 9);
        }



        $total = $DoctorsQuery->count();



        // get data

        if (count($args) > 0) {

            $currentUser = Auth::user();

            $Doctors = Doctor::where('status', '!=', 9)->get();
        } else {

            // not args, then get all

            $Doctors = User::all();
        }

        return ['data' => $Doctors, 'total' => $total];
    }
}
