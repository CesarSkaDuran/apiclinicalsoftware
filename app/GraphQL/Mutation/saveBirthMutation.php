<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Birth;
use App\Record;

/**
 * CreateFileMutation
 */

class SaveBirthMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('birth');
    }

    public function args()
    {
        return [
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'time' => ['name' => 'time', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'type' => ['name' => 'type', 'type' => Type::string()],
            'episiotomy' => ['name' => 'episiotomy', 'type' => Type::string()],
            'alum' => ['name' => 'alum', 'type' => Type::string()],
            'blood_loss' => ['name' => 'blood_loss', 'type' => Type::string()],
            'oxytocic' => ['name' => 'oxytocic', 'type' => Type::string()],
            'anesthesia' => ['name' => 'anesthesia', 'type' => Type::string()],
            'sex' => ['name' => 'sex', 'type' => Type::string()],
            'weight' => ['name' => 'weight', 'type' => Type::string()],
            'height' => ['name' => 'height', 'type' => Type::string()],
            'size' => ['name' => 'size', 'type' => Type::string()],
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
        $birth = null;

        if (isset($args['id'])) {
            $birth = Birth::where('id', $args['id'])->first();
        } else {
            $birth = Birth::where('record_id', $args['record_id'])->first();
        }

        if ($birth) {
            if (isset($args['date'])) {
                $birth->date = $args['date'];
            }

            if (isset($args['type'])) {
                $birth->type = $args['type'] != '.' ? $args['type'] : '';
            }

            if (isset($args['time'])) {
                $birth->time = $args['time'] != '.' ? $args['time'] : '';
            }

            if (isset($args['episiotomy'])) {
                $birth->episiotomy = $args['episiotomy'] != '.' ? $args['episiotomy'] : '';
            }

            if (isset($args['alum'])) {
                $birth->alum = $args['alum'] != '.' ? $args['alum'] : '';
            }

            if (isset($args['blood_loss'])) {
                $birth->blood_loss = $args['blood_loss'] != '.' ? $args['blood_loss'] : '';
            }

            if (isset($args['oxytocic'])) {
                $birth->oxytocic = $args['oxytocic'] != '.' ? $args['oxytocic'] : '';
            }

            if (isset($args['anesthesia'])) {
                $birth->anesthesia = $args['anesthesia'] != '.' ? $args['anesthesia'] : '';
            }

            if (isset($args['sex'])) {
                $birth->sex = $args['sex'] != '.' ? $args['sex'] : '';
            }

            if (isset($args['weight'])) {
                $birth->weight = $args['weight'] != '.' ? $args['weight'] : '';
            }

            if (isset($args['height'])) {
                $birth->height = $args['height'] != '.' ? $args['height'] : '';
            }

            if (isset($args['size'])) {
                $birth->size = $args['size'] != '.' ? $args['size'] : '';
            }

            if (isset($args['observations'])) {
                $birth->observations = $args['observations'] != '.' ? $args['observations'] : '';
            }

            $birth->save();            
        } else {
            // make user with data
            $birth = Birth::create([
                'record_id' => $args['record_id'],
                'date' => $args['date'],
                'time' => isset($args['time']) && $args['time'] != '.' ?  $args['time'] : null,
                'type' => isset($args['type']) && $args['type'] != '.' ?  $args['type'] : null,
                'episiotomy' => isset($args['episiotomy']) && $args['episiotomy'] != '.' ?  $args['episiotomy'] : null,
                'alum' => isset($args['alum']) && $args['alum'] != '.' ?  $args['alum'] : null,
                'blood_loss' => isset($args['blood_loss']) && $args['blood_loss'] != '.' ?  $args['blood_loss'] : null,
                'oxytocic' => isset($args['oxytocic']) && $args['oxytocic'] != '.' ?  $args['oxytocic'] : null,
                'anesthesia' => isset($args['anesthesia']) && $args['anesthesia'] != '.' ?  $args['anesthesia'] : null,
                'sex' => isset($args['sex']) && $args['sex'] != '.' ?  $args['sex'] : null,
                'weight' => isset($args['weight']) && $args['weight'] != '.' ?  $args['weight'] : null,
                'height' => isset($args['height']) && $args['height'] != '.' ?  $args['height'] : null,
                'size' => isset($args['size']) && $args['size'] != '.' ?  $args['size'] : null,
                'observations' => isset($args['observations']) && $args['observations'] != '.' ?  $args['observations'] : null,
            ]);
        }

        return $birth;
    }

}

