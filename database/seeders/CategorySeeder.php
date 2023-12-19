<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Помады']);
        Category::create(['name' => 'Крема']);
        Category::create(['name' => 'Тени']);
        Category::create(['name' => 'Тушь']);
    }
}
