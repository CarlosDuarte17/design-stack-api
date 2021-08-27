<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $like = $post->likes()->toggle($request->user()->id);

        return new LikeResource($like);
    }
}
