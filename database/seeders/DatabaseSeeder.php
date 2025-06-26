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
    public function run(): void
    {   Post::create([
        'title' => 'Welcome to the Comment System',
        'content' => 'You can add comments and nested replies up to 3 levels deep.',
    ]);
    }
}
