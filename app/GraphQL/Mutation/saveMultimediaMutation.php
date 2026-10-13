<?php



namespace App\GraphQL\Mutation;



use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;

use App\Multimedia;



/**

 * CreateFileMutation

 */



class SaveMultimediaMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('multimedia');

    }



    public function args()

    {

        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'description' => ['name' => 'description', 'type' => Type::string()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],
        ];

    }



    public function rules()

    {

        return [
            'id' => 'required'
        ];

    }



    public function resolve($root, $args)

    {
        $currentUser = auth('api')->user();        

        $multimedia = Multimedia::where('id', $args['id'])->first();

        if (!$multimedia) {
            abort(404, 'Multimedia not found');
        }

        if ($multimedia) {
            if (isset($args['delete'])) {
                Multimedia::where('id', $args['id'])->delete();

                return $multimedia;                
            }

            if (isset($args['description'])) {
                $multimedia->description = $args['description'] != '.' ? urldecode($args['description']) : '';
            }

            $multimedia->save();            

        }

        return $multimedia;

    }



}



