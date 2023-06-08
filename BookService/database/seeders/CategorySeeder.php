<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Commic',
            'Novel',
            'Technology',
            'Sience',
            'Economic',
            'Business',
            'Education',
            'History',
            'Literature',
            'Health'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'status' => 1,
                'description' => 'This is description for category ' . $category,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
