<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\RecordDetail;
use App\Record;

/**
 * CreateFileMutation
 */

class SaveRecordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('record');
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'motive' => ['name' => 'motive', 'type' => Type::string()],
            'current_illness' => ['name' => 'current_illness', 'type' => Type::string()],
            'menarche' => ['name' => 'menarche', 'type' => Type::string()],
            'cycles' => ['name' => 'cycles', 'type' => Type::string()],
            'record_fur' => ['name' => 'record_fur', 'type' => Type::string()],
            'record_g' => ['name' => 'record_g', 'type' => Type::string()],
            'record_p' => ['name' => 'record_p', 'type' => Type::string()],
            'record_v' => ['name' => 'record_v', 'type' => Type::string()],
            'record_a' => ['name' => 'record_a', 'type' => Type::string()],
            'record_pp' => ['name' => 'record_pp', 'type' => Type::string()],
            'record_up' => ['name' => 'record_up', 'type' => Type::string()],
            'record_prs' => ['name' => 'record_prs', 'type' => Type::string()],
            'record_fpp' => ['name' => 'record_fpp', 'type' => Type::string()],
            'amenorrhea' => ['name' => 'amenorrhea', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'record_id' => ['required'],
            'motive' => ['required']
        ];
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();
        
        $record = Record::where('identification', $args['record_id'])->first();

        if (!$record) {
            abort(404, 'Record not found');
        }

        $recordDetail = $record->details;

        if ($recordDetail) {
            if (isset($args['motive'])) {
                $recordDetail->motive = $args['motive'];
            }

            if (isset($args['current_illness'])) {
                $recordDetail->current_illness = $args['current_illness'];
            }


            if (isset($args['menarche'])) {
                $recordDetail->menarche = $args['menarche'] != '.' ? $args['menarche'] : '';
            }

            if (isset($args['cycles'])) {
                $recordDetail->cycles = $args['cycles'] != '.' ? $args['cycles'] : '';
            }

            if (isset($args['record_fur'])) {
                $recordDetail->record_fur = $args['record_fur'] != '.' ? $args['record_fur'] : '';
            }

            if (isset($args['record_g'])) {
                $recordDetail->record_g = $args['record_g'] != '.' ? $args['record_g'] : '';
            }

            if (isset($args['record_p'])) {
                $recordDetail->record_p = $args['record_p'] != '.' ? $args['record_p'] : '';
            }

            if (isset($args['record_v'])) {
                $recordDetail->record_v = $args['record_v'] != '.' ? $args['record_v'] : '';
            }

            if (isset($args['record_a'])) {
                $recordDetail->record_a = $args['record_a'] != '.' ? $args['record_a'] : '';
            }

            if (isset($args['record_pp'])) {
                $recordDetail->record_pp = $args['record_pp'] != '.' ? $args['record_pp'] : '';
            }

            if (isset($args['record_up'])) {
                $recordDetail->record_up = $args['record_up'] != '.' ? $args['record_up'] : '';
            }

            if (isset($args['record_prs'])) {
                $recordDetail->record_prs = $args['record_prs'] != '.' ? $args['record_prs'] : '';
            }

            if (isset($args['record_fpp'])) {
                $recordDetail->record_fpp = $args['record_fpp'] != '.' ? $args['record_fpp'] : '';
            }

            if (isset($args['amenorrhea'])) {
                $recordDetail->amenorrhea = $args['amenorrhea'] != '.' ? $args['amenorrhea'] : '';
            }

            $recordDetail->save();            
        } else {
            // make user with data
            $recordDetail = RecordDetail::create([
                'record_id' => $record->identification,
                'motive' => $args['motive'],
                'current_illness' => $args['current_illness'],
                'menarche' => isset($args['menarche']) && $args['menarche'] != '.' ?  $args['menarche'] : null,
                'cycles' => isset($args['cycles']) && $args['cycles'] != '.' ?  $args['cycles'] : null,
                'record_fur' => isset($args['record_fur']) && $args['record_fur'] != '.' ?  $args['record_fur'] : null,
                'record_g' => isset($args['record_g']) && $args['record_g'] != '.' ?  $args['record_g'] : null,
                'record_p' => isset($args['record_p']) && $args['record_p'] != '.' ?  $args['record_p'] : null,
                'record_v' => isset($args['record_v']) && $args['record_v'] != '.' ?  $args['record_v'] : null,
                'record_a' => isset($args['record_a']) && $args['record_a'] != '.' ?  $args['record_a'] : null,
                'record_pp' => isset($args['record_pp']) && $args['record_pp'] != '.' ?  $args['record_pp'] : null,
                'record_up' => isset($args['record_up']) && $args['record_up'] != '.' ?  $args['record_up'] : null,
                'record_prs' => isset($args['record_prs']) && $args['record_prs'] != '.' ?  $args['record_prs'] : null,
                'record_fpp' => isset($args['record_fpp']) && $args['record_fpp'] != '.' ?  $args['record_fpp'] : null,
                'amenorrhea' => isset($args['amenorrhea']) && $args['amenorrhea'] != '.' ?  $args['amenorrhea'] : null
            ]);
        }

        return $record;
    }

}

