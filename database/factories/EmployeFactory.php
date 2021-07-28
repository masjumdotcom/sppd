<?php

namespace Database\Factories;

use App\Models\Employe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return 
        [
            'user_id'       => User::factory(),
            'nip'           =>  $this->faker->numberBetween($min = 1000000000, $max = 9000000000),
            'jabatan'       => 'Staf',
            'pangkat'       => 'Gol AB',
            'status'        => null,
            'is_active'     => 1,
        ];
    }
}
