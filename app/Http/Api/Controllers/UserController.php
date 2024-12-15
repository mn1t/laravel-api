<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\SetUserAvatarRequest;
use App\Models\User;

class UserController extends ApiController
{
    public function set_avatar(SetUserAvatarRequest $request){
        User::find($request->user()->id)->update([
            'avatar' => $request->file('avatar')->store('user_avatars')
        ]);
        
        return $this->success();
    }
}
