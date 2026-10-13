<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use App\PlanTratamiento;

/**
 * CreateFileMutation
 */

class PlanTratamientoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('planTratamiento');
    }

    public function args()
    {
        return [

            'id' => ['name' => 'id', 'type' => Type::int()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            'patient_id' => ['name' => 'patient_id', 'type' => Type::string()],
            'user_id' => ['name' => 'user_id', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'valor' => ['name' => 'valor', 'type' => Type::int()],

        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {

        $data = null;

        if (isset($args['id'])) {

            $data = PlanTratamiento::where('id', $args['id'])->first();
        } else {

            $data = null;
        }



        if ($data) {

            if (isset($args['delete'])) {
                PlanTratamiento::where('id', $args['id'])->delete();

                return $data;
            }
            if (isset($args['user_id'])) {
                $data->user_id = $args['user_id'] != '.' ? urldecode($args['user_id']) : '';
            }
            if (isset($args['status'])) {
                $data->status = $args['status'] != '.' ? urldecode($args['status']) : '';
            }

            if (isset($args['valor'])) {
                $data->valor = $args['valor'] != '.' ? urldecode($args['valor']) : '';
            }
            if (isset($args['nombre'])) {
                $data->nombre = $args['nombre'] != '.' ? urldecode($args['nombre']) : '';
            }

            $data->save();
        } else {
            $currentUser = auth('api')->user();
            $data = PlanTratamiento::create([
                // 'nombre'=>$args['nombre'],
                'record_id' => $args['record_id'],
                'patient_id' => $args['patient_id'],
                'user_id' => $currentUser->id,
                'valor' => isset($args['valor']) && $args['valor'] != '.' ?  urldecode($args['valor']) : '',

            ]);
        }
        return $data;
    }
}
