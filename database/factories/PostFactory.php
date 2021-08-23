<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'title' => $this->faker->text(10),
            'description' => $this->faker->paragraph(2),
            'image' => $this->faker->randomElement([
                'https://i.picsum.photos/id/212/500/500.jpg?hmac=-kY7qwGIXiojkBFGjs-85oVC-LGV9ZemgovUZh1qYR4',
                'https://i.picsum.photos/id/12/536/354.jpg?hmac=tSKhIIVeHahhRtQ8w9tZUA_E0yh38t7Ur43wbjkaatg'
            ])
        ];
    }
}
