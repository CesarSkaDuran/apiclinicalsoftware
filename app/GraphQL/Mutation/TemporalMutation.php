<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use App\Temporal;
use Illuminate\Support\Facades\Auth;

/**

 * CreateFileMutation

 */



class TemporalMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('temporal');
    }



    public function args()

    {

        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'id_empresa' => ['name' => 'id_empresa', 'type' => Type::int()],
            'sucursal_id' => ['name' => 'sucursal_id', 'type' => Type::int()],
            'iva' => ['name' => 'iva', 'type' => Type::int()],
            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            'cuatroxmil' => ['name' => 'cuatroxmil', 'type' => Type::int()],
            'obs' => ['name' => 'obs', 'type' => Type::string()],
            'fecha' => ['name' => 'fecha', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'valor' => ['name' => 'valor', 'type' => Type::int()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],
            'deleteAll' => ['name' => 'deleteAll', 'type' => Type::int()],
        ];
    }



    public function rules()

    {

        return [];
    }



    public function resolve($root, $args)

    {
        $currentUser = auth('api')->user();

        if (isset($args['id'])) {

            $income = Temporal::where('id', $args['id'])->first();
        } else {

            $income = null;
        }
        if (isset($args['deleteAll'])) {
            Temporal::truncate();

            return $income;
        }

        if ($income) {
            if (isset($args['delete'])) {
                Temporal::where('id', $args['id'])->delete();

                return $income;
            }

            

            $income->save();
        } else {
            // make user with data
            $user =  Auth::user();;
            $income = Temporal::create([
                
                // 'user_id' => $currentUser->id,
                'id_empresa' => isset($args['id_empresa']) && $args['id_empresa'] != '.' ?  urldecode($args['id_empresa']) : null,
                'nombre' => isset($args['nombre']) && $args['nombre'] != '.' ?  urldecode($args['nombre']) : null,
                'fecha' => isset($args['fecha']) && $args['fecha'] != '.' ?  $args['fecha'] : null,
                'status' => 1,
                'cuatroxmil' => isset($args['cuatroxmil']) && $args['cuatroxmil'] != '.' ?  $args['cuatroxmil'] : null,
                'valor' => isset($args['valor']) && $args['valor'] != '.' ?  $args['valor'] : null,
                'user_id' => $user->id,
                'iva' => isset($args['iva']) && $args['iva'] != '.' ?  $args['iva'] : null,
                'obs' => isset($args['obs']) && $args['obs'] != '.' ?  $args['obs'] : null,
            ]);
        }

        return $income;
    }
}
