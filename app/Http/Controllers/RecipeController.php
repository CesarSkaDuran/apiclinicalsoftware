<?php

namespace App\Http\Controllers;

use App\Evolution;
use App\FirmaConsentimiento;
use App\Patient;
use Illuminate\Http\Request;

use App\Record;
use App\RecordMedicine;
use Illuminate\Support\Carbon;

class RecipeController extends Controller
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
            'order' => $conclusion == null ? '' : $conclusion->authorization_number,
            'date' => $record->created_at,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'ips' => $patient->eps,
            'fechaNacimiento' => $patient->birth_date,
            //  'medicine'=> $medicines->medicine_id,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            'motive' => $details->motive,
            'diagnostic' => $conclusion->diagnosis,
            'diagnostic_code' => $conclusion->diagnostic,
            'treatment' => $conclusion->behavior,
            'exams' => $conclusion->tests,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            'details' => $doctor->details,
            'img_url' => $doctor->image,
            'medicines' => $meds->toArray(),
            'procedures' => $proc->toArray(),
            'diagnoses' => $diag->toArray(),
            //  'diagnostic_2' => $diag->toArray(),
            'enfermedadActual' => $details->current_illness,
            'campoExtra' => $doctor->campo_extra,
        ];

        return view('recipe', compact('data'));
    }

    public function evolution(Request $request, $recordId, $id)
    {
        if (!$recordId) {
            abort(404);
        }

        $record = Record::where('identification', $recordId)->first();
        $evolution = Evolution::where('record_id', $recordId)->where('id', $id)->first();
        //$medicines = RecordMedicine::where('record_id', $recordId )->first();

        if (!$record) {
            abort(404, 'Record not found');
        }

        $patient = $record->patient;
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
            'date' => $record->created_at,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'ips' => $patient->eps,
            'fechaNacimiento' => $patient->birth_date,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            'details' => $doctor->details,
            'img_url' => $doctor->image,
            'id' => $evolution->id,
            'firma' => $evolution == null ? '' : $evolution->firma,
            'campoExtra' => $doctor->campo_extra,
            'firma_doctor' => $doctor->firma,
            'personal_medico' => $evolution->process,
            'fecha_evolucion' => $evolution->date,
            'comentario' => $evolution->details,
            'firma_medico' => $evolution->firma_medico,

        ];

        return view('evolution', compact('data'));
    }

    public function evolutionList(Request $request, $recordId)
    {
        if (!$recordId) {
            abort(404);
        }

        $record = Record::where('identification', $recordId)->first();
        $evolution = Evolution::where('record_id', $recordId)->get();
        //$medicines = RecordMedicine::where('record_id', $recordId )->first();

        if (!$record) {
            abort(404, 'Record not found');
        }

        $patient = $record->patient;
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
            'date' => $record->created_at,
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'ips' => $patient->eps,
            'fechaNacimiento' => $patient->birth_date,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            'details' => $doctor->details,
            'img_url' => $doctor->image,
            // 'id' => $evolution->id,
            // 'firma' => $evolution == null ? '' : $evolution->firma,
            'campoExtra' => $doctor->campo_extra,
            'firma_doctor' => $doctor->firma,
            
            // 'personal_medico' => $evolution->process,
            // 'fecha_evolucion' => $evolution->date,
            // 'comentario' => $evolution->details,

        ];

        return view('evolutionList', compact('data', 'evolution' ));
    }
    public function guardar(Request $request)
    {
        if($request->firma == 1){
         
            $persona =  Evolution::where('id', $request->data_id)->where('record_id', $request->record_id)->first();
            $persona->firma = $request->contenedorV7;
            $persona->save();
            
        }
        if ($request->firma == 2) {

            $persona =  Evolution::where('id', $request->data_id)->where('record_id', $request->record_id)->first();
            $persona->firma_medico = $request->contenedorV7;
            $persona->save();
            
        }
        // if ($request->firma == 3) {

        //     $persona =  Evolution::where('id', $request->data_id)->where('record_id', $request->record_id)->first();
        //     $persona->firma_medico = $request->contenedorV7;
        //     $persona->save();
        // }


        return redirect()->back();
    }
    public function firma(Request $request)
    {
         
        $persona =  Patient::where('identification', $request->data_id)->first();
        $persona->firma = $request->contenedorV7;
        $persona->save();


        return redirect()->back();
    }
    public function firmaId(Request $request)
    {

        
        $persona = new  FirmaConsentimiento;
        $persona->firma = $request->contenedorV7;
        $persona->record_id = $request->data_id;
        $persona->nombre = $request->nombre;

            $persona->consentimiento_id = $request->consentimiento_id;

        $persona->save();


        return redirect()->back();
    }
}
