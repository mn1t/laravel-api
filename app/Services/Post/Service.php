<?php

namespace App\Services\Post;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;

class Service
{  
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
}