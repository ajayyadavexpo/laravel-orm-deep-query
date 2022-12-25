<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $user = User::all();
        $userRandom = $user->random();
        $noteable = [
            \App\Models\Post::class
        ];

        return [
            'user_id' => $userRandom->id,
            'comment' => $this->faker->paragraph($nbSentences = 20, $variableNbSentences = true),
            'commentable_id' => $this->faker->numberBetween(1,10),
            'commentable_type' => $this->faker->randomElement($noteable),
        ];

    }
}
