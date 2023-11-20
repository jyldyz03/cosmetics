<?php
// database/seeders/CategorySeeder.php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Помады']);
        Category::create(['name' => 'Крема']);
        Category::create(['name' => 'Тени']);
    }
}
