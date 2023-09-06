<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = DB::table('users')->pluck('id');
        $postIds = DB::table('posts')->pluck('id');

        return [
            "user_id" => fake()->randomElement($userIds),
            "post_id" => fake()->randomElement($postIds),
            "body" => fake()->paragraph(),
        ];
    }
}
