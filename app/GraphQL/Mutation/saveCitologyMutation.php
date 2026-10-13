<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Citology;

/**
 * CreateFileMutation
 */

class SaveCitologyMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('pregnancy');
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
            $citology = Citology::where('id', $args['id'])->first();
        } else {
            $citology = null;
        }
        if (isset($args['delete'])) {
            Citology::where('id', $citology->id)->delete();
            
            return $citology;
        }

        if ($citology != null) {

            if (isset($args['date'])) {
                $citology->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['description'])) {
                $citology->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $citology->save();            
        } else {
            // make user with data
            $citology = Citology::create([
                'record_id' => $args['record_id'],
                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $citology;
    }

}

