<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;

/**

 * CreateFileMutation

 */

class ProfileMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update user'
    ];

    public function type()
    {
        return GraphQL::type('user');
    }


    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'last_name' => ['name' => 'last_name', 'type' => Type::string()],
            'identification' => ['name' => 'identification', 'type' => Type::string()],
            'birth_date' => ['name' => 'birth_date', 'type' => Type::string()],
            'sex' => ['name' => 'sex', 'type' => Type::string()],
            'profession' => ['name' => 'profession', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],
            'phone' => ['name' => 'phone', 'type' => Type::string()],
            'city' => ['name' => 'city', 'type' => Type::string()],
            'address' => ['name' => 'address', 'type' => Type::string()]
        ];
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'last_name' => ['required'],
            'identification' => ['required'],
        ];
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();
        $currentUserInfo = $currentUser->info;

        if (isset($args['name'])) {
            $currentUser->name = $args['name'];
        }
        
        if (isset($args['last_name'])) {
            $currentUser->last_name = $args['last_name'];
        }

        if (isset($args['identification'])) {
            $currentUser->identification = $args['identification'];
        }

        if (isset($args['birth_date'])) {
            $currentUserInfo->birth_date = $args['birth_date'];
        }

        if (isset($args['sex'])) {
            $currentUserInfo->sex = $args['sex'];
        }

        if (isset($args['profession'])) {
            $currentUserInfo->profession = $args['profession'];
        }

        if (isset($args['password'])) {
            $currentUser->password = bcrypt($args['password']);
        }

        if (isset($args['phone'])) {
            $currentUser->phone = $args['phone'];
        }

        if (isset($args['city'])) {
            $currentUserInfo->city = $args['city'];
        }

        if (isset($args['address'])) {
            $currentUser->address = $args['address'];
        }

        $currentUser->save();
        $currentUserInfo->save();

        return $currentUser;
    }
}
