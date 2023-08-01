<?php

namespace Database\Factories;

use App\Models\SenaraiAlamat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class SenaraiAlamatFactory.
 */
class SenaraiAlamatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SenaraiAlamat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jenis_alamat' => $this->faker->word,
            'alamat' => $this->faker->word,
        ];
    }
}
