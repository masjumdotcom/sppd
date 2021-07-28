<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\Letter;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Participant::class;

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
            'letter_id'           => Letter::factory(),
            'user_id'           => $this->faker->numberBetween($min = 1, $max = 30),
            'cost_per_day'      => $this->faker->numberBetween($min = 100000, $max = 600000),
            'start_work'        => $dateNow,
            'end_work'          => $now->addDays($dayAdd),
            'lead'              => false,
        ];
    }
}
