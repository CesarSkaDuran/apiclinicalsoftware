<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Shared\Auth\BaseAuthController;
use HC\Histories\AppPatient\Application\AppPatientCreator;
use HC\Histories\AppPatient\Application\CreateNewAppPatient;
use HC\Histories\AppPatient\Infrastructure\EloquentAppPatientRepository;
use HC\Histories\User\Application\CreateNewUser;
use HC\Histories\User\Domain\UserAlreadyExist;
use HC\Histories\User\Infrastructure\EloquentUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterAppUserController extends BaseAuthController
{
    private int $APP_USER_ROLE_ID = 0;
    private int $APP_USER_TYPE = 3;

    public function register(Request $request)
    {
        $data = $request->all();

        $data['role_id'] = $this->APP_USER_ROLE_ID;
        $data['user_type'] = $this->APP_USER_TYPE;

        try {
            $newUserCreator = new CreateNewUser(new EloquentUserRepository());
            $newAppPatientCreator = new CreateNewAppPatient(new EloquentAppPatientRepository());

            $newUserId = $newUserCreator->execute($data);

            $data['user_id'] = $newUserId;

            $newAppPatientCreator->execute($data);

            Mail::send('mail.mail-send', $request->all(), function ($msj) use ($request) {
                $msj->subject('Bienvenido a ClinicalSoftware');
                $msj->to($request['email']);
            });
            
        } catch (UserAlreadyExist $exception) {
            return response()->json(['error' => $exception->getMessage()], 409);
        }

        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
