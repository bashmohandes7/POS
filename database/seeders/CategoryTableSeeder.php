<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['cat one', 'cat two', 'cat tree'];

        foreach ($categories as $category)
        {
            Category::create([
                'ar' => ['name' => $category],
                'en' => ['name' => $category],
            ]);
        } // end of foreach

    } // end of run
} // end of seeder
