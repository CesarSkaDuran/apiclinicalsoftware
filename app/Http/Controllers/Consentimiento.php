<?php

namespace App\Http\Controllers;

use App\ConsentimientoPaciente;
use App\DrRemision;
use App\FirmaConsentimiento;
use App\Patient;
use App\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class Consentimiento extends Controller
{
    public function generate(Request $request, $recordId, $id)
    {
        // if (!$recordId) {
        //     abort(404);
        // }

        $record = Record::where('identification', $recordId)->first();

        $paciente = Patient::where('identification', $record->identification)->first();
        
        $consentimiento = ConsentimientoPaciente::where('id', $id)->first();
        
        $firma = FirmaConsentimiento::where('consentimiento_id', $consentimiento->id)->first();
        
        $medico = DrRemision::where('id', $consentimiento->doctor_id)->first();
        
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
            'id'=>$record->id,
            'order' => $conclusion == null ? '' : $conclusion->authorization_number,
            'date' => date('Y-m-d'),
            'dia' => date('d'),
            'mes' => date('m'),
            'anio' => date('Y'),
            'document' => $patient->identification,
            'name' => $patient->name,
            'gender' => $patient->sex,
            'age' => $edad,
            'city' => $patient->address,
            'email' => $patient->email,
            'firma' => $firma == null ? '' : $firma->firma,
            'ips' => $patient->eps,
            'fechaNacimiento' => $patient->birth_date,
            //  'medicine'=> $medicines->medicine_id,
            'message' => $doctor->message,
            'phone' => $patient->phone,
            'address' => $doctor->address,
            'dphone' => $doctor->phone,
            'details' => $doctor->details,
            'img_url' => $doctor->image,
            'medicines' => $meds->toArray(),
            'procedures' => $proc->toArray(),
            'diagnoses' => $diag->toArray(),
            // 'firma' => $evolution == null ? '' : $evolution->firma,
            'firma_doctor' => $medico->firma == null ? $doctor->firma : $medico->firma,
            //  'diagnostic_2' => $diag->toArray(),
            'campoExtra' => $doctor->campo_extra,
        ];


        return view('drcharris.consentimiento',compact('data', 'consentimiento', 'medico', 'paciente'));
    }

    public function correo(Request $request)
    
    {
        
        Mail::send('mail.mail-send-server', $request->all(), function ($msj) use ($request) {
            $msj->subject('Bienvenido a ClinicalSoftware');
            $msj->to($request['email']);
        });

        
        return redirect()->back();
   
    }
}
