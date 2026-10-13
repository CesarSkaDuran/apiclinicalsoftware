<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Allergie;
use App\AppPatient;

/**
 * CreateFileMutation

 */
class SaveAllergieMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('allergie');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'details' => ['name' => 'details', 'type' => Type::string()],
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
        
        $allergie = Allergie::create([
            'app_user_id' => $appUser->id,
            'name' => $args['name'],
            'details' => isset($args['details']) && $args['details'] != '.' ?  $args['details'] : '',
        ]);            

        return $allergie;
    }
}
