<?php

namespace App\GraphQL\Mutation;

use App\CuentaCobro;
use App\DetalleCobro;
use App\Doctor;
use App\Patient;
use App\PlanTratamiento;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use App\ProcedimientoPaciente;
use App\Tercero;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * CreateFileMutation
 */

class ProcedimientoPacienteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'create or update record'
    ];

    public function type()
    {
        return GraphQL::type('procedimientoPaciente');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'delete' => ['name' => 'delete', 'type' => Type::int()],
            'record_id' => ['name' => 'record_id', 'type' => Type::string()],
            'patient_id' => ['name' => 'patient_id', 'type' => Type::string()],
            'categoria' => ['name' => 'categoria', 'type' => Type::string()],
            'procedimiento' => ['name' => 'procedimiento', 'type' => Type::string()],
            'valor' => ['name' => 'valor', 'type' => Type::int()],
            'cantidad' => ['name' => 'cantidad', 'type' => Type::string()],
            'suma_sesion' => ['name' => 'suma_sesion', 'type' => Type::int()],
            'valor_sesion' => ['name' => 'valor_sesion', 'type' => Type::int()],
            'pieza' => ['name' => 'pieza', 'type' => Type::string()],
            'date' => ['name' => 'date', 'type' => Type::string()],
            'obs' => ['name' => 'obs', 'type' => Type::string()],
            'otros' => ['name' => 'otros', 'type' => Type::string()],
            'tipo' => ['name' => 'tipo', 'type' => Type::int()],
            'tipo_pago' => ['name' => 'tipo_pago', 'type' => Type::int()],
            'status' => ['name' => 'status', 'type' => Type::int()],
        ];
    }

    public function rules()
    {
        return [];
    }

    public function resolve($root, $args)
    {

        $currentUser = auth('api')->user();

        $data = null;



        if (isset($args['id'])) {

            $data = ProcedimientoPaciente::where('id', $args['id'])->first();
        } else {

            $data = null;
        }



        if ($data) {

            if (isset($args['delete'])) {
                ProcedimientoPaciente::where('id', $args['id'])->delete();

                return $data;
            }
            if (isset($args['categoria'])) {
                $data->categoria = $args['categoria'] != '.' ? urldecode($args['categoria']) : '';
            }

          
            if (isset($args['procedimiento'])) {
                $data->procedimiento = $args['procedimiento'] != '.' ? urldecode($args['procedimiento']) : '';
            }

            if (isset($args['pieza'])) {
                $data->pieza = $args['pieza'] != '.' ? urldecode($args['pieza']) : '';
            }

            if (isset($args['obs'])) {
                $data->obs = $args['obs'] != '.' ? urldecode($args['obs']) : '';
            }
            if (isset($args['valor_sesion'])) {
                $data->valor_sesion = $args['valor_sesion'] != '.' ? urldecode($args['valor_sesion']) : '';
            }

            if (isset($args['suma_sesion'])) {
                $data->suma_sesion = $args['suma_sesion'] != '.' ? urldecode($args['suma_sesion']) : '';
            }

           
            if (isset($args['otros'])) {
                $data->otros = $args['otros'] != '.' ? urldecode($args['otros']) : '';
            }
            if (isset($args['status'])) {
                $data->status = $args['status'] != '.' ? urldecode($args['status']) : '';
            }
            if (isset($args['tipo_pago'])) {
                if ($args['tipo_pago'] == 1) {
                    if (isset($args['cantidad'])) {
                        $data->cantidad = $args['cantidad'] != '.' ? urldecode($args['cantidad']) : '';
                    }
                    if (isset($args['valor'])) {
                        $data->valor = $args['valor'] != '.' ? urldecode($args['valor']) : '';
                    }
                    $data->cantidad = 0;
                    
                }
                else {

                    if ($args['tipo_pago'] == 2) {

                        $data->abono += $args['valor'];

                        $data->save();

                        $procedimiento = ProcedimientoPaciente::where('id', $args['id'])->first();
                        
                        if ($procedimiento->abono == $procedimiento->valor) {

                            $data->tipo = 2;

                            $data->cantidad = 0;

                        }else if($procedimiento->abono >= $procedimiento->valor){

                            $data->tipo = 2;

                            $data->cantidad = 0;

                            }
                        }

                    }
                }
    
            $data->save();

        } else {

            if($args['tipo'] == 3) {

                $procedimiento = ProcedimientoPaciente::where('patient_id', $args['patient_id'])
                                                        ->where('tipo', 2)
                                                        ->whereDate('created_at', $args['date'])->get();

                $paciente = Patient::where('identification', $args['patient_id'])->first();
               
                $tercero = Tercero::where('documento', $args['patient_id'])->first();
                
                if (!$tercero) {
                    
                    $tercero =  new Tercero;
                    
                    $tercero->nombre = $paciente->name;
                    
                    $tercero->tipo_documento = 1;
                    
                    $tercero->documento = $paciente->identification;
                    
                    $tercero->direccion = $paciente->address;
                    
                    $tercero->telefono = $paciente->phone;
                    
                    $tercero->user_id = $currentUser->id;
                    
                    $tercero->save();
                
                }
                   
                $user =  Auth::user();
            
                $doctor = Doctor::where('user_id', $user->id)->first();

                $totalProcedimiento =  0;
                
                foreach ($procedimiento as $monto) {
                
                    $totalProcedimiento = $monto->valor  + $totalProcedimiento;
                
                }
    
                $income = new CuentaCobro;
    
                $income->user_id = $user->id;
    
                $income->nombre_empresa = $doctor->name;
    
                $income->nit_empresa = $doctor->phone;
    
                if($tercero){
                    
                    $income->tercero_id = $tercero->id;
                
                }
    
    
                // $income->id_empresa = $empresa->id;
    
                // $income->id_afiliacion = $empresa->afiliacion_id;
    
                $income->sucursal_id = 0;
    
                $income->valor = $totalProcedimiento;
    
                $income->nombre = 'Procedimiento varios';
    
                $income->obs = ' ';
    
                $income->iva = 0;
    
                $income->cuatroxmil = 0;
    
                $date = Carbon::now();
    
                $income->fecha = $date;
    
                $income->status = 2;
    
                $income->save();
       

                if ($procedimiento) {

                    foreach ($procedimiento as $key => $value) {

                        $cuenta = new  DetalleCobro;

                        $cuenta->cobro_id = $income->id;
                        
                        $cuenta->nombre = $value->procedimiento;
                        
                        $cuenta->valor = $value->valor;

                        $cuenta->save();
                    
                    }
                    
                } 
                
                return $data;
   
            }  else  {
            
                $data = ProcedimientoPaciente::create([
                    
                    'record_id' => $args['record_id'],
                    
                    'patient_id' => $args['patient_id'],
                    
                    'categoria' => isset($args['categoria']) && $args['categoria'] != '.' ?  urldecode($args['categoria']) : '',
                    
                    'valor' => isset($args['valor']) && $args['valor'] != '.' ?  urldecode($args['valor']) : '',
                    
                    'procedimiento' => isset($args['procedimiento']) && $args['procedimiento'] != '.' ?  urldecode($args['procedimiento']) : '',
                    
                    'pieza' => isset($args['pieza']) && $args['pieza'] != '.' ?  $args['pieza'] : '',
                    
                    'obs' => isset($args['obs']) && $args['obs'] != '.' ?  urldecode($args['obs']) : '',
                    
                    'tipo' => isset($args['tipo']) && $args['tipo'] != '.' ?  urldecode($args['tipo']) : '',
                    
                    'valor_sesion' => isset($args['valor_sesion']) && $args['valor_sesion'] != '.' ?  urldecode($args['valor_sesion']) : '',
                    
                    'cantidad' => isset($args['cantidad']) && $args['cantidad'] != '.' ?  urldecode($args['cantidad']) : '',
                    
                    'sesiones' => isset($args['cantidad']) && $args['cantidad'] != '.' ?  urldecode($args['cantidad']) : '',
                    
                    'otros' => isset($args['otros']) && $args['otros'] != '.' ?  urldecode($args['otros']) : '',
                
                ]); 
                    
                return $data;
             
            }
        
        }

    }

}
