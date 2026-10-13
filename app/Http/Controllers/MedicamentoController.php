<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use Illuminate\Support\Carbon;
class MedicamentoController extends Controller
{
    public function generate(Request $request, $recordId)
    {
        if (!$recordId) {
            abort(404);
        }

        $record = Record::where('identification', $recordId)->first();
        //$medicines = RecordMedicine::where('record_id', $recordId )->first();

        if (!$record) {
            abort(404, 'Record not found');
        }

        $patient = $record->patient;
        $conclusion = $record->conclusion;
        $details = $record->details;
        $doctor = $record->user->doctor;
        $meds = $record->medicines->load('medicine');
        $proc = $record->procedures->load('procedure');
        $diag = $record->diagnoses->load('diagnose');
        //  $medicines = $record->record_medicines->medicines;
        $edad = Carbon::parse($patient->birth_date)->age;
        // 1990-10-25
        $data = [
            'doctor_name' => $doctor->name,
            'nit' => '',
            'specialization' => $doctor->specialization,
            'university' => $doctor->university,
            'record' => $record->identification,
            'order' => $conclusion->authorization_number,
            // 'date' => date('Y-m-d'),
            'date' => $record->created_at,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'ips' => '',
            //  'medicine'=> $medicines->medicine_id,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            // 'motive' => $details->motive,
            // 'diagnostic' => $conclusion->diagnosis,
            // 'diagnostic_code' => $conclusion->diagnostic,
            // 'treatment' => $conclusion->behavior,
            'exams' => $conclusion->tests,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            // 'details' => $doctor->details,
            'img_url' => $doctor->image,
            'medicines' => $meds->toArray(),
            // 'procedures' => $proc->toArray(),
            // 'diagnoses' => $diag->toArray(),
            //  'diagnostic_2' => $diag->toArray(),
            // 'enfermedadActual' => $details->current_illness,
            // 'enfermedadActual' => $conclusion->current_illness,
            'campoExtra' => $doctor->campo_extra,
        ];

        return view('medicamento', compact('data'));
    }
}
