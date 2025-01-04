<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::create(['name' => 'Remote']);
        Tag::create(['name' => 'Full-Time']);
        Tag::create(['name' => 'PHP']);
        Tag::create(['name' => 'Laravel']);
        Tag::create(['name' => 'Part-Time']);
    }
}
