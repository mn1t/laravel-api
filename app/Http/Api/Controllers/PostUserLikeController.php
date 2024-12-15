<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Models\PostUserLike;
use Illuminate\Http\Request;

class PostUserLikeController extends ApiController
{
    public function __invoke(Request $request, $post)
    {
        if($like = PostUserLike::where('post_id', $post)->where('user_id', $request->user()->id)->first()){
            $like->delete();
            return $this->success('unliked');
        }

        PostUserLike::create([
            'post_id' => $request->post,
            'user_id' => $request->user()->id,
        ]);
        return $this->success('liked');
    }
}
