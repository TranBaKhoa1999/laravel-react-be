<?php

namespace Database\Seeders;

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
            ['name' => 'Electronics', 'description' => 'Electronic gadgets and devices'],
            ['name' => 'Clothing', 'description' => 'Men and Women fashion'],
            ['name' => 'Home Appliances', 'description' => 'Appliances for home use'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}