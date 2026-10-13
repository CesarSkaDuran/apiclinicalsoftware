<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\GraphQL\Shared\AdvancedQuery;
use App\Record;

/**
 * MeQuery
 */
class RecordControlQuery extends Query
{
    protected $attributes = [
        'name' => 'me'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('record'));
    } 

    public function args()
    {
        return array_merge([
            'patient_id' => ['name' => 'patient_id', 'type' => Type::string()]
        ], []);
    }

    public function resolve($root, $args)
    {
        $record = Record::where('patient_id', $args['patient_id'])->get();


        return $record;
    }
}
