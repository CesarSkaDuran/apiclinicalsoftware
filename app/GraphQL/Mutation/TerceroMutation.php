<?php



namespace App\GraphQL\Mutation;

use App\Asentado;
use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use App\Income;
use App\PlanCuenta;
use App\Propect;
use App\Tercero;
use App\TipoComprobante;

/**

 * CreateFileMutation

 */



class TerceroMutation extends Mutation

{

    protected $attributes = [

        'name' => 'create or upemail record'

    ];



    public function type()

    {

        return GraphQL::type('tercero');
    }



    public function args()

    {

        return [
           
            'id' => ['name' => 'id', 'type' => Type::int()],
            
            // 'tipo_terceros' => ['name' => 'tipo_terceros', 'type' => Type::int()],
            
            'tipo_naturaleza' => ['name' => 'tipo_naturaleza', 'type' => Type::int()],
            
            'regimen' => ['name' => 'regimen', 'type' => Type::int()],
            
            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            
            'apellido' => ['name' => 'apellido', 'type' => Type::string()],
            
            'email' => ['name' => 'email', 'type' => Type::string()],
            
            'tipo_documento' => ['name' => 'tipo_documento', 'type' => Type::int()],
            
            'documento' => ['name' => 'documento', 'type' => Type::string()],
            
            'dv' => ['name' => 'dv', 'type' => Type::string()],
            
            'ciudad' => ['name' => 'ciudad', 'type' => Type::string()],
            
            'direccion' => ['name' => 'direccion', 'type' => Type::string()],
            
            'telefono' => ['name' => 'telefono', 'type' => Type::string()],
            
            // 'fecha_nacimiento' => ['name' => 'fecha_nacimiento', 'type' => Type::string()],
            
            // 'cupo' => ['name' => 'cupo', 'type' => Type::string()],
            
            // 'ruta' => ['name' => 'ruta', 'type' => Type::string()],
            
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

            $income = Tercero::where('id', $args['id'])->first();
        } else {

            $income = null;
        }


        if (isset($args['delete'])) {
        

                Tercero::where('id', $args['id'])->delete();
            
            // if ($asentado){
            //     error_log('El tercero tiene cuentas asociadas');
            // }

            return $income;
        }

        if ($income) {

            // if (isset($args['tipo_terceros'])) {
            //     $income->tipo_terceros = $args['tipo_terceros'] != '.' ? urldecode($args['tipo_terceros']) : '';
            // }

            if (isset($args['tipo_naturaleza'])) {
                $income->tipo_naturaleza = $args['tipo_naturaleza'] != '.' ? urldecode($args['tipo_naturaleza']) : '';
            }

            if (isset($args['regimen'])) {
                $income->regimen = $args['regimen'] != '.' ? urldecode($args['regimen']) : '';
            }

            if (isset($args['email'])) {
                $income->email = $args['email'] != '.' ? urldecode($args['email']) : '';
            }
            if (isset($args['nombre'])) {
                $income->nombre = $args['nombre'] != '.' ? strtoupper($args['nombre']) : '';
            }

            if (isset($args['apellido'])) {
                $income->apellido = $args['apellido'] != '.' ? strtoupper($args['apellido']) : '';
            }

            if (isset($args['tipo_documento'])) {
                $income->tipo_documento = $args['tipo_documento'] != '.' ? urldecode($args['tipo_documento']) : '';
            }

            if (isset($args['documento'])) {
                $income->documento = $args['documento'] != '.' ? strtoupper($args['documento']) : '';
            }

            if (isset($args['dv'])) {
                $income->dv = $args['dv'] != '.' ? urldecode($args['dv']) : '';
            }

            if (isset($args['ciudad'])) {
                $income->ciudad = $args['ciudad'] != '.' ? strtoupper($args['ciudad']) : '';
            }

            if (isset($args['direccion'])) {
                $income->direccion = $args['direccion'] != '.' ? strtoupper($args['direccion']) : '';
            }
            if (isset($args['telefono'])) {
                $income->telefono = $args['telefono'] != '.' ? strtoupper($args['telefono']) : '';
            }

            // if (isset($args['fecha_nacimiento'])) {
            //     $income->fecha_nacimiento = $args['fecha_nacimiento'] != '.' ? urldecode($args['fecha_nacimiento']) : '';
            // }

            // if (isset($args['cupo'])) {
            //     $income->cupo = $args['cupo'] != '.' ? urldecode($args['cupo']) : '';
            // }

            // if (isset($args['ruta'])) {
            //     $income->ruta = $args['ruta'] != '.' ? urldecode($args['ruta']) : '';
            // }

            $income->save();
        } else {
            // make user with data
            // $tipo = $args['tipo_terceros'];

        

            $income = Tercero::create([
                
                'user_id' => $currentUser->id,

                // 'codigo'=> $codigo,

                // 'tipo_terceros' => isset($args['tipo_terceros']) && $args['tipo_terceros'] != '.' ?  urldecode($args['tipo_terceros']) : null,
                
                'tipo_naturaleza' => isset($args['tipo_naturaleza']) && $args['tipo_naturaleza'] != '.' ?  urldecode($args['tipo_naturaleza']) : null,
                
                'regimen' => isset($args['regimen']) && $args['regimen'] != '.' ?  $args['regimen'] : null,
                
                'nombre' => isset($args['nombre']) && $args['nombre'] != '.' ?  strtoupper($args['nombre']) : null,
                
                'apellido' => isset($args['apellido']) && $args['apellido'] != '.' ?  strtoupper($args['apellido']) : null,
                
                'tipo_documento' => isset($args['tipo_documento']) && $args['tipo_documento'] != '.' ?  $args['tipo_documento'] : null,
                
                'email' => isset($args['email']) && $args['email'] != '.' ?  $args['email'] : null,
                
                'documento' => isset($args['documento']) && $args['documento'] != '.' ?  strtoupper($args['documento']) : null,
                
                'dv' => isset($args['dv']) && $args['dv'] != '.' ?  urldecode($args['dv']) : null,
                
                'ciudad' => isset($args['ciudad']) && $args['ciudad'] != '.' ?  strtoupper($args['ciudad']) : null,
                
                'direccion' => isset($args['direccion']) && $args['direccion'] != '.' ?  strtoupper($args['direccion']) : null,
                
                'telefono' => isset($args['telefono']) && $args['telefono'] != '.' ?  strtoupper($args['telefono']) : null,
                
                // 'fecha_nacimiento' => isset($args['fecha_nacimiento']) && $args['fecha_nacimiento'] != '.' ?  $args['fecha_nacimiento'] : null,
                
                // 'cupo' => isset($args['cupo']) && $args['cupo'] != '.' ?  $args['cupo'] : null,
                
                // 'ruta' => isset($args['ruta']) && $args['ruta'] != '.' ?  $args['ruta'] : null,
            ]);
        }

        return $income;
    }
}
