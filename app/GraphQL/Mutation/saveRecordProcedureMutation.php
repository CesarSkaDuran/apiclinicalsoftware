<?php

namespace App\GraphQL\Mutation;

use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\RecordProcedure;

/**

 * CreateFileMutation

 */

class saveRecordProcedureMutation  extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];

    public function type()



    {

        return GraphQL::type('recordProcedure');
    }

    public function args()

    {


        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'procedure_id' => ['name' => 'procedure_id', 'type' => Type::int()],

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
            $deleted = RecordProcedure::where('id', $args['id'])->delete();
            return $deleted;
        }


        if (isset($args['id'])) {



            $recordProcedure = RecordProcedure::where('id', $args['id'])->first();
        } else {



            $recordProcedure = null;
        }

        if ($recordProcedure) {

            if (isset($args['record_id'])) {
                $recordProcedure->record_id = $args['record_id'];
            }

            if (isset($args['procedure_id'])) {
                $recordProcedure->procedure_id = $args['procedure_id'];
            }

         

            $recordProcedure->save();
        } else {

            // make user with data

            $recordProcedure = RecordProcedure::create([
                'record_id' => $args['record_id'],
                'procedure_id' => $args['procedure_id'],
               
            ]);
        }

        return $recordProcedure;
    }
}
