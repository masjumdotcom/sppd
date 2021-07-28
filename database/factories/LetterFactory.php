<?php

namespace Database\Factories;

use App\Models\Letter;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LetterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Letter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now        = Carbon::now();
        $dateNow    = $now->format('Y-m-d');
        $dayAdd     = $this->faker->numberBetween($min = 1, $max = 6);
        return [
            'office_id'             => 1,
            'user_id_auth'          => 1,
            'user_id_finance'       => 2,
            'user_id_pjb_finance'   => 3,
            'num_validate'          => $this->faker->numberBetween($min = 1000000000, $max = 9000000000),
            'nomor'                 => '094/'. $this->faker->numberBetween($min = 10, $max = 99) . '/' . '35.07.19/' . $this->faker->numberBetween($min = 100, $max = 900),
            'transportasi'          => 'Angkutan Darat',
            'dasar'                 => '<p>Phonogram Asisten Administrasi Umum, Tanggal 1 Maret 2019, Nomor 005/121/35.032/2019, perihal : Undangan</p>',
            'acara'                 => $this->faker->sentence(6, true),
            'cost'                  => 'Kantor Camat Pakisaji',
            'from'                  => 'Kantor Kecamatan',
            'place_name'            => $this->faker->city() . ' ' .$this->faker->state(),
            'to'                    => $this->faker->address(),
            'date_start'            => $dateNow,
            'date_end'              => $now->addDays($dayAdd),
            'place_issue'           => 'Pakisaji',
            'date_issue'            => $dateNow,
            'user_id'               => $this->faker->numberBetween($min = 1, $max = 30),
            'redaktur'              => '<p>Sesuai prosedur, setelah melaksanakan kegiatan dimaksud agar melaporkan hasilnya kepada pimpinan.</p><p>Demikian Surat Tugas ini disampaikan kepada yang bersangkutan untuk dilaksanakan dengan penuh tanggung jawab.</p>',
        ];
    }
}
