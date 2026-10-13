<?php



namespace App\GraphQL\Query;



use GraphQL;

use GraphQL\Type\Definition\Type;

use GraphQL\Type\Definition\ResolveInfo;

use Folklore\GraphQL\Support\Query;

use App\GraphQL\Shared\AdvancedQuery;

use App\Appointment;
use HC\Histories\AppPatient\Application\AppPatientFinderByUser;
use HC\Histories\AppPatient\Infrastructure\EloquentAppPatientRepository;


/**

 * CompaniesQuery

 */

class AppointmentsPaginationQuery extends Query

{

    protected $attributes = [

        'name' => 'records'

    ];



    public function type()

    {

         return GraphQL::type('appointmentsPagination');

    }



    public function args()
    {
        return array_merge([
            'type' => ['name' => 'type', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'date2' => ['name' => 'date2', 'type' => Type::string()],
            'type' => ['name' => 'type', 'type' => Type::int()],
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context, ResolveInfo $info)

    {

        $currentUser = auth('api')->user();
        
        $appUserFinder = new AppPatientFinderByUser(new EloquentAppPatientRepository());

        $appPatient = $appUserFinder->execute($currentUser->id);
        // Prepare query

        $appointmentsQuery = Appointment::query();

        $incomes = $appointmentsQuery->get();

      

         $incomes = Appointment::all();
      

        if ($currentUser->is_doctor) {
            // $appointments = $doctorAppointmentsFinder->execute($currentUser->id, $month, $search);
            $appointmentsQuery->where('user_id', $currentUser->id);
        } else {
            // $appointments = $appointmentsFinder->execute($appPatient->id(), $month, $search);
            $appointmentsQuery->where('app_user_id', $appPatient->id());
        }



        // Filter

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $appointmentsQuery->where('name', 'like', '%' . $searchString . '%');
        }

        
        if (isset($args['type']) && $args['type'] !== '.') {
            
            $appointmentsQuery->where('type', $args['type']);
        }
        if (isset($args['date']) && !isset($args['date2'])) {
            
            $appointmentsQuery->whereDate('date', '>=', $args['date']);
            
        }

        if (isset($args['date']) && $args['date'] !== '.') {

            $appointmentsQuery->whereDate('date', $args['date']);
        }
        if (isset($args['date']) && $args['date'] !== '.') {

            $appointmentsQuery->whereDate('date', $args['date']);
        }

        if (!isset($args['date']) && isset($args['date2'])) {

            $appointmentsQuery->whereDate('date', '=<', $args['date']);

        }

        if (isset($args['date']) && isset($args['date2'])) {

            $appointmentsQuery->whereBetween('date',  [$args['date'], $args['date2']]);

        }
        
        // if (!isset($args['date']) && !isset($args['date2'])) {

        //     $appointmentsQuery->whereDate('date',  date('Y-m-d'));

        // }



        // filter by status

        // if (isset($args['status'])) {

        //     $appointmentsQuery->where('status', $args['status']);

        // } else {

        //     $appointmentsQuery->where('status', '!=', 9);            

        // }



        $total = $appointmentsQuery->count();



        // get data

        if (count($args) > 0) {

            $appointmentsQuery = AdvancedQuery::extendQuery($appointmentsQuery, $args);

            $incomes = $appointmentsQuery->get();

        } else {

            // not args, then get all

            $incomes = Appointment::all();

        }



        return ['data' => $incomes, 'total' => $total];

    }

}

