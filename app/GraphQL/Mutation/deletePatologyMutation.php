<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Patology;



/**

 * CreateFileMutation

 */



class DeletePatologyMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('patology');
    }



    public function args()

    {

        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'details' => ['name' => 'details', 'type' => Type::string()],
            'diag_date' => ['name' => 'diag_date', 'type' => Type::string()],
            'res_date' => ['name' => 'res_date', 'type' => Type::string()],
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

            $income = Patology::where('id', $args['id'])->first();
        } else {

            $income = null;
        }



        if ($income) {
            if (isset($args['delete'])) {
                Patology::where('id', $args['id'])->delete();

                return $income;
            }

            if (isset($args['name'])) {
                $income->name = $args['name'] != '.' ? urldecode($args['name']) : '';
            }

            if (isset($args['details'])) {
                $income->details = $args['details'] != '.' ? urldecode($args['details']) : '';
            }
            if (isset($args['diag_date'])) {
                $income->diag_date = $args['diag_date'] != '.' ? urldecode($args['diag_date']) : '';
            }

            if (isset($args['res_date'])) {
                $income->res_date = $args['res_date'] != '.' ? urldecode($args['res_date']) : '';
            }



            $income->save();
        } else {
            // make user with data
            $income = Patology::create([
                'user_id' => $currentUser->id,
                'name' => isset($args['name']) && $args['name'] != '.' ?  urldecode($args['name']) : null,
                'details' => isset($args['details']) && $args['details'] != '.' ?  urldecode($args['details']) : null,
                'diag_date' => isset($args['diag_date']) && $args['diag_date'] != '.' ?  urldecode($args['diag_date']) : null,
                'res_date' => isset($args['res_date']) && $args['res_date'] != '.' ?  urldecode($args['res_date']) : null,

            ]);
        }

        return $income;
    }
}
