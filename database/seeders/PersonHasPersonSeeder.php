<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonHasPerson;

class PersonHasPersonSeeder extends Seeder
{
    public function run()
    {
        PersonHasPerson::factory()->count(100)->create(); // Adjust the count as needed
    }
}
