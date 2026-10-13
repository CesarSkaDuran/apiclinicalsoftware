<?php

namespace App\GraphQL\Query;

use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use HC\Histories\Doctor\Application\FindAllDoctors;
use HC\Histories\Doctor\Infrastructure\EloquentDoctorRepository;
use App\Doctor;

class DoctorsQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
         return Type::listOf(GraphQL::type('doctor'));
    }

    public function args()
    {
        return [
            'status' => ['name' => 'status', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {
        // $doctorsFinder = new FindAllDoctors(new EloquentDoctorRepository());
        // $doctors = $doctorsFinder->execute();

        // return $doctors->toArray();
        $doctors = Doctor::where('status', '!=', 9)->get();

        return $doctors;
    }
}

