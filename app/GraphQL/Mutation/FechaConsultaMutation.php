<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\Record;

/**
 * CreateFileMutation
 */

class FechaConsultaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('record');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'identification' => ['name' => 'identification', 'type' => Type::string()],
            'created_at' => ['name' => 'created_at', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {
        if (isset($args['identification'])) {
            $date = Record::where('identification', $args['identification'])->first();
        } else {
            $date = null;
        }

        if ($date) {
            if (isset($args['created_at'])) {
                $date->created_at = $args['created_at'] != '.' ? urldecode($args['created_at']) : '';
            }

            $date->save();
        } 

        return $date;
    }
}
