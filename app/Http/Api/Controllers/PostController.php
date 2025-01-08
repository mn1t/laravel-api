<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Resources\ShowPostResource;
use App\Models\Post;
use App\Http\Api\Resources\PostResource;
use DB;
use Illuminate\Http\Request;
use App\Http\Api\Requests\StorePostRequest;
use App\Http\Api\Requests\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\Post\Service;


class PostController extends ApiController
{
    use AuthorizesRequests;

    public $service;

    public function __construct(Service $service) 
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        $this->authorize('viewAny', Post::class);
        return $this->success(PostResource::collection(Post::orderByDesc('created_at')->paginate(10)));
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);
        return $this->success($this->service->store($request));
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return $this->success(new ShowPostResource($post));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->all());

        return $this->success($post);
    }

    public function destroy(Request $request, Post $post,)
    {
        $this->authorize('delete', $post);
        $post->delete();
        
        return $this->success();
    }
}
