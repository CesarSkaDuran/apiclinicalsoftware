<?php

namespace App\GraphQL\Query;

use App\Course;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Procedure;
/**
 * MeQuery
 */
class ProcedureAllQuery extends Query
{
    protected $attributes = [
        'name' => 'procedure'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('procedure'));
    }

    // public function args()
    //{
    // return array_merge([
    //   'id' => ['name' => 'id', 'type' => Type::int()]
    //], []);
    //}
    public function args()

    {

        return array_merge([

            'id' => ['name' => 'id', 'type' => Type::id()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            
        ], []);
    }

    public function resolve($root, $args)
    {
        //if (isset($args['id'])) {
        //   $course = Course::where('id', $args['id'])->get();
        $course = Procedure::all();
        return $course;
    }
    //  $course = Course::all();


}
