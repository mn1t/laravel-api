<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Resources\ShowPostResource;
use App\Models\Post;
use App\Http\Api\Resources\PostResource;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Api\Requests\StorePostRequest;
use App\Http\Api\Requests\UpdatePostRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class PostController extends ApiController
{
    use AuthorizesRequests;
    
    public function index(Request $request)
    {
        $this->authorize('viewAny', Post::class);
        return $this->success(PostResource::collection(Post::orderByDesc('created_at')->paginate(10)));

    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $request['user_id'] = $request->user()->id;
        
        if(request()->exists('img')){
            $request['image'] = $request->file('img')->store('post_images');
        }

        return $this->success(DB::transaction(function() use ($request){
            User::where('id', $request->user()->id)->increment('posts_today');
            return Post::create($request->all());
        }));
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
