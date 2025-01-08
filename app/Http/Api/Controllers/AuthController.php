<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Http\Api\Requests\StoreUserRequest;
use App\Http\Api\Requests\ConfirmAuthRequest;
use App\Models\User;
use App\Services\Auth\Service;

class AuthController extends ApiController
{
    public $service;
    public function __construct(Service $service )
    {
        $this->service = $service;
    }

    public function auth(AuthRequest $request)
    {
        if(User::where('phone', '=', $request->phone)->exists()){
            return $this->success('Код отправлен');
        } 
        return $this->fail('Пользователь с таким номером не найден', 404);
    }

    public function confirm(ConfirmAuthRequest $request)
    {
        return $this->service->confirm($request);
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
