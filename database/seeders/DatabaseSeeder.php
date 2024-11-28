<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< Updated upstream
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
=======
        User::factory(5)->create();

        Listing::factory(5)->create();
        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email1@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        // ]);
        // Listing::create([
        //     'title' => 'Full Stack Engineer',
        //     'tags' => 'HTML, CSS, JavaScript, Python',
        //     'company' => 'Stark Industries',
        //     'location' => 'Calfornia, CA',
        //     'email' => 'email45@email.com',
        //     'website' => 'https://www.stark-industries.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        // ]);
>>>>>>> Stashed changes
    }
}
