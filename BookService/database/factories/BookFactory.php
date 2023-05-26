<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_ids = Category::pluck('id')->toArray();
        $author_ids = Author::pluck('id')->toArray();

        return [
            'title' => $this->faker->name(),
            'author_id' => $this->faker->randomElement($author_ids),
            'category_id' => $this->faker->randomElement($category_ids),
            // 'publisher_id' => $this->faker->numberBetween(1, 10),
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(1000000, 10000000000),
            'description' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'content' => $this->faker->text(),
            'is_free' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];

    }
}
