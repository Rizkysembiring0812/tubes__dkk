<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $description = "<div>
           <div>
              <ul>
                 <li>
                    <span>Brand  </span>
                    <div>Lenovo</div>
                 </li>
                 <li>
                    <span>SKU  </span>
                    <div>LE599FA08295GNAFAMZ-185623</div>
                 </li>
                 <li>
                    <span>Compatible Laptop Size  </span>
                    <div  key-value>Not Specified</div>
                 </li>
                 <li>
                    <span>Closure Type  </span>
                    <div  key-value>Zippers</div>
                 </li>
                 <li>
                    <span> Dust Resistant  </span>
                    <div key-value>Not Specified</div>
                 </li>
                 <li>
                    <span > Lockable  </span>
                    <div key-value>Not Specified</div>
                 </li>
                 <li>
                    <span> Model </span>
                    <div>GX40Q17226</div>
                 </li>
              </ul>
           </div>
           <div >
              <span>What’s in the box</span>
              <div box-content-html>Blue B210 15.6 Laptop Backpack- GX40Q17226</div>
           </div>
        </div>";



      $products = [
         [
            'title' => 'Pisang Sale',
            'slug' => 'pisang-sale',
            'description' => $description,
            'price' => '10000',
            'discount' => '0',
            'image' => 'pisang-sale.jpg',
            'category_id' => 1,
            'status' => 1,
            'user_id' => 1,
         ],

         [
            'title' => 'Coklat Pisang',
            'slug' => 'coklat-pisang',
            'description' => $description,
            'price' => '10000',
            'discount' => '0',
            'image' => 'coklat-pisang.jpg',
            'category_id' => 1,
            'status' => 1,
            'user_id' => 1,
         ]

      ];

      foreach ($products as $product) {
         $newProduct = Product::create([
            'user_id' => 1,
            'title' => $product['title'],
            'price' => $product['price'],
            'image' => '/images/products/' . $product['img'] . '.jpg',
            'category_id' => 1,
            'discount' => $product['discount'],
            'slug' => Str::slug($product['title']),
            'product_code' => Str::upper(Str::random(6)),
            'description' => $description,
            'status' => true,
         ]);
      }
   }
}
