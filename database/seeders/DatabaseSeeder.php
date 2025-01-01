<?php

namespace Database\Seeders;

use App\Models\Post;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Post::create([
            'title' => 'First Post',
            'slug' => 'first-post',
            'content' => 'This is the content of the first post.',
        ]);

        Post::create([
            'title' => 'Second Post',
            'slug' => 'second-post',
            'content' => 'This is the content of the second post.',
        ]);
    }
}
