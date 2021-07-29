<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employe;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = Employe::insert([
            'user_id'       => 1,
            'nip'           => '2154 0464 879 98',
            'jabatan'       => 'Camat Donomulyo',
            'pangkat'       => 'Gol O',
            'status'        => 'Pembina Tingkat 1',
        ]);
    }
}
