<?php

namespace App\GraphQL\Query;

use App\DetalleCobro;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

/**
 * MeQuery
 */
class DetalleCobroQuery extends Query
{
    protected $attributes = [
        'name' => ''
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('detalleCobro'));
    }

    public function args()
    {
        return array_merge([
            'cobro_id' => ['name' => 'cobro_id', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()],
        ], []);
    }

    public function resolve($root, $args)
    {

        if (isset($args['cobro_id'])) {

            $course = DetalleCobro::where('cobro_id', $args['cobro_id'])->where('valor', '>', 1)->get()->sortByDesc("id");
        } else {
            $course = DetalleCobro::all();
        }
        return $course;
    }
}
