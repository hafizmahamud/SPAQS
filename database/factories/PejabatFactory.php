<?php

namespace Database\Factories;

use App\Models\Pejabat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PejabatFactory.
 */
class PejabatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pejabat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'singkatan' => $this->faker->word,
            'bahagian' => $this->faker->word,
            'negeri_id' => $this->faker->randomDigit,
        ];
    }
}
