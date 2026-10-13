<?php

namespace App\GraphQL\Mutation;

use App\Afiliacion;
use App\Banco;
use App\CuentaCobro;
use App\DetalleCobro;
use App\DetalleServicio;
use App\Doctor;
use App\DrRemision;
use App\Empleado;
use App\Empresa;
use App\Notificaciones;
use GraphQL;

use GraphQL\Type\Definition\Type;

use Folklore\GraphQL\Support\Mutation;

use App\Sucursal;
use App\Temporal;
use App\Tercero;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**

 * CreateFileMutation

 */



class CuentaCobroMutation extends Mutation

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

            'banco_id' => ['name' => 'banco_id', 'type' => Type::int()],
            
            'valor' => ['name' => 'valor', 'type' => Type::int()],

            'iva' => ['name' => 'iva', 'type' => Type::int()],

            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            
            'status' => ['name' => 'id_empresa', 'type' => Type::int()],
            
            'delete' => ['name' => 'delete', 'type' => Type::int()],

            'sucursal_id' => ['name' => 'sucursal_id', 'type' => Type::int()],

            'doctor' => ['name' => 'doctor', 'type' => Type::int()],
            
            'dataHoy' => ['name' => 'dataHoy', 'type' => Type::string()],
        ];

    }

    public function rules()

    {

        return [];

    }

    public function resolve($root, $args)

    {
        $income = null;
        
        $idE = null;

        if (isset($args['delete'])) {

            // $empleados = Empleado::where('user_id', $args['user_id'])->get();
            
            // if($empleados){
            //     foreach ($empleados as $registro) {
            //         $idE[] = $registro->id;
            //     }
                
            //     $eliminados = Empleado::destroy($idE);
            // }
            
            
        }
        if (isset($args['id'])) {

            $income = CuentaCobro::where('id', $args['id'])->first();
            $date = Carbon::now();
            // $income->created_at = $date->startOfMonth();
            if(isset($args['doctor'])){
                
                $doctor = DrRemision::where('id', $args['doctor'])->first();

                $income->nombre_empresa = $doctor->nombre;

                $income->nit_empresa = $doctor->telefono;
            
            }
        
            // $income->updated_at = $date->addMonth()->startOfMonth();
            $income->status = 1;

            $banco = Banco::where('id',$args['banco_id'])->first();
            $banco->monto_actual = $banco->monto_actual + $income->valor;
            $banco->save();
            $income->banco = $banco->nombre;
        } else {

            $income = null;
        }

        if ($income) {

            if (isset($args['status'])) {

                $income->status = $args['status'] != '.' ? $args['status'] : '';
            }


        $income->save();
        
        } else {

            $user = Auth::user();

            $doctor = Doctor::where('user_id', $user->id)->first();

            $income = new CuentaCobro;
                
            $income->id_empresa = isset($args['id_empresa']) && $args['id_empresa'] != '.' ?  urldecode($args['id_empresa']) : null;
  
            $income->user_id= $user->id;

            $income->sucursal_id = isset($args['sucursal_id']) && $args['sucursal_id'] != '.' ?  $args['sucursal_id'] : null;


         
            $income->nombre_empresa = $doctor->name;

            $income->nit_empresa = $doctor->phone;
            

            // if (isset($args['user_id'])) {

            //     $empresa = Empresa::where('afiliacion_id', $args['user_id'])->first();

            //     $income->nombre_empresa = $empresa->razon_social;

            //     $income->nit_empresa = $empresa->numDocumento;
            // }
             $income->valor= isset($args['valor']) && $args['valor'] != '.' ?  $args['valor'] : null;

             $income->nombre= isset($args['nombre']) && $args['nombre'] != '.' ?  $args['nombre'] : null;

             $income->iva = isset($args['iva']) && $args['iva'] != '.' ?  $args['iva'] : null;

             $date = Carbon::now();

            //  $income->fecha = $date->addMonth()->startOfMonth();
    
             $income->fecha = $date;

             $income->status= 2;

             $income->save();
                  
           

             $temporal = Temporal::where('id_empresa', $args['id_empresa'])->get();

            if ($temporal) {

                foreach ($temporal as $key => $value) {

                    $cuenta = new  DetalleCobro;

                    $cuenta->nombre = $value->nombre;

                    $cuenta->valor = $value->valor * $value->cantidad;

                    $cuenta->cobro_id = $income->id;

                    $cuenta->save();
                }
            }

            
            // Notificaciones::create([

            //     'id_empresa' => $data->id,
            //     'nombre' => $data->primer_nombre . ' ' . $data->primer_apellido,
            //     // 'salario' => $args['salario_base'] ?? null,
            //     'tipo' => 17,
            //     'status' => 2
            // ]);
        }

        if (isset($args['delete'])) {

            CuentaCobro::where('id', $args['id'])->delete();

            DetalleCobro::where('cuenta_id',$args['id'])->delete();

        }

        return $income;

    }
}