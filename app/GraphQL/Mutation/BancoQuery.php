<?php

namespace App\GraphQL\Query;

use App\Banco;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;


class BancoQuery extends Query
{
    protected $attributes = [
        'name' => 'member'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('banco'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context)
    {
        // $currentUser = Auth::user();

        if(isset($args['id'])){

            $solicitud = Banco::where('id', $args['id'])->get();
        }else{
            $solicitud = Banco::all();
        }


        return $solicitud;
    }
}
