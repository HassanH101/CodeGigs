<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Web Development', 'description' => 'Jobs related to building websites and applications.']);
        Category::create(['name' => 'Data Science', 'description' => 'Jobs focused on data analysis and machine learning.']);
        Category::create(['name' => 'Graphic Design', 'description' => 'Jobs in creative design and visual communication.']);
    }
}
