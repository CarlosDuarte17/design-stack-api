<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return new PostCollection(Post::query()
                ->paginate(20, '*', 'page', $request->input('page') ?? 1));
    }

    public function store(Request $request)
    {
//        return response()->json([
//            'data' => $request->all()
//        ], 200);
//        return $request->user();
        $data = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'tags' => ['required'],
            'file' => ['required'],
        ]);

        $file = $request->file('file');

        $path = $file->store('images', 'public');

        $post = $request->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $request->root().'/storage/'.$path
        ]);

        if  ($post) {
            $tags = explode(',', $data['tags']);

            foreach ($tags as $tag) {
                if (trim($tag)) {
                    $post->tags()->create([
                        'tag' => $tag,
                    ]);
                }
            }
            return response()->json([
                'post' => $post,
                'message' => 'Success'
            ]);
        }

        return response()->json([
            'message' => 'error'
        ], 500);
    }
}
