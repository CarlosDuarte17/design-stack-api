<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(10)->create();
        $users = User::all();
        $users->each(function ($user, $key){
            Log::info("email:".$user->email." token".$key."--->  ".$user->createToken('auth_token')->plainTextToken);
        });
        Post::factory(30)->create();
        $this->createTags();
        $this->createPostsTags();
        $this->createMedias();
    }

    function createTags()
    {
        $tags = ['illustration', 'desing', 'dribbble', 'graphic design'];
        foreach ($tags as $tag) {
            Tag::query()->create([
                'tag' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }

    function createPostsTags() {
        $tags = Tag::all();
        $posts = Post::all();

        for ($i = 0; $i < 10; $i++) {
            $post = $posts->random();
            $post->tags()->attach($tags->random());
        }
    }

    function createLikes() {
        $users = User::all();
        $posts = Post::all();

        for ($i = 0; $i < 10; $i++) {
            $post = $posts->random();
            $post->tags()->attach($users->random());
        }
    }

    function createMedias() {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->medias()->create([
                'path' => '/id/212/500/500.jpg?hmac=-kY7qwGIXiojkBFGjs-85oVC-LGV9ZemgovUZh1qYR4',
                'source' => 'https://i.picsum.photos',
                'type' => 'image',
            ]);
        }
    }
}
