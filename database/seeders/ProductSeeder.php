<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $faker = Faker::create();

        // Lấy danh sách tất cả các category (nếu bạn đã có các category trong cơ sở dữ liệu)
        $categories = Category::all();

        foreach ($categories as $category) {
            // Tạo 10 sản phẩm cho mỗi category
            for ($i = 0; $i < 10; $i++) {
                Product::create([
                    'name' => $faker->word,
                    'description' => $faker->sentence,
                    'price' => $faker->randomFloat(2, 10, 100), // Giá sản phẩm
                    'stock' => $faker->numberBetween(1, 100), // Số lượng trong kho
                    'sku' => $faker->unique()->word, // SKU duy nhất
                    'image' => $faker->imageUrl(), // Link ảnh ngẫu nhiên
                    'category_id' => $category->id, // Tham chiếu đến category
                ]);
            }
        }
    }
}