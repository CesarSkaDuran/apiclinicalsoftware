<?php



namespace App\GraphQL\Mutation;

use App\CuentaCobro;
use App\DetalleCobro;
use App\Doctor;
use App\Empresa;
use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use Sinergi\BrowserDetector\Os;

use Torann\GeoIP\Facades\GeoIP;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Income;
use App\Propect;
use App\Temporal;
use Illuminate\Support\Facades\Auth;

/**

 * CreateFileMutation

 */



class SaveIncomeMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or update record'

    ];



    public function type()

    {

        return GraphQL::type('cuentaCobro');
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

            'cuatroxmil' => ['name' => 'cuatroxmil', 'type' => Type::int()],

            'sucursal_id' => ['name' => 'sucursal_id', 'type' => Type::int()],

            'activar' => ['name' => 'activar', 'type' => Type::int()],

            'deleteAll' => ['name' => 'deleteAll', 'type' => Type::int()],
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

            $income = CuentaCobro::where('id', $args['id'])->first();
        } else {

            $income = null;
        }


        if (isset($args['delete'])) {

            $cuenta = CuentaCobro::where('id', $args['id'])->first();

            DetalleCobro::where('cobro_id', $cuenta->id)->delete();

            CuentaCobro::where('id', $args['id'])->delete();

            return $income;
        }

        if ($income) {

           
           
        } else {
            // make user with data

            $temporal = Temporal::where('id_empresa', $args['id_empresa'])->first();

            $income = new CuentaCobro;

            $user = Auth::user();

            $doctor = Doctor::where('user_id', $user->id)->first();

            $income = new CuentaCobro;

            $income->user_id = $user->id;

            $income->nombre_empresa = $doctor->name;

            $income->nit_empresa = $doctor->phone;

            $income->tercero_id = $temporal->id_empresa;

            // $income->id_empresa = $empresa->id;

            // $income->id_afiliacion = $empresa->afiliacion_id;

            $income->sucursal_id = isset($args['sucursal_id']) && $args['sucursal_id'] != '.' ?  $args['sucursal_id'] : null;

            $income->valor = isset($args['valor']) && $args['valor'] != '.' ?  $args['valor'] : null;

            $income->nombre = isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null;

            $income->obs = isset($args['obs']) && $args['obs'] != '.' ?  $args['obs'] : null;

            $income->iva = isset($args['iva']) && $args['iva'] != '.' ?  $args['iva'] : null;

            $income->cuatroxmil = isset($args['cuatroxmil']) && $args['cuatroxmil'] != '.' ?  $args['cuatroxmil'] : null;

            $date = Carbon::now();

            $income->fecha = $date;

            $income->status = 2;

            $income->save();

            $temporal = Temporal::where('id_empresa', $args['id_empresa'])->get();

            if ($temporal) {

                foreach ($temporal as $key => $value) {

                    $cuenta = new  DetalleCobro;

                    $cuenta->nombre = $value->nombre;

                    $cuenta->valor = $value->valor;

                    $cuenta->cobro_id = $income->id;

                    $cuenta->save();
                }

                Temporal::truncate();
            } else {

                $cuenta = new  DetalleCobro();

                $cuenta->nombre = isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null;

                $cuenta->valor = isset($args['valor']) && $args['valor'] != '.' ?  $args['valor'] : null;

                $cuenta->cobro_id = $income->id;

                $cuenta->save();
            }
        }

        return $income;
    }
}
