<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->unique(Post::pluck('id')),
            'media_path' => '/id/212/500/500.jpg?hmac=-kY7qwGIXiojkBFGjs-85oVC-LGV9ZemgovUZh1qYR4',
            'media_source' => 'https://i.picsum.photos'
        ];
    }
}
