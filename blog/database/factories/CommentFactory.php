<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        return [
            'post_id' => rand(1, 13),
            'user_id' => rand(1, 10), //zato sto imamo 13 postova kao seed
            'body' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
