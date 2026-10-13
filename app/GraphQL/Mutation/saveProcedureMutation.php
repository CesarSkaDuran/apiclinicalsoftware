<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Procedure;
use App\AppPatient;
use App\Doctor;

/**
 * CreateFileMutation

 */
class saveProcedureMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update  record'
    ];

    public function type()
    {
        return GraphQL::type('procedure');
    }

    public function args()
    {
        return [
            // 'name' => ['name' => 'name', 'type' => Type::string()],
            'code' => ['name' => 'code', 'type' => Type::string()],
            'description' => ['name' => 'description', 'type' => Type::string()],
            'tipo_procedimiento' => ['name' => 'tipo_procedimiento', 'type' => Type::string()],

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
        $appUser = Doctor::where('user_id', $currentUser->id)->first();

        if (!$appUser) {
            abort(404, 'App Patient not found');
        }

        $med = Procedure::create([
            // 'name' => $args['name'],
            'user_id' => $appUser->id,
            'code' => isset($args['code']) && $args['code'] != '.' ?  $args['code'] : '',
            'description' => isset($args['description']) && $args['description'] != '.' ?  $args['description'] : '',
            'tipo_procedimiento' => isset($args['tipo_procedimiento']) && $args['tipo_procedimiento'] != '.' ?  $args['tipo_procedimiento'] : '',

        ]);

        return $med;
    }
}
