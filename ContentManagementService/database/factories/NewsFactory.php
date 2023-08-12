<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(), // 'porro-autem-quia-ut-alias-delectus-impedit-voluptatem
            'description' => $this->faker->paragraph(1), // 'Quisquam qui corporis quia.
            'content' => $this->faker->paragraph(3),
            'image' => $this->faker->imageUrl(), // 'http://lorempixel.com/640/480/?66365
            'is_active' => $this->faker->boolean(), // false
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
