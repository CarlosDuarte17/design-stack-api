<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(string $slug)
    {
        $tag = Tag::query()->firstWhere('slug', $slug);
        if (!$tag) {
            return new TagResource([]);
        }

        return new TagResource($tag);
    }
}
