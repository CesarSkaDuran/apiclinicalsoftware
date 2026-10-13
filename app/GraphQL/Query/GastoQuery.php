<?php

namespace App\GraphQL\Query;

use App\Course;
use App\CuentaCobro;
use App\Gasto;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

/**
 * MeQuery
 */
class GastoQuery extends Query
{
    protected $attributes = [
        'name' => 'cuentaCobro'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('gasto'));
    }

    public function args()
    {
        return array_merge([

            'id_afiliacion' => ['name' => 'id_afiliacion', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()]
        ], []);
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();

        if (isset($args['id_afiliacion'])) {

            $cuentaCobro = Gasto::where('id_afiliacion', $args['id_afiliacion'])->where('user_id', $currentUser->id)->get();
        } else {

            $cuentaCobro = Gasto::where('user_id', $currentUser->id)->get();;
        }

        return $cuentaCobro;
    }
}
