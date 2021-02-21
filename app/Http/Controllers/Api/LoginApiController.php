<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\ResponserTrait;

class LoginApiController extends Controller
{
    use ResponserTrait;

    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('user')->plainTextToken;

            $user->token = $token;

            return $this->respondCollection('success', new UserResource($user));
        }
        return $this->respondErrorTokenExpire('These credentials do not match our records!');

    }
}
