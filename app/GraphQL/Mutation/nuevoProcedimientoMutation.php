<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Procedure;
use App\AppPatient;
use App\Doctor;
use App\ProcedimientoDental;

/**
 * CreateFileMutation

 */
class nuevoProcedimientoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update  record'
    ];

    public function type()
    {
        return GraphQL::type('procedimientoDental');
    }

    public function args()
    {
        return [
            
            'id' => ['name' => 'id', 'type' => Type::int()],

            'nombre' => ['nombre' => 'nombre', 'type' => Type::string()],
            
            'categoria_id' => ['name' => 'categoria_id', 'type' => Type::int()],
            
            'valor1' => ['name' => 'valor1', 'type' => Type::int()],
            
            'valor2' => ['name' => 'valor2', 'type' => Type::int()],

            'delete' => ['name' => 'delete', 'type' => Type::int()],

        ];
    }

    public function rules()
    {
        return [
            //  'name' => ['required'],
        ];
    }

    public function resolve($root, $args)
    
    {
        
        $currentUser = auth('api')->user();

        if (isset($args['delete'])) {

            $data = ProcedimientoDental::where('id', $args['id'])->delete();

            return $data;

        }

        if (isset($args['id'])) {

            $data = ProcedimientoDental::where('id', $args['id'])->first();

        } 
        
        else 
        
        {
            $data = null;
        }

        if ($data) {
           
            $data->nombre = isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null;

            $data->categoria_id = isset($args['categoria_id']) && $args['categoria_id'] != '.' ?  $args['categoria_id'] : null;

            $data->valor1 = isset($args['valor1']) && $args['valor1'] != '.' ?  $args['valor1'] : null;

            $data->valor2 = isset($args['valor2']) && $args['valor2'] != '.' ?  $args['valor2'] : null;

            $data->save();
        
        }

        else
        
        {
            
            $data = ProcedimientoDental::create([
                
                'nombre' => $args['nombre'],
                
                'user_id' => $currentUser->id,
                
                'categoria_id' => isset($args['categoria_id']) && $args['categoria_id'] != '.' ?  $args['categoria_id'] : '',
                
                'valor1' => isset($args['valor1']) && $args['valor1'] != '.' ?  $args['valor1'] : '',
                
                'valor2' => isset($args['valor2']) && $args['valor2'] != '.' ?  $args['valor2'] : '',

            ]);

        }
        
        return $data;
    }
}
