<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Appointment;



/**

 * CreateFileMutation

 */



class SaveAppointmentMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('appointment');

    }



    public function args()

    {

        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'company' => ['name' => 'company', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'value' => ['name' => 'value', 'type' => Type::string()],
            'time' => ['name' => 'time', 'type' => Type::string()],
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

        if (isset($args['id'])) {

            $appointment = Appointment::where('id', $args['id'])->first();

        } else {

            $appointment = null;

        }



        if ($appointment) {
            if (isset($args['delete'])) {
                Appointment::where('id', $args['id'])->delete();

                return $appointment;                
            }

            if (isset($args['name'])) {
                $appointment->name = $args['name'] != '.' ? urldecode($args['name']) : '';
            }

            if (isset($args['company'])) {
                $appointment->company = $args['company'] != '.' ? urldecode($args['company']) : '';
            }

            if (isset($args['value'])) {
                $appointment->value = $args['value'] != '.' ? $args['value'] : '';
            }

            if (isset($args['date'])) {
                $appointment->date = $args['date'] != '.' ? $args['date'] : '';
            }

            if (isset($args['time'])) {
                $appointment->time = $args['time'] != '.' ? $args['time'] : '';
            }

            $appointment->save();            

        } else {
            // make user with data
            $appointment = Appointment::create([
                'user_id' => $currentUser->id,
                'name' => isset($args['name']) && $args['name'] != '.' ? $args['name'] : null,
                'company' => isset($args['company']) && $args['company'] != '.' ? $args['company'] : null,
                'date' => isset($args['date']) && $args['date'] != '.' ? $args['date'] : null,
                'value' => isset($args['value']) && $args['value'] != '.' ? $args['value'] : null,
                'time' => isset($args['time']) && $args['time'] != '.' ? $args['time'] : null,
            ]);
        }

        return $appointment;

    }

}



