<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Labor;
use App\Record;

/**
 * CreateFileMutation
 */

class SaveLaborMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('labor');
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'time' => ['name' => 'time', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'labor_ta' => ['name' => 'labor_ta', 'type' => Type::string()],
            'labor_fcf' => ['name' => 'labor_fcf', 'type' => Type::string()],
            'membranes' => ['name' => 'membranes', 'type' => Type::string()],
            'presentation' => ['name' => 'presentation', 'type' => Type::string()],
            'observations' => ['name' => 'observations', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'record_id' => ['required'],
            'date' => ['required']
        ];
    }

    public function resolve($root, $args)
    {
        $labor = null;

        if (isset($args['id'])) {
            $labor = Labor::where('id', $args['id'])->first();
        } else {
            $labor = Labor::where('record_id', $args['record_id'])->first();
        }

        if ($labor) {
            if (isset($args['date'])) {
                $labor->date = $args['date'];
            }

            if (isset($args['time'])) {
                $labor->time = $args['time'] != '.' ? $args['time'] : '';
            }

            if (isset($args['labor_ta'])) {
                $labor->labor_ta = $args['labor_ta'] != '.' ? $args['labor_ta'] : '';
            }

            if (isset($args['labor_fcf'])) {
                $labor->labor_fcf = $args['labor_fcf'] != '.' ? $args['labor_fcf'] : '';
            }

            if (isset($args['membranes'])) {
                $labor->membranes = $args['membranes'] != '.' ? $args['membranes'] : '';
            }

            if (isset($args['presentation'])) {
                $labor->presentation = $args['presentation'] != '.' ? $args['presentation'] : '';
            }

            if (isset($args['observations'])) {
                $labor->observations = $args['observations'] != '.' ? $args['observations'] : '';
            }

            $labor->save();            
        } else {
            // make user with data
            $labor = Labor::create([
                'record_id' => $args['record_id'],
                'date' => $args['date'],
                'time' => isset($args['time']) && $args['time'] != '.' ?  $args['time'] : null,
                'labor_ta' => isset($args['labor_ta']) && $args['labor_ta'] != '.' ?  $args['labor_ta'] : null,
                'labor_fcf' => isset($args['labor_fcf']) && $args['labor_fcf'] != '.' ?  $args['labor_fcf'] : null,
                'membranes' => isset($args['membranes']) && $args['membranes'] != '.' ?  $args['membranes'] : null,
                'presentation' => isset($args['presentation']) && $args['presentation'] != '.' ?  $args['presentation'] : null,
                'observations' => isset($args['observations']) && $args['observations'] != '.' ?  $args['observations'] : null,
            ]);
        }

        return $labor;
    }

}

