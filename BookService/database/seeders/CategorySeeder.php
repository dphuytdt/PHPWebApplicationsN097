<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\File;

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

        $imageFolder = storage_path('app/public/images/categories');
        $imageFiles = File::files($imageFolder);

        if (count($imageFiles) === 0) {
            $this->command->info('No image files found in the folder.');
            return;
        }

        foreach ($categories_name as $categoryName) {
            $randomImage = $imageFiles[array_rand($imageFiles)];
            $imageUrl = $randomImage->getPathname();
            $image = $this->parseImageToBase64($imageUrl);

            Category::create([
                'name' => $categoryName,
                'image' => $image,
                'status' => 1,
                'description' => 'This is description for category ' . $categoryName,
                'created_at' => now(),
            ]);
        }
    }

    private function parseImageToBase64(string $value)
    {
        $data = file_get_contents($value);
        $base64 = base64_encode($data);
        return $base64;
    }
}
