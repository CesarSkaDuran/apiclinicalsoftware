<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\RecordDiagnoses;

/**

 * CreateFileMutation

 */

class saveRecordDiagnosesMutation  extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];

    public function type()



    {

        return GraphQL::type('recordDiagnoses');
    }

    public function args()

    {


        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'diagnoses_id' => ['name' => 'diagnoses_id', 'type' => Type::int()],

            'delete' => ['name' => 'delete', 'type' => Type::int()],

        ];
    }



    public function rules()

    {



        return [];
    }

    public function resolve($root, $args)

    {

        $currentUser = auth('api')->user();

        if (isset($args['delete']) && isset($args['id'])) {
            $deleted = RecordDiagnoses::where('id', $args['id'])->delete();
            return $deleted;
        }


        if (isset($args['id'])) {



            $recordDiagnoses = RecordDiagnoses::where('id', $args['id'])->first();
        } else {



            $recordDiagnoses = null;
        }

        if ($recordDiagnoses) {

            if (isset($args['record_id'])) {
                $recordDiagnoses->record_id = $args['record_id'];
            }

            if (isset($args['diagnoses_id'])) {
                $recordDiagnoses->Diagnoses_id = $args['diagnoses_id'];
            }



            $recordDiagnoses->save();
        } else {

            // make user with data

            $recordDiagnoses = RecordDiagnoses::create([
                'record_id' => $args['record_id'],
                'diagnoses_id' => $args['diagnoses_id'],

            ]);
        }

        return $recordDiagnoses;
    }
}
