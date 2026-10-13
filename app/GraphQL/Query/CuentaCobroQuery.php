<?php

namespace App\GraphQL\Query;

use App\Course;
use App\CuentaCobro;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

/**
 * MeQuery
 */
class CuentaCobroQuery extends Query
{
    protected $attributes = [
        'name' => 'cuentaCobro'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('cuentaCobro'));
    }

    public function args()
    {
    return array_merge([
     
        'id_afiliacion' => ['name' => 'id_afiliacion', 'type' => Type::int()],
        'status' => ['name' => 'status', 'type' => Type::int()],
        'search' => ['name' => 'search', 'type' => Type::string()]
    ], []);
    
}

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();
        if (isset($args['status'])) {
            $cuentaCobro = CuentaCobro::where('id_afiliacion', $args['id_afiliacion'])
                ->where('status', $args['status'])->where('user_id', $currentUser->id)->get();
           
        
        }elseif(isset($args['id_afiliacion'])){
            $cuentaCobro = CuentaCobro::where('id_afiliacion', $args['id_afiliacion'])->get();
        }
        else{

            $cuentaCobro = CuentaCobro::where('user_id', $currentUser->id)->get();
        }

        return $cuentaCobro;
    }

}
