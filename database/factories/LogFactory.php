<?php

namespace Database\Factories;

use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory.
 */
class LogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Log::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1000,
            'log_name' => 'Login',
            'description' => 'User Test telah log masuk',
            'subject_id' => '2',
            'subject_type' => 'App\Domains\Auth\Models\User',
            'causer_id' => '2',
            'causer_type' => 'App\Domains\Auth\Models\User',
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }

}