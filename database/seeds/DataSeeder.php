<?php

use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create one user
        $user = factory(\App\Models\User::class)->create();

        // Create one post
        $user->posts()->create(factory(\App\Models\Post::class)->make()->toArray());
    }
}
