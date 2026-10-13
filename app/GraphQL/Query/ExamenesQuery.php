<?php

namespace App\GraphQL\Query;

use App\AppMember;
use App\Examen;
use App\Observacion;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\Propect;
use App\Solicitud;
use Illuminate\Support\Facades\Auth;

class ExamenesQuery extends Query
{
    protected $attributes = [
        'name' => 'solicitud'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('examenes'));
    }

    public function args()
    {
        return [
            'recor_id' => ['name' => 'recor_id', 'type' => Type::int()],
            // 'user_id' => ['name' => 'user_id', 'type' => Type::int()],
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {

        $currentUser = Auth::user();

        $solicitud = Examen::query();



        if (isset($args['recor_id'])) {

            $solicitud->where('recor_id', $args['recor_id']);
        } else {
            $solicitud->where('user_id', $currentUser->id);
        }

        $data = $solicitud->get();

        return $data;
    }
}
