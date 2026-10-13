<?php

namespace App\GraphQL\Query;


use App\Odontograma;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;

class DienteIndividualQuery extends Query
{
    protected $attributes = [
        'name' => 'solicitud'
    ];

    public function type()
    {
        return  Type::listOf(GraphQL::type('odontograma'));
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'diente_id' => ['name' => 'diente_id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {



        $solicitud = Odontograma::query();



        if (isset($args['record_id'])) {
            if(isset($args['diente_id'])){
                $solicitud->where('record_id', $args['record_id'])->where('diente_id', $args['diente_id']);
            }else{

                $solicitud->where('record_id', $args['record_id']);
            }
            // $solicitud->where('record_id', $args['record_id'])->where('status', $args['status']);
        } else {
            $solicitud->all();
        }

        $data = $solicitud->get();

        return $data;
    }
}
