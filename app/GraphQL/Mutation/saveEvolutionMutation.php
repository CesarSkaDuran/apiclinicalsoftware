<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Evolution;

use App\Record;



/**

 * CreateFileMutation

 */



class SaveEvolutionMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('evolution');

    }



    public function args()

    {

        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'rejuv' => ['name' => 'rejuv', 'type' => Type::string()],

            'mona' => ['name' => 'mona', 'type' => Type::string()],

            'tests' => ['name' => 'tests', 'type' => Type::string()],

            'behavior' => ['name' => 'behavior', 'type' => Type::string()],

            'process' => ['name' => 'process', 'type' => Type::string()],

            'date' => ['name' => 'date', 'type' => Type::string()],

            'delete' => ['name' => 'delete', 'type' => Type::int()],

            'details' => ['name' => 'details', 'type' => Type::string()],

        ];

    }



    public function rules()

    {

        return [

            // 'record_id' => ['required'],

        ];

    }



    public function resolve($root, $args)

    {

        $currentUser = auth('api')->user();

        if (isset($args['delete'])) {
            $evolution = Evolution::where('id', $args['id'])->delete();

            return $evolution;
        }        
// if(isset($args['record_id'])){

//     $record = Record::where('identification', $args['record_id'])->first();
// }



//         if (!$record) {

//             abort(404, 'Record not found');

//         }


        if (isset($args['id'])) {
            $evolution = Evolution::where('id', $args['id'])->first();
        } else {
            $evolution = null;
        }



        if ($evolution) {

            if (isset($args['date'])) {

                $evolution->date = $args['date'] != '.' ? $args['date'] : '';

            }

            if (isset($args['rejuv'])) {
                $evolution->rejuv = $args['rejuv'] !== '.' ? ($args['rejuv'] == 'true' ? 1 : 0) : 0;
            }

            if (isset($args['mona'])) {
                $evolution->mona = $args['mona'] !== '.' ? ($args['mona'] == 'true' ? 1 : 0) : 0;

            }

            if (isset($args['tests'])) {

                $evolution->tests = $args['tests'] != '.' ? ($args['tests'] == 'true' ? 1 : 0) : 0;
            }


            if (isset($args['behavior'])) {

                $evolution->behavior = $args['behavior'] != '.' ? ($args['behavior'] =='true' ? 1 : 0) : 0;
            }



            if (isset($args['process'])) {

                $evolution->process = $args['process'] != '.' ? $args['process'] : '';
            }


            if (isset($args['details'])) {

                $evolution->details = $args['details'] != '.' ? urldecode($args['details']) : '';

            }

            $evolution->save();            

        } else {

            // make user with data

            $evolution = Evolution::create([
                // 'record_id' => $record->identification,
                'record_id' => $args['record_id'],

                // 'date' => date('Y-m-d'),

                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                'rejuv' => isset($args['rejuv']) && $args['rejuv'] != '.' ? ($args['rejuv'] == 'true' ? 1 : 0) : 0,
                'mona' => isset($args['mona']) && $args['mona'] != '.' ? ($args['mona'] == 'true' ? 1 : 0) : 0,
                'details' => isset($args['details']) && $args['details'] != '.' ?  urldecode($args['details']) : null,
                'tests' => isset($args['tests']) && $args['tests'] != '.' ?  ($args['tests'] == 'true' ? 1 : 0) : 0,

                'behavior' => isset($args['behavior']) && $args['behavior'] != '.' ?   ($args['behavior'] == 'true' ? 1 : 0) : 0,

                'process' => isset($args['process']) && $args['process'] != '.' ?  $args['process'] : null,
            ]);

        }



        return $evolution;

    }



}



