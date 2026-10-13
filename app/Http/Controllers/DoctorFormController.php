<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DoctorForm;

class DoctorFormController extends Controller
{
    public function create(Request $request)
    {
        DoctorForm::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'specialization' => $request->get('specialization'),
        ]);

        return response()->json(['success' => true]);
    }
}