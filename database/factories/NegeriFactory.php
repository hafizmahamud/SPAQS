<?php

namespace Database\Factories;

use App\Models\Negeri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class NegeriFactory.
 */
class NegeriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Negeri::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'singkatan' => $this->faker->word,
            'negeri' => $this->faker->word,
            'alamat' => $this->faker->word,
        ];
    }
}
