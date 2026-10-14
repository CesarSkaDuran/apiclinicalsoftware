<?php

namespace App\Console\Commands;

use App\Doctor;
use App\NotificationLog;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBirthdayNotifications extends Command
{
    protected $signature = 'notifications:birthday {--date=} {--dry-run} {--patient=}';

    protected $description = 'Send a birthday greeting email to patients whose birthday is today';

    public function handle()
    {
        $date = $this->option('date')
            ? Carbon::parse($this->option('date'), 'America/Bogota')
            : Carbon::now('America/Bogota');

        $reference = $date->toDateString();
        $dryRun = (bool) $this->option('dry-run');

        $patientId = $this->option('patient');

        $patients = Patient::whereNotNull('birth_date')
            ->where('birth_date', '!=', '')
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->whereMonth('birth_date', $date->month)
            ->whereDay('birth_date', $date->day)
            ->when($patientId, function ($query) use ($patientId) {
                return $query->where('id', $patientId);
            })
            ->get();

        $sent = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($patients as $patient) {
            $alreadySent = NotificationLog::where('type', 'birthday')
                ->where('channel', 'email')
                ->where('patient_id', $patient->id)
                ->where('reference', $reference)
                ->where('status', 'sent')
                ->exists();

            if ($alreadySent) {
                $skipped++;
                continue;
            }

            if ($dryRun) {
                $this->line("[dry-run] {$patient->id} {$patient->name} <{$patient->email}>");
                $sent++;
                continue;
            }

            try {
                $doctor = Doctor::where('user_id', $patient->user_id)->first();

                Mail::send('mail.birthday', [
                    'name' => $patient->name,
                    'doctorName' => $doctor ? $doctor->name : '',
                    'doctorPhoto' => $doctor ? $doctor->avatar_url : '',
                ], function ($msj) use ($patient, $doctor) {
                    $from = $doctor && $doctor->name ? 'Equipo de ' . $doctor->name : 'Clinical Software';
                    $msj->subject('Feliz cumpleaños de parte de ' . $from);
                    $msj->to($patient->email, $patient->name);
                });

                NotificationLog::create([
                    'type' => 'birthday',
                    'channel' => 'email',
                    'patient_id' => $patient->id,
                    'reference' => $reference,
                    'recipient' => $patient->email,
                    'status' => 'sent',
                ]);
                $sent++;
            } catch (\Throwable $exception) {
                NotificationLog::create([
                    'type' => 'birthday',
                    'channel' => 'email',
                    'patient_id' => $patient->id,
                    'reference' => $reference,
                    'recipient' => $patient->email,
                    'status' => 'failed',
                    'detail' => $exception->getMessage(),
                ]);
                $failed++;
            }
        }

        $this->info("Birthday notifications for {$reference}: {$sent} sent, {$skipped} skipped, {$failed} failed.");
    }
}
