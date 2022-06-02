<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $categories = [
      [
        'name' => 'Makanan',
        'slug' => 'makanan',
        'images' => 'https://www.tokopedia.com/images/category/makanan.png',

      ]

    ];
    foreach ($categories as $category) {
      Category::create([
        'name' => $category['name'],
        'slug' => Str::slug($category['name']),
        'is_parent' => $category['is_parent'] ?? 0,
        'parent_id' => $category['parent_id'] ?? null
      ]);
    }
  }
}
