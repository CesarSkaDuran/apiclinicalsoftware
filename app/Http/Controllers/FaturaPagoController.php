<?php

namespace App\Http\Controllers;

use App\PlanTratamiento;
use App\ProcedimientoPaciente;
use App\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FaturaPagoController extends Controller
{
    public function generate(Request $request, $recordId, $date)
    {
        if (!$recordId) {
            abort(404);
        }

        $tratamiento = ProcedimientoPaciente::where('record_id', $recordId)->whereDate('created_at', $date)->where('tipo', 2)->get();

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
            'date' => $record->created_at,
            'fechaGenerada'=>$date,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'idTratamiento'=>$plan == null ? '' : $plan->id,
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

        return view('facturaPago', compact('data', 'tratamiento', 'totalComision'));
    }
}
