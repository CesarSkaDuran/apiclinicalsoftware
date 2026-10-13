<?php

namespace App\Http\Controllers;

use App\DrRemision;
use App\ProcedimientoPaciente;
use Illuminate\Http\Request;
use App\Record;
use Carbon\Carbon;
class RemisionController extends Controller
{
    public function generate(Request $request, $recordId, $id_medico, $presupuesto_id)
    {
        if (!$recordId) {
            abort(404);
        }

        $procedimiento = ProcedimientoPaciente::where('id', $presupuesto_id)->first();

        $remision = DrRemision::where('id', $id_medico)->first();

        $record = Record::where('identification', $recordId)->first();


        if (!$record) {
            abort(404, 'Record not found');
        }

        $patient = $record->patient;
        $plan = $record->planTratamiento;
        $doctor = $record->user->doctor;


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
            'date' => $record->created_at,
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
            'drNnombre'=> $remision->nombre,
            'drEspecializacion'=>$remision->especializacion,
            'drDireccion'=>$remision->direccion,
            'drTelefono'=>$remision->telefono,
            'procedimiento'=> $procedimiento->procedimiento,
        ];

        return view('remision', compact('data'));
    }
}
