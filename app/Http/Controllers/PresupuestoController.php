<?php

namespace App\Http\Controllers;

use App\CuentaCobro;
use App\Deducciones;
use App\DetalleCobro;
use App\DetalleGasto;
use App\DetalleNomina;
use App\DetalleServicio;
use App\Doctor;
use App\Empleado;
use App\Empresa;
use App\Gasto;
use App\HoraExtra;
use App\Nomina;
use App\Persona;
use App\Tercero;
use App\User;
use App\ProcedimientoPaciente;
use App\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    public function generate(Request $request, $recordId)
    {
        if (!$recordId) {
            abort(404);
        }

        $tratamiento = ProcedimientoPaciente::where('record_id', $recordId)->where('tipo', 1)->get();

        $record = Record::where('identification', $recordId)->first();


        if (!$record) {
            abort(404, 'Record not found');
        }

        $patient = $record->patient;
        $plan = $record->planTratamiento;
        $doctor = $record->user->doctor;

        $totalComision =  0;
        foreach ($tratamiento as $monto) {
            $totalComision = $monto->valor  + $totalComision;
        }

        //  $medicines = $record->record_medicines->medicines;
        $edad = Carbon::parse($patient->birth_date)->age;
        // 1990-10-25
        $data = [
            'doctor_name' => $doctor->name,
            'nit' => '',
            'specialization' => $doctor->specialization,
            'university' => $doctor->university,
            'record' => $record->identification,
            // 'date' => date('Y-m-d'),
            'date' => date("d/m/Y", strtotime($plan == null ? '' : $plan->created_at)),
            // 'fechaGenerada' =>$record->created_at,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'idTratamiento' => $plan == null ? '' : $plan->id,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'ips' => $patient->eps,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            'img_url' => $doctor->image,
            'fechaNacimiento' => $patient->birth_date,

            'campoExtra' => $doctor->campo_extra,
        ];

        return view('presupuesto', compact('data', 'tratamiento', 'totalComision'));
    }
    public function post(Request $request, $recordId)
    {
        if (!$recordId) {
            abort(404);
        }

        $tratamiento = ProcedimientoPaciente::where('record_id', $recordId)->where('tipo', 1)->get();

        $record = Record::where('identification', $recordId)->first();


        if (!$record) {
            abort(404, 'Record not found');
        }

        $patient = $record->patient;
        $plan = $record->planTratamiento;
        $doctor = $record->user->doctor;

        $totalComision =  0;
        foreach ($tratamiento as $monto) {
            $totalComision = $monto->valor  + $totalComision;
        }

        //  $medicines = $record->record_medicines->medicines;
        $edad = Carbon::parse($patient->birth_date)->age;
        // 1990-10-25
        $data = [
            'doctor_name' => $doctor->name,
            'nit' => '',
            'specialization' => $doctor->specialization,
            'university' => $doctor->university,
            'record' => $record->identification,
            // 'date' => date('Y-m-d'),
            'date' => date("d/m/Y", strtotime($plan == null ? '' : $plan->created_at)),
            // 'fechaGenerada' =>$record->created_at,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'idTratamiento' => $plan == null ? '' : $plan->id,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'ips' => $patient->eps,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            'img_url' => $doctor->image,
            'fechaNacimiento' => $patient->birth_date,

            'campoExtra' => $doctor->campo_extra,
        ];

        return view('factura', compact('data', 'tratamiento', 'totalComision'));
    }

    public function cobro(Request $request, $recordId)
    {
        // if (!$recordId) {
        //     abort(404);
        // }

        $cuenta = CuentaCobro::where('id', $recordId)->first();
        $servicio = DetalleCobro::where('cobro_id', $cuenta->id)->where('valor', '>', 1)->orderBy('id', 'asc')
            ->get();


        $record = Doctor::where('user_id', $cuenta->user_id)->first();
        $tercero = Tercero::where('id', $cuenta->tercero_id)->first();

        if (!$record) {
        }

        $totalComision =  0;
        foreach ($servicio as $monto) {
            $valorNeto = $monto->valor  == 1 ? 0 : $monto->valor;
            $totalComision = $monto->valor +  $totalComision;
        }
        $cuatroXmil = $cuenta->cuatroxmil == 1 ? $totalComision / 1000 * 4 : 0;
        $data = [
            'doctor_name' => $record->name,
            'specialization' => $record->specialization,
            'experience' => $record->experience,
            'message' => $record->message,
            'address' => $record->address,
            'dphone' => $record->phone,
            'details' => $record->details,
            'img_url' => $record->image,
            'campoExtra' => $record->campo_extra,
            'firma_doctor' => $record->firma,
            'iva' => $cuenta->iva,
            'obs' => $cuenta->obs,

            'afiliacion' => $record->id,
            'date' => date('Y-m-d'),

            'telMovil' => $record->phone,
            'name' => $tercero->nombre,
            'documento' => $tercero->documento,
            'direccion' => $tercero->direccion,
            'telefono' => $tercero->telefono,
            'dv' => ''


        ];

        return view('pagoDetalle', compact('data', 'cuenta', 'cuatroXmil', 'servicio', 'totalComision'));
    }

    public function cobroPost(Request $request, $recordId)
    {
        // if (!$recordId) {
        //     abort(404);
        // }

        $cuenta = CuentaCobro::where('id', $recordId)->first();
        $servicio = DetalleCobro::where('cobro_id', $cuenta->id)->where('valor', '>', 1)->orderBy('id', 'asc')
        ->get();


        $record = Doctor::where('user_id', $cuenta->user_id)->first();
        $tercero = Tercero::where('id', $cuenta->tercero_id)->first();

        if (!$record) {
        }

        $totalComision =  0;
        foreach ($servicio as $monto) {
            $valorNeto = $monto->valor  == 1 ? 0 : $monto->valor;
            $totalComision = $monto->valor +  $totalComision;
        }
        $cuatroXmil = $cuenta->cuatroxmil == 1 ? $totalComision / 1000 * 4 : 0;
        $data = [
            'doctor_name' => $record->name,
            'specialization' => $record->specialization,
            'experience' => $record->experience,
            'message' => $record->message,
            'address' => $record->address,
            'dphone' => $record->phone,
            'details' => $record->details,
            'img_url' => $record->image,
            'campoExtra' => $record->campo_extra,
            'firma_doctor' => $record->firma,
            'iva' => $cuenta->iva,
            'obs' => $cuenta->obs,

            'afiliacion' => $record->id,
            'date' => date('Y-m-d'),

            'telMovil' => $record->phone,
            'name' => $tercero->nombre,
            'documento' => $tercero->documento,
            'direccion' => $tercero->direccion,
            'telefono' => $tercero->telefono,
            'dv' => ''


        ];

        return view('factura', compact('data', 'cuenta', 'cuatroXmil', 'servicio', 'totalComision'));
    }


    public function gasto(Request $request, $recordId)
    {
        // if (!$recordId) {
        //     abort(404);
        // }

        $cuenta = Gasto::where('id', $recordId)->first();
        $servicio = DetalleGasto::where('gasto_id', $cuenta->id)->where('valor', '>', 1)->orderBy('id', 'asc')
            ->get();


        $record = Doctor::where('user_id', $cuenta->user_id)->first();
        $tercero = Tercero::where('id', $cuenta->tercero_id)->first();



        $totalComision =  0;
        foreach ($servicio as $monto) {
            $valorNeto = $monto->valor  == 1 ? 0 : $monto->valor;
            $totalComision = $monto->valor +  $totalComision;
        }

        $data = [
            'iva' => $cuenta->iva,
            'obs' => $cuenta->obs,

            'afiliacion' => $record->id,
            'date' => date('Y-m-d'),
            'doctor_name' => $record->name,
            'specialization' => $record->specialization,
            'experience' => $record->experience,
            'message' => $record->message,
            'address' => $record->address,
            'dphone' => $record->phone,
            'details' => $record->details,
            'img_url' => $record->image,
            'campoExtra' => $record->campo_extra,
            'firma_doctor' => $record->firma,
            'telMovil' => $record->phone,
            'name' => $tercero->nombre,
            'documento' => $tercero->documento,
            'direccion' => $tercero->direccion,
            'telefono' => $tercero->telefono,
            'dv' => ''

        ];

        return view('gasto', compact('data', 'cuenta', 'servicio', 'totalComision'));
    }
}
