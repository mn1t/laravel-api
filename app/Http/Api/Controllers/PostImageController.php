<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ApiException;
use App\Http\Api\Requests\StorePostImageRequest;
use App\Services\Post\Service;

class PostImageController extends ApiController
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function store(StorePostImageRequest $request, $post)
    {
        return $this->success($this->service->storeImage($request, $post));
    }
}
