<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Tag $tag)
    {
       if (!$tag) {
           return new PostCollection([]);
       }
       return new PostCollection($tag->posts()->paginate(10));
    }

    public function show(string $slug)
    {
        $tag = Tag::query()->firstWhere('slug', $slug);
        if (!$tag) {
            return new PostResource([]);
        }

        return new PostResource($tag->posts()->paginate(10));
    }
}
