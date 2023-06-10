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
        $categories_name = [
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
        $categories_image = [
            'https://cdn-icons-png.flaticon.com/128/2281/2281829.png',
            'https://cdn-icons-png.flaticon.com/128/3145/3145765.png',
            'https://cdn-icons-png.flaticon.com/128/8389/8389176.png',
            'https://cdn-icons-png.flaticon.com/128/1157/1157001.png',
            'https://cdn-icons-png.flaticon.com/128/2017/2017538.png',
            'https://cdn-icons-png.flaticon.com/128/3412/3412953.png',
            'https://cdn-icons-png.flaticon.com/128/2849/2849198.png',
            'https://cdn-icons-png.flaticon.com/128/1032/1032687.png',
            'https://cdn-icons-png.flaticon.com/128/4717/4717998.png',
            'https://cdn-icons-png.flaticon.com/128/2382/2382461.png',
        ];

        //create 10 categories
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $categories_name[$i],
                'image' => $categories_image[$i],
                'status' => 1,
                'description' => 'This is description for category ' . $categories_name[$i],
                'created_at' => now(),
            ]);
        }
    }
}
