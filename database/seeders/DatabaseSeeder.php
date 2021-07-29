<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employe;
use App\Models\Letter;
use App\Models\Participant;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(OfficeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmployeSeeder::class);
        // Employe::factory(30)->create();
        // Letter::factory(30)->has(Participant::factory()->count(3))->create();
    }
}
