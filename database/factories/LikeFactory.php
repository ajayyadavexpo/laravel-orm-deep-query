<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

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
            \App\Models\Post::class,
            \App\Models\Comment::class
        ];

        return [
            'user_id' => $userRandom->id,
            'liked' => $this->faker->randomElement([0,1]),
            'likeable_id' => $this->faker->numberBetween(1,10),
            'likeable_type' => $this->faker->randomElement($noteable)
        ];
    }
}
