<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Controllers\ApiController;
use App\Http\Api\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends ApiController
{
    public function store(StoreCommentRequest $request, $post)
    {   
        return $this->success(Comment::create([
            'message' => $request->message,
            'post_id' => $request->post,
            'user_id' => $request->user()->id,
        ]));
    }

}