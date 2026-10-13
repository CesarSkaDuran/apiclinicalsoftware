<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use HC\Histories\Appointment\Application\CreateAppointmentAsAppUser;
use HC\Histories\Appointment\Infrastructure\EloquentAppointmentRepository;
use HC\Histories\AppPatient\Application\AppPatientFinderByUser;
use HC\Histories\AppPatient\Infrastructure\EloquentAppPatientRepository;
use Illuminate\Support\Facades\Auth;
use App\Appointment;

class CreateDoctorAppointmentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('appointment');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'patient_id' => ['name' => 'patient_id', 'type' => Type::int()],
            'remision_id' => ['name' => 'remision_id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'value' => ['name' => 'value', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'time' => ['name' => 'time', 'type' => Type::string()],
            'end_time' => ['name' => 'end_time', 'type' => Type::string()],
            'reason' => ['name' => 'reason', 'type' => Type::string()],
            'payment_type' => ['name' => 'payment_type', 'type' => Type::int()],
            'type' => ['name' => 'type', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()],
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {
        $currentUser = Auth::user();
        $appointmentCreator = new CreateAppointmentAsAppUser(new EloquentAppointmentRepository());
        $appUserFinder = new AppPatientFinderByUser(new EloquentAppPatientRepository());

        // $appPatient = $appUserFinder->execute($currentUser->id);
        // $args['app_user_id'] = $appPatient->id();
        if (isset($args['id'])) {
            $appointment = Appointment::where('id', $args['id'])->first();

            if ($appointment) {
                $appointment->name = isset($args['name']) ? $args['name'] : $appointment->name;
                $appointment->value = $args['value'];
                $appointment->date = $args['date'];
                $appointment->time = $args['time'];
                $appointment->end_time = $args['end_time'];
                $appointment->payment_type = isset($args['payment_type']) ? $args['payment_type'] : $appointment->payment_type;
                $appointment->reason = isset($args['reason']) ? $args['reason'] : $appointment->reason;
                $appointment->type = $args['type'];
                $appointment->status = $args['status'];
                
                $appointment->remision_id = isset($args['remision_id']) ? $args['remision_id'] : $appointment->remision_id;
                $appointment->save();

                return ['id' => $appointment->id];
            }

            return ['id' => null];
        } else {
            $args['user_id'] = $currentUser->id;
            
            $appointmentId = $appointmentCreator->execute($args);
    
            return ['id' => $appointmentId];
        }
    }
}
