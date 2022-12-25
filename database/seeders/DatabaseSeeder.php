<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\Post::factory(50)->create();

        $tags = \App\Models\Tag::all();
        \App\Models\Post::all()->each(function ($post) use ($tags) { 
            $post->tags()->attach(
                $tags->random(rand(1, 10))->pluck('id')->toArray()
            ); 
        });
        
        \App\Models\Comment::factory(100)->create();
        \App\Models\Like::factory(1000)->create();
    }
}
