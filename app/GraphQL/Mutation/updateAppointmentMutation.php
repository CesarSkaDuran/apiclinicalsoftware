<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use App\Appointment;
use App\AppPatient;



/**

 * CreateFileMutation

 */



class UpdateAppointmentMutation extends Mutation

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

            'payment_type' => ['name' => 'payment_type', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()],

        ];
    }



    public function rules()

    {

        return [

            'id' => ['required'],

        ];
    }



    public function resolve($root, $args)
    {
        $currentUser = auth('api')->user();
        $appUser = AppPatient::where('user_id', $currentUser->id)->first();

        $appointment = Appointment::where('id', $args['id'])->first();

        if (!$appointment) {
            abort(404, 'Appointment not found');
        }

        if ($appointment->app_user_id != $appUser->id) {
            abort(403, 'Unauthorized');
        }

        if (isset($args['payment_type'])) {
            $appointment->payment_type = $args['payment_type'];
        }

        if (isset($args['status'])) {
            $appointment->status = $args['status'];
        }

        $appointment->save();

        return $appointment;
    }
}
