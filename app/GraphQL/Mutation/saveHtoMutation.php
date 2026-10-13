<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Hto;

/**
 * CreateFileMutation
 */

class SaveHtoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('hto');
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
            $hto = Hto::where('id', $args['id'])->first();
        } else {
            $hto = null;
        }

        if ($hto) {

            if (isset($args['delete'])) {
                Hto::where('id', $hto->id)->delete();
                
                return $hto;
            }

            if (isset($args['date'])) {
                $hto->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['description'])) {
                $hto->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $hto->save();            
        } else {
            // make user with data
            $hto = Hto::create([
                'record_id' => $args['record_id'],
                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $hto;
    }

}

