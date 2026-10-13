<?php

namespace App\GraphQL\Query;


use App\Odontograma;
use App\PlanTratamiento;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;

class PlanTratamientoQuery extends Query
{
    protected $attributes = [
        'name' => 'solicitud'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('planTratamiento'));
    }

    public function args()
    {
        return [
            'patient_id' => ['name' => 'patient_id', 'type' => Type::string()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context)
    {


        $solicitud = PlanTratamiento::query();

        if (isset($args['patient_id'])) {

            $solicitud->where('patient_id', $args['patient_id']);
        } else {
            $solicitud->all();
        }

        $data = $solicitud->get();

        return $data;
    }
}
