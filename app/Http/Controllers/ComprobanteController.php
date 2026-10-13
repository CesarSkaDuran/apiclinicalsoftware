<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppPatient;
use App\Multimedia;
class ComprobanteController extends Controller
{
    // public function patientProfile(Request $request)

    // {

    //     $currentUser = auth('api')->user();

    //     $patient = Patient::where('id', $request->get('patient_id'))->first();



    //     if (!$patient) {

    //         abort(404, 'patient not found');
    //     }



    //     if ($request->hasFile('image')) {

    //         $image = $request->file('image');

    //         $name = $this->generateRandomString() . '.jpg';

    //         $image->move(public_path() . '/img/profiles/', $name);

    //         $patient->profile_url = 'http://localhost:8000/img/profiles/' . $name;

    //         $patient->save();
    //     }



    //     return response()->json(['patient' => $patient])->header('Access-Control-Allow-Origin', '*');
    // }


    public function comprobanteMultimedia(Request $request)
    {
        // dd($request->all());
        // var_dump($request->all());

        $currentUser = auth('api')->user();

        $appUser = AppPatient::where('user_id', $currentUser->id)->first();



        if (!$appUser) {

            abort(404, 'record not found');
        }



        if ($request->hasFile('file')) {

            $image = $request->file('file');

            $name = $this->generateRandomString() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . '/img/multim/', $name);

            $url = 'https://hcapi.clinicalsoftware.org/img/multim/' . $name;

            $multimedia = Multimedia::create([
                'record_id' => $appUser->user_id,
                'name' => $name,
                'description' => '',
                'url' => $url,
                'type' => $image->getClientOriginalExtension() == 'mp4' || $image->getClientOriginalExtension() == 'avi' ? 2 : 1,
            ]);
        }



        return response()->json(['appUser' => $appUser])
            ->header('Access-Control-Allow-Origin',
                '*'
            );
    }



    private function generateRandomString($length = 10)
    {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';



        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }



        return $randomString;
    }
}
