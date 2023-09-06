<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // On every seeding run, 
        // start by deleting data from all the tables
        User::truncate();
        Category::truncate();
        Post::truncate();
        Comment::truncate();

        User::factory(10)->create();
        Category::factory(5)->create();
        Post::factory(10)->create();
        Comment::factory(10)->create();
    }
}
