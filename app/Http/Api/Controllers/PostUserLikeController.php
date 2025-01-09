<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Services\Post\Service;

class PostUserLikeController extends ApiController
{
    public $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function __invoke(Request $request, $post)
    {
        return $this->success($this->service->like($request, $post));
    }
}
