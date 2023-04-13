<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body'               => $this->faker->text(),
            'author_id'          => User::factory(),
            'commentable_id'     => Post::factory(),
            'commentable_type'   => Post::TABLE,
        ];
    }
}
