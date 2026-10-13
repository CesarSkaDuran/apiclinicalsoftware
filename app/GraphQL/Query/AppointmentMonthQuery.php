<?php

namespace App\GraphQL\Query;

use App\Appointment;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use HC\Histories\Appointment\Application\FindAppointmentsByAppUser;
use HC\Histories\Appointment\Application\FindAppointmentsByDoctor;
use HC\Histories\Appointment\Infrastructure\EloquentAppointmentRepository;
use HC\Histories\AppPatient\Application\AppPatientFinderByUser;
use HC\Histories\AppPatient\Infrastructure\EloquentAppPatientRepository;
use Illuminate\Support\Facades\Auth;
use DB;

class AppointmentMonthQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('appointment'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'user_id' => ['name' => 'user_id', 'type' => Type::int()],
            'payment_type' => ['name' => 'payment_type', 'type' => Type::int()],
            'month' => ['name' => 'month', 'type' => Type::string()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            'type' => ['name' => 'type', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context)
    {
        $currentUser = Auth::user();

        $appUserFinder = new AppPatientFinderByUser(new EloquentAppPatientRepository());
        $appointmentsFinder = new FindAppointmentsByAppUser(new EloquentAppointmentRepository());
        $doctorAppointmentsFinder = new FindAppointmentsByDoctor(new EloquentAppointmentRepository());

        $appPatient = $appUserFinder->execute($currentUser->id);

        $month = isset($args['month']) ? $args['month'] : null;
        $search = isset($args['search']) ? $args['search'] : null;

        //  $appointmentsQuery = Appointment::select(DB::raw("name, date,  as count"))
        // ->groupBy("date")
        // ->orderBy('date', 'DESC')
        //->get();


        // $appointmentsQuery = Appointment::query();

        // $data = Appointment::latest('id')->first();
        $mesactual = date("d");

        $appointmentsQuery = Appointment::whereDay('date', $mesactual);


        if (isset($args['id'])) {

            $appointmentsQuery->where('id', $args['id']);
        }

        if (isset($args['type']) && $args['type'] !== '.') {

            $appointmentsQuery->where('type', $args['type']);
        }

        if (isset($args['user_id'])) {

            $appointmentsQuery->where('user_id', $args['user_id']);
        }

        if ($currentUser->is_doctor) {
            // $appointments = $doctorAppointmentsFinder->execute($currentUser->id, $month, $search);
            $appointmentsQuery->where('user_id', $currentUser->id);
        } else {
            // $appointments = $appointmentsFinder->execute($appPatient->id(), $month, $search);
            $appointmentsQuery->where('app_user_id', $appPatient->id());
        }

        if (isset($args['status'])) {
            $appointmentsQuery->where('status', $args['status']);
        } 

        if (isset($args['payment_type'])) {
            $appointmentsQuery->where('payment_type', $args['payment_type']);
        }

        $appointments = $appointmentsQuery->get();

        return $appointments;

        
        // return $appointments->toArray();
    }
}
