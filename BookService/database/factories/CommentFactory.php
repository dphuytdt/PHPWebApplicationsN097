<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Book;
use App\Models\Category;
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
        // $user_id = User::pluck('id')->toArray();
        $book_id = Book::pluck('id')->toArray();
        return [
            'comment_name' => $this->faker->name(),
            'content' => $this->faker->text(),
            'image' => $this->faker->imageUrl(),
            'user_id' => $this->faker->numberBetween(1, 300),
            'book_id' => $this->faker->randomElement($book_id),
            'comment_parent_id' => $this->faker->numberBetween(1, 300),
            'status' => $this->faker->numberBetween(0, 1),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
