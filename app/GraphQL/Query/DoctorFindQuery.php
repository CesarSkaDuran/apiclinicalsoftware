<?php

namespace App\GraphQL\Query;

use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use HC\Histories\Doctor\Application\FindAllDoctors;
use HC\Histories\Doctor\Infrastructure\EloquentDoctorRepository;
use App\Doctor;

class DoctorFindQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
         return Type::listOf(GraphQL::type('doctor'));
        //return GraphQL::type('doctor');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {
        // $doctorsFinder = new FindAllDoctors(new EloquentDoctorRepository());
        // $doctors = $doctorsFinder->execute();

        // return $doctors->toArray();

        $doctors = Doctor::all();

        $Doctor = Doctor::query();
        if (isset($args['id'])) {

            $Doctor->where('id', $args['id']);
        }

        $Doctors = $Doctor->get();
        return $Doctors;
    }
}
