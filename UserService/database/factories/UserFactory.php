<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $password = Hash::make('12345678');
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $name = '';
        for ($i = 0; $i < 10; $i++) {
            $name .= $alphabet[rand(0, strlen($alphabet) - 1)];
        }
        return [
            'fullname' => fake()->name(),
            'email' => $name . rand(0, 1000000) . '@yopmail.com',
            'email_verified_at' => now(),
            'password' => $password, // password
            'remember_token' => Str::random(10),
            'role_id' => rand(0, 1),
            'wallet' => 0,
            'created_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
