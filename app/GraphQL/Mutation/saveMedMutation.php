<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Med;
use App\AppPatient;

/**
 * CreateFileMutation

 */
class SaveMedMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('med');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'details' => ['name' => 'details', 'type' => Type::string()],
            'frequency' => ['name' => 'frequency', 'type' => Type::string()],
            'amount' => ['name' => 'amount', 'type' => Type::string()],
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

        $med = Med::create([
            'app_user_id' => $appUser->id,
            'name' => $args['name'],
            'details' => isset($args['details']) && $args['details'] != '.' ?  $args['details'] : '',
            'frequency' => isset($args['frequency']) && $args['frequency'] != '.' ?  $args['frequency'] : '',
            'amount' => isset($args['amount']) && $args['amount'] != '.' ?  $args['amount'] : '',
        ]);

        return $med;
    }
}
