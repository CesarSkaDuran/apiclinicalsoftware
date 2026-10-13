<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use HC\Histories\Doctor\Application\FindAllDoctors;
use HC\Histories\Doctor\Infrastructure\EloquentDoctorRepository;
use Illuminate\Http\Request;

class GetAllDoctorsController extends Controller
{
    public function getAll(Request $request)
    {
        $doctorsFinder = new FindAllDoctors(new EloquentDoctorRepository());
        $doctors = $doctorsFinder->execute();

        return response()->json(['doctors' => $doctors]);
    }
}
