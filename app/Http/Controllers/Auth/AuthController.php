<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            'senha' => 'required',
            'confirma_senha' => 'required|same:senha',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['senha'] = bcrypt($input['senha']);
        $user = User::create($input);
        $success['usuario'] =  $user;

        return $this->sendResponse($success, 'Usuario criado com sucesso.');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'senha']);

        $credentials = [
            'email' => $credentials['email'],
            'password' => $credentials['senha'],
        ];

        $auth = auth();
        if (!$token = $auth->attempt($credentials)) {
            return $this->sendResponse(
                [
                    'token_acesso' => '',
                    'token_tipo' => '',
                    'expira_em' => 0
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
        $success = auth()->user();

        return $this->sendResponse($success, 'perfil retornado com sucesso.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

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

        return [
            'token_acesso' => $token,
            'token_tipo' => 'bearer',
            'emitido_em' => date('Y-m-d H:i:s'),
            'expira_em' => $auth->factory()->getTTL() * 60
        ];
    }
}
