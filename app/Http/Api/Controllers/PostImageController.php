<?php

namespace App\Http\Api\Controllers;

use App\Exceptions\ApiException;
use App\Http\Api\Requests\StorePostImageRequest;
use App\Models\Post;

class PostImageController extends ApiController
{
    public function store(StorePostImageRequest $request, $post){
    
        if(request()->exists('img')){
            $request['image'] = $request->file('img')->store('post_images');
        }
        
        return $this->success(Post::find($post)->update($request->all()));
    }
}
