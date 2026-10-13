<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Consentimiento;

use App\Record;



/**

 * CreateFileMutation

 */



class ConsentimientoMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('consentimiento');

    }



    public function args()

    {

        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'user_id' => ['name' => 'user_id', 'type' => Type::string()],

            'doctor_id' => ['name' => 'doctor_id', 'type' => Type::int()],

            'nombre' => ['name' => 'nombre', 'type' => Type::string()],

            'obs' => ['name' => 'obs', 'type' => Type::string()],

        ];

    }



    public function rules()

    {

        return [

            // 'user_id' => ['required'],

        ];

    }



    public function resolve($root, $args)

    {

        $currentUser = auth('api')->user();

        if (isset($args['delete'])) {
            $evolution = Consentimiento::where('id', $args['id'])->delete();

            return $evolution;
        }        


        if (isset($args['id'])) {
            $evolution = Consentimiento::where('id', $args['id'])->first();
        } else {
            $evolution = null;
        }



        if ($evolution) {

            // if (isset($args['date'])) {

            //     $evolution->date = $args['date'] != '.' ? $args['date'] : '';

            // }

            if (isset($args['doctor_id'])) {
                $evolution->doctor_id = $args['doctor_id'] !== '.' ? ($args['doctor_id']) : 0;
            }

            if (isset($args['nombre'])) {
                $evolution->nombre = $args['nombre'] !== '.' ? ($args['nombre']) : 0;

            }

            if (isset($args['obs'])) {

                $evolution->obs = $args['obs'] != '.' ? ($args['obs']) : 0;
            }


            $evolution->save();            

        } else {

            // make user with data

            $currentUser = auth('api')->user();
            
            $evolution = Consentimiento::create([
                
                'user_id' => $currentUser->id,
                // 'date' => date('Y-m-d'),

                // 'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,
                
                'doctor_id' => isset($args['doctor_id']) && $args['doctor_id'] != '.' ? ($args['doctor_id']) : 0,
                
                'nombre' => isset($args['nombre']) && $args['nombre'] != '.' ? ($args['nombre']) : 0,
                
                // 'details' => isset($args['details']) && $args['details'] != '.' ?  urldecode($args['details']) : null,
                
                'obs' => isset($args['obs']) && $args['obs'] != '.' ?  ($args['obs']) : 0,

            ]);

        }



        return $evolution;

    }
}

