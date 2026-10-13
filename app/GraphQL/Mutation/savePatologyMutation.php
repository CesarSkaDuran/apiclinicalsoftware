<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Patology;
use App\AppPatient;

/**
 * CreateFileMutation

 */
class SavePatologyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('patology');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'details' => ['name' => 'details', 'type' => Type::string()],
            'diag_date' => ['name' => 'diag_date', 'type' => Type::string()],
            'res_date' => ['name' => 'res_date', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();
        $appUser = AppPatient::where('user_id', $currentUser->id)->first();

        if (!$appUser) {
            abort(404, 'App Patient not found');
        }

        $patologies = Patology::create([
            'app_user_id' => $appUser->id,
            'name' => $args['name'],
            'details' => isset($args['details']) && $args['details'] != '.' ?  $args['details'] : '',
            'diag_date' => isset($args['diag_date']) && $args['diag_date'] != '.' ?  $args['diag_date'] : '',
            'res_date' => isset($args['res_date']) && $args['res_date'] != '.' ?  $args['res_date'] : '',
        ]);

        return $patologies;
    }
}
