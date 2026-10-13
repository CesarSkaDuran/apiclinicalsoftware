<?php

namespace App\GraphQL\Query;

use App\AppMember;

use App\Sucursal;
use App\Temporal;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;

class TemporalQuery extends Query
{
    protected $attributes = [
        'name' => 'solicitud'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('temporal'));
    }

    public function args()
    {
        return [
            'id_empresa' => ['name' => 'id_empresa', 'type' => Type::int()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {

        $currentUser = Auth::user();

        $solicitud = Temporal::query();



        if (isset($args['id_empresa'])) {

        $solicitud->where('id_empresa', $args['id_empresa'])->where('user_id', $currentUser->id);
        
        $data = $solicitud->get();
        
        } else {
          $data = Temporal::where('user_id', $currentUser->id)->get();
        }

        

        return $data;
    }
}
