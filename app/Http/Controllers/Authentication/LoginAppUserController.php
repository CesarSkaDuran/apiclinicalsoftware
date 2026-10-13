<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Shared\Auth\BaseAuthController;
use HC\Histories\AppPatient\Application\AppPatientFinderByUser;
use HC\Histories\AppPatient\Infrastructure\EloquentAppPatientRepository;
use HC\Histories\User\Application\UserFinderByEmail;
use HC\Histories\User\Infrastructure\EloquentUserRepository;
use Illuminate\Http\Request;

class LoginAppUserController extends BaseAuthController
{
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 400);
        }

        $userFinder = new UserFinderByEmail(new EloquentUserRepository());
        $appPatientFinder = new AppPatientFinderByUser(new EloquentAppPatientRepository());

        $user = $userFinder->execute($request->get('email'));

        $userData = [
            'id' => $user->id(),
            'name' => $user->name(),
            'email' => $user->email(),
            'chat_id' => $user->chat_id()
        ];

        // TODO: temporal hack, this controller is only for app patients
        if ($user->user_type() == 3) {
            $appPatient = $appPatientFinder->execute($user->id());

            $userData['identity'] = $appPatient->identity();
            $userData['birth_date'] = $appPatient->birth_date();
            $userData['sex'] = $appPatient->sex();
            $userData['phone'] = $appPatient->phone();
            $userData['avatar_url'] = $appPatient->avatar_url();
        }

        return $this->respondWithTokenAndUser($token, $userData);
    }
}
