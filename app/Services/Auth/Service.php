<?php 

namespace App\Services\Auth;

use App\Models\User;
use App\Http\Traits\ResponseHelper;

class Service
{
    use ResponseHelper;
    public function confirm($request)
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
}