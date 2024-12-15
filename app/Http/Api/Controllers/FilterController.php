<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Resources\PostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FilterController extends ApiController
{
    public function index(Request $request)
    {
        return PostResource::collection(User::has('Posts')->where('name', $request->name)->first()->posts);
    }
}
