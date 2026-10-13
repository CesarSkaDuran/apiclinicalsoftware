<?php

namespace App\GraphQL\Query;

use App\AppMember;
use GraphQL;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use App\AppPatient;
use Illuminate\Support\Facades\Auth;

class AppPatientQuery extends Query
{
    protected $attributes = [
        'name' => 'member'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('appPatient'));
    }

    public function args()
    {
        return [
            'status' => ['name' => 'status', 'type' => Type::int()],
            'user_id' => ['name' => 'user_id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context)
    {
        // if (isset($args['user_id'])) {
        // $member = AppMember::where('id', $args['user_id'])->get();
        $currentUser = Auth::user();

        $patient = AppPatient::where('user_id', $currentUser->id)->get();

        return $patient;
        //    }
    }
}
