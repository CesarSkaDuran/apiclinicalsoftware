<?php



namespace App\GraphQL\Mutation;

use App\CuentaCobro;
use App\DetalleCobro;
use App\DetalleGasto;
use App\Empresa;
use App\Gasto;
use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Income;
use App\Propect;

/**

 * CreateFileMutation

 */



class GastoMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('gasto');
    }



    public function args()

    {

        return [
            'id' => ['name' => 'id', 'type' => Type::int()],

            'id_empresa' => ['name' => 'id_empresa', 'type' => Type::int()],

            'id_afiliacion' => ['name' => 'id_afiliacion', 'type' => Type::int()],

            'valor' => ['name' => 'valor', 'type' => Type::int()],

            'iva' => ['name' => 'iva', 'type' => Type::int()],

            'nombre' => ['name' => 'nombre', 'type' => Type::string()],

            'obs' => ['name' => 'obs', 'type' => Type::string()],

            'status' => ['name' => 'id_empresa', 'type' => Type::int()],

            'delete' => ['name' => 'delete', 'type' => Type::int()],

            'sucursal_id' => ['name' => 'sucursal_id', 'type' => Type::int()],
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

            $income = Propect::where('id', $args['id'])->first();
        } else {

            $income = null;
        }



        if ($income) {
            if (isset($args['delete'])) {
                Propect::where('id', $args['id'])->delete();

                return $income;
            }

            // if (isset($args['name'])) {
            //     $income->name = $args['name'] != '.' ? urldecode($args['name']) : '';
            // }

            // if (isset($args['last_name'])) {
            //     $income->last_name = $args['last_name'] != '.' ? urldecode($args['last_name']) : '';
            // }

            // if (isset($args['phone'])) {
            //     $income->phone = $args['phone'] != '.' ? urldecode($args['phone']) : '';
            // }

            // if (isset($args['date'])) {
            //     $income->date = $args['date'] != '.' ? urldecode($args['date']) : '';
            // }
            // if (isset($args['course'])) {
            //     $income->course = $args['course'] != '.' ? urldecode($args['course']) : '';
            // }

            // if (isset($args['country'])) {
            //     $income->country = $args['country'] != '.' ? urldecode($args['country']) : '';
            // }

            // if (isset($args['age'])) {
            //     $income->age = $args['age'] != '.' ? urldecode($args['age']) : '';
            // }

            $income->save();
        } else {
            // make user with data

            // $empresa = Empresa::where('id', $args['id_empresa'])->first();

            $income = new Gasto;

            $income->tercero_id = $args['id_empresa'];

            $income->user_id = $currentUser->id;

            // $income->id_empresa = $empresa->id;

            // $income->id_afiliacion = $empresa->afiliacion_id;

            $income->sucursal_id = isset($args['sucursal_id']) && $args['sucursal_id'] != '.' ?  $args['sucursal_id'] : null;

            $income->valor = isset($args['valor']) && $args['valor'] != '.' ?  $args['valor'] : null;

            $income->nombre = isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null;

            $income->obs = isset($args['obs']) && $args['obs'] != '.' ?  $args['obs'] : null;

            $income->iva = isset($args['iva']) && $args['iva'] != '.' ?  $args['iva'] : null;

            $date = Carbon::now();

            $income->fecha = $date;

            $income->status = 2;

            $income->save();

            $cuenta = new  DetalleGasto;

            $cuenta->nombre = isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null;

            $cuenta->valor = isset($args['valor']) && $args['valor'] != '.' ?  $args['valor'] : null;

            $cuenta->gasto_id = $income->id;

            $cuenta->save();
        }

        return $income;
    }
}
