<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            $categoryData[] = [
                'name' => Str::random(10),
                'visibility' => 1,
                'sort' => strtotime("now"),
            ];
        }  
        
        foreach ($categoryData as $category) {
            Category::create($category);
        }
    }
}
