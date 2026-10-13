<?php

namespace App\Http\Controllers;

use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Torann\GeoIP\Facades\GeoIP;
use App\User;
use App\UserInfo;
use App\UserLog;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'loginAdmin', 'register']]);
        $this->middleware('cors');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithTokenAndUser($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAdmin()
    {
        $credentials = request(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();

        // if user not exist
        if (!$user) {
            return response()->json(['error' => 'Correo electrónico no registrado'], 403);
        }

        // if not admin
        if ($user->admin == 0) {
            return response()->json(['error' => 'No tienes acceso al panel administrativo'], 401);
        }

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email o contraseña incorrecta'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'identification' => 'required',
            'type' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        $location = geoip($request->ip());


        // print_r($request->all());
        // print_r($location);

        try {
            // verify that email not were already used
            $userEmailMatch = User::where('email', $request->get('email'))->first();

            if ($userEmailMatch) {
                throw new \Exception("El correo electrónico ya fue usado en otra cuenta.", 404);
            }

            // make user with data
            $user = User::create([
                'name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'identification' => $request->get('identification'),
                'type' => $request->get('type'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'password' =>  Hash::make($request->get('password'))
            ]);

            $userInfo = UserInfo::create([
                'user_id' => $user->id,
            ]);

            $browser = new Browser();
            $os = new Os();

            $userLog = UserLog::create([
                'user_id' => $user->id,
                'ip_address' => $location['ip'],
                'os' => $os->getName() . ' ' . $os->getVersion(),
                'browser' => $browser->getName() . ' ' . $browser->getVersion(),
                'country' => $location['country'],
                'city' => $location['city'],
                'state' => $location['state_name'],
            ]);

            // atempt make token with user
            $credentials = request(['email', 'password']);

            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // return response()->json(['dd' => 'lul']);
            // return token
            return $this->respondWithToken($token);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 403);
        }



        // $location = geoip($request->ip());

        // // verify all data is right
        // // check if activation code exist - code_type 2 is platform pin, status 1 is available pin
        // $activationCode = Pin::where('code_type', 2)->where('code', $request->get('activationCode'))->first();
        // $activationPin = Pin::where('code_type', 1)->where('code', $request->get('pin'))->first();

        // try {
        //     if ($this->checkIfPinCodeIsValid($activationCode)) {
        //         // check if email is available
        //         $userEmailMatch = User::where('email', $request->get('email'))->first();

        //         if ($userEmailMatch) {
        //             throw new \Exception("El correo electrónico ya fue usado en otra cuenta.", 404);
        //         }

        //         if (!$activationPin) {
        //             throw new \Exception("Código de caja incorrecto.", 404);
        //         }

        //         if ($activationPin->couple !== null) {
        //             throw new \Exception("Código de caja ya fue usado.", 404);
        //         }

        //         // create client
        //         $client = Client::create([
        //                 'identification' => '',
        //                 'name' =>  urldecode($request->get('fullName')),
        //                 'phone' => urldecode($request->get('phone')),
        //                 'email' => urldecode($request->get('email')),
        //                 'city' => '',
        //                 'profession' => '',
        //                 'status' => 1,
        //                 'social' => 0
        //             ]);

        //         $activationToken = md5($this->generateRandomString());

        //         // create activation
        //         // register the activation
        //         $activation = Activation::create([
        //             'code' => $activationCode->code,
        //             'code_type' => $activationCode->code_type,
        //             'client_id' => $client->id,
        //             'mac_address' => '',
        //             'ip_address' => $location->ip,
        //             'os' => '',
        //             'token' => $activationToken,
        //             'offlineCode' => null
        //         ]);
        //         // create new user with email and password

        //         $user = User::create([
        //             'client_id' => $client->id,
        //             'name' => $client->name,
        //             'email' => $client->email,
        //             'password' =>  Hash::make($request->get('password')),
        //             'activated' => 1,
        //             'validated' => 0,
        //             'validated_code' => ''
        //         ]);

        //         // activation pin couple
        //         $activationPin->couple = $activationCode->code;
        //         $activationPin->save();
        //         // atempt make token with user
        //         // return token
        //         $credentials = request(['email', 'password']);

        //         if (! $token = auth('api')->attempt($credentials)) {
        //             return response()->json(['error' => 'Unauthorized'], 401);
        //         }

        //         return $this->respondWithToken($token);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 403);
        // }
    }

    // private function checkIfPinCodeIsValid($pin)
    // {
    //     if(!$pin) {
    //         // 404 pin not found
    //         throw new \Exception("Código de activación incorrecto.", 404);
    //     }

    //     // check if pincode is not blocked
    //     if($pin->status === 4) {
    //         // 403 pin blocked
    //         throw new \Exception("Código desactivado.", 403);
    //     }

    //     // check how many activations have the pinCode
    //     $activationsCount = $pin->activations()->count();

    //     // if pincode activations is under limit -> proceed
    //     if($activationsCount >= $pin->posible_activations) {
    //         // 403 max activations reached
    //         throw new \Exception("El código de activación ya fue utilizado.", 403);
    //     }

    //     return true;
    // }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenAndUser($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $this->transformUserData()
        ]);
    }

    private function transformUserData() {
        $currentUser = auth('api')->user();

        $userData = [
            'id' => $currentUser['id'],
            'email' => $currentUser['email'],
            'name' => $currentUser['name'],
            'status' => $currentUser['status'],
            'role_id' => $currentUser['role_id'],
        ];

        return $userData;
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
