<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['usuario'] =  $user;

        return $this->sendResponse($success, 'Usuario criado com sucesso.');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (!$token = Auth::attempt($credentials)) {
            return $this->sendResponse(
                [
                    'success' => false,
                    'token' => '',
                    'expires' => 0,
                    'user' => []
                ],
                'as credenciais informádas são inválidas',
                200,
                'login',
                false
            );
        }

        $success = $this->respondWithToken($token);

        return $this->sendResponse($success, 'login do usuario realizado com sucesso.');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $success = Auth::user();

        return $this->sendResponse($success, 'perfil retornado com sucesso.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return $this->sendResponse([], 'logout ocorrido com sucesso.');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        /** @var Illuminate\Auth\AuthManager */
        $auth = auth();
        $success = $this->respondWithToken($auth->refresh());

        return $this->sendResponse($success, 'token de redefinição retornado com sucesso.');
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
        /** @var Illuminate\Auth\AuthManager */
        $auth = auth();

        $issued = date('Y-m-d H:i:s');

        $expired = Carbon::now();
        $expiredTime = $expired->addMinutes($auth->factory()->getTTL());

        return [
            'token' => $token,
            'issued' => $issued,
            'expires' => $expiredTime->getPreciseTimestamp(3),
            'user' => $auth->user()
        ];
    }
}
