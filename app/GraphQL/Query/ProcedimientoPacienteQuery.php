<?php

namespace App\GraphQL\Query;


use App\Odontograma;
use App\PlanTratamiento;
use App\ProcedimientoPaciente;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;

class ProcedimientoPacienteQuery extends Query
{
    protected $attributes = [
        'name' => 'solicitud'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('procedimientoPaciente'));
    }

    public function args()
    {
        return [
            'user_id' => ['name' => 'record_id', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'tipo' => ['name' => 'tipo', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context)
    {



        $solicitud = ProcedimientoPaciente::query();



        if (isset($args['record_id'])) {

            $solicitud->where('record_id', $args['record_id'])->where('tipo', $args['tipo']);
        }
        
        else if (isset($args['user_id'])) {

            $solicitud->where('user_id', $args['user_id']);
        } 

        else {
        
            $solicitud->all();
        
        }

        $data = $solicitud->get();

        return $data;
    }
}
