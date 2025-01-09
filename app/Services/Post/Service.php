<?php

namespace App\Services\Post;

use App\Models\PostUserLike;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use App\Http\Api\Resources\PostResource;

class Service
{  
    public function index($request) 
    {
       return [
            $paginator = PostResource::collection(Post::latest()->paginate(10)), 
            'page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'total_posts' => $paginator->total(),
        ];
    }

    public function store($request) 
    {
        $request['user_id'] = $request->user()->id;
        
        if(request()->exists('img')){
            $request['image'] = $request->file('img')->store('post_images');
        }

        return (DB::transaction(function() use ($request){
            User::where('id', $request->user()->id)->increment('posts_today');
            return Post::create($request->all());
        }));
    }

    public function storeImage($request, $post)
    {
        if($request->user()->id === Post::find($post)->user_id){
                $request['image'] = $request->file('img')->store('post_images');
                return Post::find($post)->update($request->all());
        }
        
        return 'Доступно только автору поста';
    }

    public function like($request, $post)
    {
        if($like = PostUserLike::where('post_id', $post)->where('user_id', $request->user()->id)->first()){
            
            $like->delete();
            return 'unliked';

        } else {

            PostUserLike::create([
                'post_id' => $request->post,
                'user_id' => $request->user()->id,
            ]);
    
            return 'liked';
        }

       
    }
}