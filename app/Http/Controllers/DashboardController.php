<?php

namespace App\Http\Controllers;

use App\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $statusNames = [1 => 'scheduled', 2 => 'pending', 3 => 'completed', 4 => 'cancelled'];

    public function summary(Request $request)
    {
        $today = Carbon::now('America/Bogota');
        $month = $request->input('month')
            ? Carbon::createFromFormat('Y-m', $request->input('month'), 'America/Bogota')
            : $today->copy();

        $start = $month->copy()->startOfMonth();
        $end = $month->copy()->endOfMonth();

        $appointments = Appointment::where('user_id', Auth::id())
            ->where('date', '>=', $start->toDateString())
            ->where('date', '<', $end->copy()->addDay()->toDateString())
            ->get(['date', 'status']);

        $byDay = array_fill(1, $end->day, 0);
        $status = array_fill_keys(array_values($this->statusNames), 0);

        foreach ($appointments as $appointment) {
            $byDay[Carbon::parse($appointment->date)->day]++;

            if (isset($this->statusNames[$appointment->status])) {
                $status[$this->statusNames[$appointment->status]]++;
            }
        }

        return response()->json([
            'month' => $start->format('Y-m'),
            'today' => $today->toDateString(),
            'today_count' => Appointment::where('user_id', Auth::id())
                ->where('date', $today->toDateString())
                ->count(),
            'status' => $status + ['total' => $appointments->count()],
            'by_day' => array_values($byDay),
        ]);
    }
}
