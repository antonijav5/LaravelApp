<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => rand(1, 10), //zato sto imamo 10 usera kao seed
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
            // 'image' => 'images/posts/' . rand(1, 13) . '.jpg',
        ];
    }
}
