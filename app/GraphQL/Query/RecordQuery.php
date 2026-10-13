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
class RecordQuery extends Query
{
    protected $attributes = [
        'name' => 'me'
    ];

    public function type()
    {
        return GraphQL::type('record');
    }

    public function args()
    {
        return array_merge([
            'id' => ['name' => 'id', 'type' => Type::id()]
        ], []);
    }

    public function resolve($root, $args)
    {
        $record = Record::where('identification', $args['id'])->first();

        if (!$record) {
            abort(404, 'Record not found');
        }
        return $record;
    }
}
