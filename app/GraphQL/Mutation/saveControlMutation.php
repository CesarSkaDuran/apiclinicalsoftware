<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Control;
use App\Record;

/**
 * CreateFileMutation
 */

class SaveControlMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('control');
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'weight' => ['name' => 'weight', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'week' => ['name' => 'week', 'type' => Type::string()],
            'control_t' => ['name' => 'control_t', 'type' => Type::string()],
            'control_a' => ['name' => 'control_a', 'type' => Type::string()],
            'control_pam' => ['name' => 'control_pam', 'type' => Type::string()],
            'control_au' => ['name' => 'control_au', 'type' => Type::string()],
            'pression' => ['name' => 'pression', 'type' => Type::string()],
            'fcf' => ['name' => 'fcf', 'type' => Type::string()],
            'edema' => ['name' => 'edema', 'type' => Type::string()],
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
        if (isset($args['id'])) {
            $control = Control::where('id', $args['id'])->first();
        } else {
            $control = null;
        }

        if ($control) {
            if (isset($args['date'])) {
                $control->date = $args['date'];
            }

            if (isset($args['week'])) {
                $control->week = $args['week'] != '.' ? $args['week'] : '';
            }

            if (isset($args['weight'])) {
                $control->weight = $args['weight'] != '.' ? $args['weight'] : '';
            }

            if (isset($args['control_t'])) {
                $control->control_t = $args['control_t'] != '.' ? $args['control_t'] : '';
            }

            if (isset($args['control_a'])) {
                $control->control_a = $args['control_a'] != '.' ? $args['control_a'] : '';
            }

            if (isset($args['control_pam'])) {
                $control->control_pam = $args['control_pam'] != '.' ? $args['control_pam'] : '';
            }

            if (isset($args['control_au'])) {
                $control->control_au = $args['control_au'] != '.' ? $args['control_au'] : '';
            }

            if (isset($args['pression'])) {
                $control->pression = $args['pression'] != '.' ? $args['pression'] : '';
            }

            if (isset($args['fcf'])) {
                $control->fcf = $args['fcf'] != '.' ? $args['fcf'] : '';
            }

            if (isset($args['edema'])) {
                $control->edema = $args['edema'] != '.' ? $args['edema'] : '';
            }

            $control->save();            
        } else {
            // make user with data
            $control = Control::create([
                'record_id' => $args['record_id'],
                'date' => $args['date'],
                'weight' => isset($args['weight']) && $args['weight'] != '.' ?  $args['weight'] : null,
                'week' => isset($args['week']) && $args['week'] != '.' ?  $args['week'] : null,
                'control_t' => isset($args['control_t']) && $args['control_t'] != '.' ?  $args['control_t'] : null,
                'control_a' => isset($args['control_a']) && $args['control_a'] != '.' ?  $args['control_a'] : null,
                'control_pam' => isset($args['control_pam']) && $args['control_pam'] != '.' ?  $args['control_pam'] : null,
                'control_au' => isset($args['control_au']) && $args['control_au'] != '.' ?  $args['control_au'] : null,
                'pression' => isset($args['pression']) && $args['pression'] != '.' ?  $args['pression'] : null,
                'fcf' => isset($args['fcf']) && $args['fcf'] != '.' ?  $args['fcf'] : null,
                'edema' => isset($args['edema']) && $args['edema'] != '.' ?  $args['edema'] : null,
            ]);
        }

        return $control;
    }

}

