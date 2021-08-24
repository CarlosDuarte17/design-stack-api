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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'tags' => ['required'],
            'files' => ['required'],
        ]);

        $post = $request->user()->posts()->create([
            'title' => $data['title'],
            'description' => $request->input('description') ?? '',
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
                $path = $file->store('images', 'public');
                $post->medias()->create([
                    'media_path' => '/storage/'.$path,
                    'media_source' => $request->root(),
                ]);
            }
        }

        $tags = explode(',', mb_strtolower($data['tags']));

        foreach ($tags as $tag) {
            if (trim($tag)) {
                if ($tagElement = Tag::all()->firstWhere('tag', trim($tag))) {
                    $post->tags()->attach($tagElement);
                } else {
                    $tagElement = Tag::query()->create([
                        'tag' => $tag,
                        'slug' => Str::slug($tag),
                    ]);
                    $post->tags()->attach($tagElement);
                }
            }
        }
        return response()->json([
            'post' => new PostResource($post),
        ]);
    }
}
