<?php

namespace Database\Seeders;

use App\Models\Catalog\Category;
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
        Category::insert([
            ['name' => 'легкий'],
            ['name' => 'хрупкий'],
            ['name' => 'тяжелый']
        ]);
    }
}
