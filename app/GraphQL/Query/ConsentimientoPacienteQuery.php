<?php

namespace App\GraphQL\Query;

use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\Chat;
use App\Consentimiento;
use App\ConsentimientoPaciente;

class ConsentimientoPacienteQuery extends Query
{
    protected $attributes = [
        'name' => 'records'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('consentimientoPaciente'));
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'search' => ['name' => 'search', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context)
    {
        $currentUser = auth('api')->user();

      
        $proceduresQuery = ConsentimientoPaciente::query();

        if (isset($args['search']) && $args['search'] !== '.') {

            $searchString = $args['search'];

            $proceduresQuery
                ->where('nombre', 'like', '%' . $searchString . '%')
                // ->orWhere('description', 'like', '%' . $searchString . '%')
                ->limit(500);
        }else{
            $proceduresQuery = ConsentimientoPaciente::where('record_id', $args['record_id']);
        }

        $procedures = $proceduresQuery->get();

        return $procedures;
     
    }
}
