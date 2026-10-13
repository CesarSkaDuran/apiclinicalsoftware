<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Consentimiento;
use App\ConsentimientoPaciente;
use App\DrRemision;
use App\Record;



/**

 * CreateFileMutation

 */



class ConsentimientoPacienteMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('consentimientoPaciente');
    }



    public function args()

    {

        return [

            'id' => ['name' => 'id', 'type' => Type::int()],

            'record_id' => ['name' => 'record_id', 'type' => Type::string()],

            'doctor_id' => ['name' => 'doctor_id', 'type' => Type::int()],

            'nombre' => ['name' => 'nombre', 'type' => Type::string()],

            'date' => ['name' => 'date', 'type' => Type::string()],

            'obs' => ['name' => 'obs', 'type' => Type::string()],

            'delete' => ['name' => 'delete', 'type' => Type::int()],
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
            $evolution = ConsentimientoPaciente::where('id', $args['id'])->delete();

            return $evolution;
        }


        if (isset($args['id'])) {
            $evolution = ConsentimientoPaciente::where('id', $args['id'])->first();
        } else {
            $evolution = null;
        }



        if ($evolution) {

            if (isset($args['date'])) {

                $evolution->date = $args['date'] != '.' ? $args['date'] : '';

            }

            if (isset($args['doctor_id'])) {
                $evolution->doctor_id = $args['doctor_id'] !== '.' ? $args['doctor_id'] : 0;
            }

            if (isset($args['nombre'])) {
                $evolution->nombre = $args['nombre'] !== '.' ? $args['nombre'] : 0;
            }

            if (isset($args['obs'])) {

                $evolution->obs = $args['obs'] != '.' ? $args['obs']  : 0;
            }


            $evolution->save();
        } else {

            // make user with data
            // $doctor = DrRemision::where('id', $args['doctor_id'])->first();
            $consentimiento = Consentimiento::where('id', $args['nombre'])->first();
            
            $evolution = ConsentimientoPaciente::create([
                // 'user_id' => $record->identification,
                'record_id' => $args['record_id'],

                'doctor_id' =>  $args['doctor_id'],

                'date' => isset($args['date']) && $args['date'] != '.' ?  $args['date'] : null,

                'doctor_id' => $args['doctor_id'],

                'nombre' =>  $consentimiento->nombre,

                // 'details' => isset($args['details']) && $args['details'] != '.' ?  urldecode($args['details']) : null,

                'obs' =>  nl2br($args['obs']),

            ]);
        }



        return $evolution;
    }
}
