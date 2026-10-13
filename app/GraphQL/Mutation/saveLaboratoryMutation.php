<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Laboratory;
use App\Record;

/**
 * CreateFileMutation
 */

class SaveLaboratoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('laboratory');
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'patient_group' => ['name' => 'patient_group', 'type' => Type::string()],
            'patient_rh' => ['name' => 'patient_rh', 'type' => Type::string()],
            'partner_group' => ['name' => 'partner_group', 'type' => Type::string()],
            'partner_rh' => ['name' => 'partner_rh', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'record_id' => ['required']
        ];
    }

    public function resolve($root, $args)
    {
        $laboratory = null;

        if (isset($args['id'])) {
            $laboratory = Laboratory::where('id', $args['id'])->first();
        } else {
            $laboratory = Laboratory::where('record_id', $args['record_id'])->first();
        }

        if ($laboratory) {
            if (isset($args['patient_group'])) {
                $laboratory->patient_group = $args['patient_group'] != '.' ? $args['patient_group'] : '';
            }

            if (isset($args['patient_rh'])) {
                $laboratory->patient_rh = $args['patient_rh'] != '.' ? $args['patient_rh'] : '';
            }

            if (isset($args['partner_group'])) {
                $laboratory->partner_group = $args['partner_group'] != '.' ? $args['partner_group'] : '';
            }

            if (isset($args['partner_rh'])) {
                $laboratory->partner_rh = $args['partner_rh'] != '.' ? $args['partner_rh'] : '';
            }

            $laboratory->save();            
        } else {
            // make user with data
            $laboratory = Laboratory::create([
                'record_id' => $args['record_id'],
                'patient_group' => isset($args['patient_group']) && $args['patient_group'] != '.' ?  $args['patient_group'] : null,
                'patient_rh' => isset($args['patient_rh']) && $args['patient_rh'] != '.' ?  $args['patient_rh'] : null,
                'partner_group' => isset($args['partner_group']) && $args['partner_group'] != '.' ?  $args['partner_group'] : null,
                'partner_rh' => isset($args['partner_rh']) && $args['partner_rh'] != '.' ?  $args['partner_rh'] : null,
            ]);
        }

        return $laboratory;
    }

}

