<?php

namespace App\Http\Controllers;

use App\Exceptions\UserWrongCredentials;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\SignInRequest;
use App\Http\Requests\Authentication\SignUpRequest;
use App\Services\Authentication\SignInUserService;
use App\Services\Authentication\SignUpUserService;
use Exception;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(SignUpRequest $request)
    {
        try {
            $user = (new SignUpUserService())->execute($request->only(['name', 'email', 'password']));

            return $this->success([
                'token' => $user->createToken('API Token')->plainTextToken
            ]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function login(SignInRequest $request)
    {
        try {
            (new SignInUserService())->execute($request->only(['email', 'password']));

            return $this->success([
                'token' => auth()->user()->createToken('API Token')->plainTextToken
            ]);
        } catch (UserWrongCredentials $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
