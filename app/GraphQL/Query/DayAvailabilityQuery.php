<?php

namespace App\GraphQL\Query;

use App\Appointment;
use App\Doctor;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;

class DayAvailabilityQuery extends Query
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
            'doctor_id' => ['name' => 'doctor_id', 'type' => Type::int()],
            'day' => ['name' => 'day', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context)
    {
        $currentUser = Auth::user();

        $doctor = Doctor::where('id', $args['doctor_id'])->first();

        $appointments = Appointment::where('date', $args['day'])->where('user_id', $doctor->user_id)->get();

        return $appointments;
        // return $appointments->toArray();
    }
}
