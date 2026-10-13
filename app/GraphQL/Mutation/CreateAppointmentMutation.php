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
use App\Patient;
use App\Record;
use App\Appointment;
use App\Doctor;

class CreateAppointmentMutation extends Mutation
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
            'user_id' => ['name' => 'user_id', 'type' => Type::int()],
            'remision_id' => ['name' => 'remision_id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'company' => ['name' => 'company', 'type' => Type::string()],
            'value' => ['name' => 'value', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'time' => ['name' => 'time', 'type' => Type::string()],
            'phone_confirmation' => ['name' => 'phone_confirmation', 'type' => Type::string()],
            'email_confirmation' => ['name' => 'email_confirmation', 'type' => Type::string()],
            'type' => ['name' => 'type', 'type' => Type::int()],
            'payment_type' => ['name' => 'payment_type', 'type' => Type::int()],
            'reason' => ['name' => 'reason', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {
        $currentUser = Auth::user();
        $doctor = Doctor::where('id', $args['user_id'])->first();
        $appointmentCreator = new CreateAppointmentAsAppUser(new EloquentAppointmentRepository());
        $appUserFinder = new AppPatientFinderByUser(new EloquentAppPatientRepository());

        $appPatient = $appUserFinder->execute($currentUser->id);

        $args['app_user_id'] = $appPatient->id();
        $args['user_id'] = $doctor->user_id;
        $args['name'] = $appPatient->name();
        $appointmentId = $appointmentCreator->execute($args);

        $patientMatch = Patient::where('user_id', $args['user_id'])->where(function ($query) use ($appPatient, $currentUser) {
            return $query->where('identification', $appPatient->identity())->orWhere('email', $currentUser->email);
        })->first();

        if (!$patientMatch) {
            // make user with data
            $patient = Patient::create([
                'user_id' => $doctor->user_id,
                'name' => $appPatient->name(),
                'identification' => $appPatient->identity(),
                'position' => '',
                'civil_status' => '',
                'birth_date' => $appPatient->birth_date(),
                'phone' => '',
                'address' => '',
                'company' => '',
                'email' => $currentUser->email,
                'partner_name' => '',
                'partner_profession' => '',
                'chat_id' => $currentUser->chat_id
            ]);

            $record = Record::create([
                'user_id' => $currentUser->id,
                'patient_id' => $patient->identification,
                'identification' => $patient->identification . '-1',
            ]);

            $appointment = Appointment::where('id', $appointmentId)->first();
            $appointment->patient_id = $patient->id;
            $appointment->save();
        } else {
            if ($patientMatch->chat_id == null) {
                $patientMatch->chat_id = $currentUser->chat_id;
                $patientMatch->save();
            }

            $appointment = Appointment::where('id', $appointmentId)->first();
            $appointment->patient_id = $patientMatch->id;
            $appointment->save();
        }

        return ['id' => $appointmentId];
    }
}
