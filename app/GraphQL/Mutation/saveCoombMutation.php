<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Coomb;

/**
 * CreateFileMutation
 */

class SaveCoombMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('coomb');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],
            'description' => ['name' => 'description', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            $coomb = Coomb::where('id', $args['id'])->first();
        } else {
            $coomb = null;
        }

        if ($coomb) {

            if (isset($args['delete'])) {
                Coomb::where('id', $coomb->id)->delete();
                
                return $coomb;
            }

            if (isset($args['date'])) {
                $coomb->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['description'])) {
                $coomb->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $coomb->save();            
        } else {
            // make user with data
            $coomb = Coomb::create([
                'record_id' => $args['record_id'],
                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $coomb;
    }

}

