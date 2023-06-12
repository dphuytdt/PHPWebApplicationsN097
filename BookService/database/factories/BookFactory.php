<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Category;
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

        $cover_image_list = [
            'https://salt.tikicdn.com/cache/750x750/ts/product/56/02/3e/cff1af1ee8c9dc82b0722988699a9fe3.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/ee/92/77/7fdffab191e5c9d9dc7fba6af68ef917.png.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/0d/3e/8b/61ea373ffb9145b08eb3feab3fab8dfc.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/41/b8/7a/b32bdb87eb8fc3b2c584096f0356d77e.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/57/44/86/19de0644beef19b9b885d0942f7d6f25.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/45/07/9a/99f272c371dc7a92d02b7f1cb0c3c594.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/24/ac/20/306dbe6ee83b60942209782d856fda78.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/b8/fd/c5/9c8448d2c40e8ce8767d463ac6bb4ea7.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/a8/5d/dc/5b51ac19e74a067c8fe4dd048ea9709d.jpg.webp',
            'https://salt.tikicdn.com/cache/750x750/ts/product/0d/3e/8b/61ea373ffb9145b08eb3feab3fab8dfc.jpg.webp',
        ];
        $filePath = storage_path('app/public/content.docx');

        // Đọc nội dung từ tệp tin docx
        $content = '';
        if (Storage::exists('public/content.docx')) {
            $content = $this->parseDocxContent($filePath);
        }
        return [
            'title' => $this->faker->name(),
            'author' => $this->faker->name(),
            'category_id' => $this->faker->randomElement($category_ids),
            // 'publisher_id' => $this->faker->numberBetween(1, 10),
            'quantity' => $this->faker->numberBetween(1, 1000),
            'price' => $this->faker->randomFloat(2, 1, 10000),
            'description' => $this->faker->text(),
            'cover_image' => $this->faker->randomElement($cover_image_list),
            // 'content_type' => $this->faker->numberBetween(1, 2),
            'content' => $content,
            'discount' => $this->faker->numberBetween(0, 100),
            'is_featured' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];

    }

    function parseDocxContent($filePath)
    {
        $content = '';
        $phpWord = IOFactory::load($filePath);
        $sections = $phpWord->getSections();
        foreach ($sections as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                $content .= $element->getText();
            }
        }
        return $content;
    }
}
