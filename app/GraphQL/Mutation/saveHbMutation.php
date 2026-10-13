<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Hb;

/**
 * CreateFileMutation
 */

class SaveHbMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('hb');
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
            $hb = Hb::where('id', $args['id'])->first();
        } else {
            $hb = null;
        }

        if ($hb) {

            if (isset($args['delete'])) {
                Hb::where('id', $hb->id)->delete();
                
                return $hb;
            }

            if (isset($args['date'])) {
                $hb->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['description'])) {
                $hb->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $hb->save();            
        } else {
            // make user with data
            $hb = Hb::create([
                'record_id' => $args['record_id'],
                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $hb;
    }

}

