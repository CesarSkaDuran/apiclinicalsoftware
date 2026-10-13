<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Obs;

/**
 * CreateFileMutation
 */

class SaveObsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('observation');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
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
            $obs = Obs::where('id', $args['id'])->first();
        } else {
            $obs = null;
        }

        if ($obs) {
            if (isset($args['description'])) {
                $obs->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $obs->save();            
        } else {
            // make user with data
            $obs = Obs::create([
                'record_id' => $args['record_id'],
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $obs;
    }

}

