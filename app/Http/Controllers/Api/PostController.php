<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return new PostCollection(Post::query()->latest()->paginate(10));
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'tags' => ['required'],
            'description' => ['nullable'],
            'files' => ['required'],
        ]);

        $post = $request->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        if (!$post) {
            return response()->json([
                'message' => 'error'
            ], 500);
        }

        if($files = $request->file('files'))
        {
            foreach ($files as $file)
            {
                $path = $file->store('media', 'public');
                $post->medias()->create([
                    'path' => '/storage/'.$path,
                    'source' => $request->root(),
                    'type' => Str::before($file->getMimeType(), '/'),
                ]);
            }
        }

        $tags = explode(',', mb_strtolower($data['tags']));
        foreach ($tags as $tag) {
            if ($trimTag = trim($tag)) {
                $currentTag = Tag::query()->firstOrCreate(['tag' => $trimTag], ['slug' => Str::slug($tag)]);
                $post->tags()->attach($currentTag);
            }
        }

        return new PostResource($post);
    }
}
