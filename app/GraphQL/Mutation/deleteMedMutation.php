<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Med;



/**

 * CreateFileMutation

 */



class DeleteMedMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('med');
    }



    public function args()

    {

        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'details' => ['name' => 'details', 'type' => Type::string()],
            'frequency' => ['name' => 'frequency', 'type' => Type::string()],
            'amount' => ['name' => 'amount', 'type' => Type::string()],
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

            $income = Med::where('id', $args['id'])->first();
        } else {

            $income = null;
        }



        if ($income) {
            if (isset($args['delete'])) {
                Med::where('id', $args['id'])->delete();

                return $income;
            }

            if (isset($args['name'])) {
                $income->name = $args['name'] != '.' ? urldecode($args['name']) : '';
            }

            if (isset($args['details'])) {
                $income->details = $args['details'] != '.' ? urldecode($args['details']) : '';
            }
            if (isset($args['frequency'])) {
                $income->frequency = $args['frequency'] != '.' ? urldecode($args['frequency']) : '';
            }

            if (isset($args['amount'])) {
                $income->amount = $args['amount'] != '.' ? urldecode($args['amount']) : '';
            }



            $income->save();
        } else {
            // make user with data
            $income = Med::create([
                'user_id' => $currentUser->id,
                'name' => isset($args['name']) && $args['name'] != '.' ?  urldecode($args['name']) : null,
                'details' => isset($args['details']) && $args['details'] != '.' ?  urldecode($args['details']) : null,
                'frequency' => isset($args['frequency']) && $args['frequency'] != '.' ?  urldecode($args['frequency']) : null,
                'amount' => isset($args['amount']) && $args['amount'] != '.' ?  urldecode($args['amount']) : null,

            ]);
        }

        return $income;
    }
}
