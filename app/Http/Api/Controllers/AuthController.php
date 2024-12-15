<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\AuthRequest;
use Auth;
use Illuminate\Http\Request;
use App\Http\Api\Requests\StoreUserRequest;
use App\Http\Api\Requests\ConfirmAuthRequest;

use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends ApiController
{

    public function auth(AuthRequest $request)
    {
        if(User::where('phone', '=', $request->phone)->exists()){
            return $this->success('Код отправлен');
        } 
        return $this->fail('Пользователь с таким номером не найден', 404);
    }

    public function confirm(ConfirmAuthRequest $request)
    {
        if(User::where('phone', '=', $request->phone)->exists()){
            if($request->code === substr($request->phone, -4)){
                $user = User::where('phone', $request->phone)->first();
                $token = $user->createToken("{$request->phone} token ");
                return $this->success([
                    'token' => $token->plainTextToken,
                ]);
            }       
        }else{
             return $this->fail('Пользователь не найден', 404);
        }

        return $this->fail('Неправильный код подтверждения', 404);
    }

    public function logout(Request $request)
    {
        return $this->success($request->user()->currentAccessToken()->delete());
    }

    public function register(StoreUserRequest $request)
    {
        return $this->success(User::create($request->all()));
    }
}
