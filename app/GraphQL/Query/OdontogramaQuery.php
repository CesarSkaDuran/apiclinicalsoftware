<?php

namespace App\GraphQL\Query;


use App\Odontograma;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use App\GraphQL\Shared\AdvancedQuery;
class OdontogramaQuery extends Query
{
    protected $attributes = [
        'name' => 'solicitud'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('odontograma'));
    }

    public function args()
    {
        return array_merge( [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'id' => ['name' => 'id', 'type' => Type::int()]
        ], AdvancedQuery::queryParams());
    }

    public function resolve($root, $args, $context)
    {

        

        $solicitud = Odontograma::query();



        if (isset($args['record_id'])) {
            $solicitud->where('record_id', $args['record_id']);
            // $solicitud->where('record_id', $args['record_id'])->where('status', $args['status']);
        } else {
            $solicitud->all();
        }

        $data = $solicitud->get();

        return $data;
    }
}
