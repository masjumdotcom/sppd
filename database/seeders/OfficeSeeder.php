<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Office::insert([
            'region'            => 'Malang',
            'region_sys'        => 'Kabupaten',
            'name'              => 'Donomulyo',
            'slug'              => 'donomulyo',
            'address'       => 'Jl. Raya Donomulyo No.9',
            'post_code'     => '65152',
            'contact_phone' => '(0341) 801 286',
            'contact_email' => 'donomulyo@malangkab.go.id',
            'contact_web'   => 'www.malangkab.go.id',
            'user_id_auth'   => 1,
            'user_id_finance'   => 2,
            'user_id_pjb_finance'   => 3,
            'redaktur'      => '<p>Sesuai prosedur, setelah melaksanakan kegiatan dimaksud agar melaporkan hasilnya kepada pimpinan.</p><p>Demikian Surat Tugas ini disampaikan kepada yang bersangkutan untuk dilaksanakan dengan penuh tanggung jawab.</p>'
        ]);
    }
}
