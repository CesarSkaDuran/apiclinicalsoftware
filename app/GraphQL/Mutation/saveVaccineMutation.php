<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Vaccine;

/**
 * CreateFileMutation
 */

class SaveVaccineMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('vaccine');
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
            $vaccine = Vaccine::where('id', $args['id'])->first();
        } else {
            $vaccine = null;
        }

        if ($vaccine) {

            if (isset($args['delete'])) {
                Vaccine::where('id', $vaccine->id)->delete();
                
                return $vaccine;
            }

            if (isset($args['date'])) {
                $vaccine->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['description'])) {
                $vaccine->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $vaccine->save();            
        } else {
            // make user with data
            $vaccine = Vaccine::create([
                'record_id' => $args['record_id'],
                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'description' => isset($args['description']) && $args['description'] != '.' ?  urldecode($args['description']) : null
            ]);
        }

        return $vaccine;
    }

}

