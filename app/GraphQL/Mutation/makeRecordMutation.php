<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Sinergi\BrowserDetector\Os;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Hash;
use App\Record;
use App\Patient;

/**
 * CreateFileMutation
 */

class makeRecordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update patient'
    ];

    public function type()
    {
        return GraphQL::type('record');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'identification' => ['name' => 'identification', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'id' => ['required'],
            'identification' => ['required']
        ];
    }

    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();

        if (isset($args['id'])) {
            $patient = Patient::where('id', $args['id'])->first();
        } else {
            // new user
            $patient = Patient::where('identification', $args['identification'])->first();
        }

        if (!$patient) {
            abort(404, 'Patient not found');
        }

        $record = Record::create([
            'user_id' => $currentUser->id,
            'patient_id' => $patient->identification,
            'identification' => $patient->identification . '-' . ($patient->records->count() + 1)
        ]);

        return $record;
    }
}

