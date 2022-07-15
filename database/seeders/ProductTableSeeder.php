<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['product one', 'product two', 'product three'];

        foreach ($products as $product)
        {
            Product::create([
                'category_id' => 1,
                'purchase_price' => 1200,
                'sale_price' => 1500,
                'stock' => 100,
                'ar' => ['name' => $product, 'description' => $product . ' desc'],
                'en' => ['name' => $product, 'description' => $product . ' desc'],
            ]);
        } // end of foreach

    } // end of run
} // end of seeder
