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



class DeleteAppointmentMutation extends Mutation

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
            'value' => ['name' => 'value', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'time' => ['name' => 'time', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::int()],
            'type' => ['name' => 'type', 'type' => Type::int()],
            'time' => ['name' => 'time', 'type' => Type::string()],
            'email_confirmation' => ['name' => 'email_confirmation', 'type' => Type::string()],
            'phone_confirmation' => ['name' => 'phone_confirmation', 'type' => Type::string()],
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

            $income = Appointment::where('id', $args['id'])->first();
        } else {

            $income = null;
        }



        if ($income) {
            if (isset($args['delete'])) {
                Appointment::where('id', $args['id'])->delete();

                return $income;
            }

            if (isset($args['name'])) {
                $income->name = $args['name'] != '.' ? urldecode($args['name']) : '';
            }

            if (isset($args['company'])) {
                $income->company = $args['company'] != '.' ? urldecode($args['company']) : '';
            }
            if (isset($args['value'])) {
                $income->value = $args['value'] != '.' ? urldecode($args['value']) : '';
            }

            if (isset($args['date'])) {
                $income->date = $args['date'] != '.' ? urldecode($args['date']) : '';
            }
            if (isset($args['time'])) {
                $income->time = $args['time'] != '.' ? urldecode($args['time']) : '';
            }
            if (isset($args['status'])) {
                $income->status = $args['status'] != '.' ? urldecode($args['status']) : '';
            }
            if (isset($args['type'])) {
                $income->type = $args['type'] != '.' ? urldecode($args['type']) : '';
            }
            if (isset($args['email_confirmation'])) {
                $income->email_confirmation = $args['email_confirmation'] != '.' ? urldecode($args['email_confirmation']) : '';
            }
            if (isset($args['phone_confirmation'])) {
                $income->phone_confirmation = $args['phone_confirmation'] != '.' ? urldecode($args['phone_confirmation']) : '';
            }
            if (isset($args['reason'])) {
                $income->reason = $args['reason'] != '.' ? urldecode($args['reason']) : '';
            }


            $income->save();
        } else {
            // make user with data
            $income = Appointment::create([
                'user_id' => $currentUser->id,
                'name' => isset($args['name']) && $args['name'] != '.' ?  urldecode($args['name']) : null,
                'company' => isset($args['company']) && $args['company'] != '.' ?  urldecode($args['company']) : null,
                'value' => isset($args['value']) && $args['value'] != '.' ?  urldecode($args['value']) : null,
                'date' => isset($args['date']) && $args['date'] != '.' ?  urldecode($args['date']) : null,
                'time' => isset($args['time']) && $args['time'] != '.' ?  urldecode($args['time']) : null,
                'status' => isset($args['status']) && $args['status'] != '.' ?  urldecode($args['status']) : null,
                'type' => isset($args['type']) && $args['type'] != '.' ?  urldecode($args['type']) : null,
                'email_confirmation' => isset($args['email_confirmation']) && $args['email_confirmation'] != '.' ?  urldecode($args['email_confirmation']) : null,
                'phone_confirmation' => isset($args['phone_confirmation']) && $args['phone_confirmation'] != '.' ?  urldecode($args['phone_confirmation']) : null,
                'reason' => isset($args['reason']) && $args['reason'] != '.' ?  urldecode($args['reason']) : null,
            ]);
        }

        return $income;
    }
}
