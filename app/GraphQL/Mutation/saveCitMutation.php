<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Cit;

/**
 * CreateFileMutation
 */

class SaveCitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('cit');
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
            $cit = Cit::where('id', $args['id'])->first();
        } else {
            $cit = null;
        }

        if ($cit) {

            if (isset($args['delete'])) {
                Cit::where('id', $cit->id)->delete();
                
                return $cit;
            }

            if (isset($args['date'])) {
                $cit->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['description'])) {
                $cit->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $cit->save();            
        } else {
            // make user with data
            $cit = Cit::create([
                'record_id' => $args['record_id'],
                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $cit;
    }

}

