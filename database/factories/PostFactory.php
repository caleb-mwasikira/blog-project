<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = DB::table('users')->where("role", "author")->pluck("id");
        $categoryIds = DB::table('categories')->pluck('id');
        $isPublished = fake()->boolean();
        $publishedDate = $isPublished ? fake()->dateTime()->format('Y-m-d H:i:s') : null;

        return [
            "user_id" => fake()->randomElement($userIds),
            "category_id" => fake()->randomElement($categoryIds),
            "title" => fake()->sentence(),
            "body" => fake()->paragraph(),
            "is_published" => $isPublished,
            "published_at" => $publishedDate,
        ];
    }
}
