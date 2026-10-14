<?php

namespace App\Http\Controllers;

use App\NotificationLog;
use App\Patient;
use App\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function runDaily()
    {
        Artisan::call('notifications:birthday');

        return response()->json([
            'date' => Carbon::now('America/Bogota')->toDateString(),
            'output' => trim(Artisan::output()),
        ]);
    }

    public function birthdaysToday()
    {
        $today = Carbon::now('America/Bogota');

        $patients = Patient::whereNotNull('birth_date')
            ->whereMonth('birth_date', $today->month)
            ->whereDay('birth_date', $today->day)
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhereIn('identification', Record::select('patient_id')->where('user_id', Auth::id()));
            })
            ->orderBy('name')
            ->get(['id', 'identification', 'name', 'email', 'phone', 'birth_date']);

        $logs = NotificationLog::where('type', 'birthday')
            ->where('channel', 'email')
            ->where('reference', $today->toDateString())
            ->whereIn('patient_id', $patients->pluck('id'))
            ->orderBy('id')
            ->get()
            ->keyBy('patient_id');

        return response()->json($patients->map(function ($patient) use ($logs, $today) {
            return [
                'id' => $patient->id,
                'identification' => $patient->identification,
                'record_identification' => Record::where('patient_id', $patient->identification)
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->value('identification'),
                'name' => $patient->name,
                'phone' => $patient->phone,
                'email' => $patient->email,
                'age' => $today->year - Carbon::parse($patient->birth_date)->year,
                'status' => $logs->has($patient->id) ? $logs[$patient->id]->status : (empty($patient->email) ? 'no_email' : 'pending'),
            ];
        })->values());
    }

    public function sendBirthday($patientId)
    {
        $patient = Patient::find($patientId);

        $ownsPatient = $patient && (
            $patient->user_id == Auth::id()
            || Record::where('patient_id', $patient->identification)
                ->where('user_id', Auth::id())
                ->exists()
        );

        if (!$ownsPatient) {
            return response()->json(['message' => 'Paciente no encontrado.'], 404);
        }

        Artisan::call('notifications:birthday', ['--patient' => $patient->id]);

        return response()->json(['output' => trim(Artisan::output())]);
    }
}
