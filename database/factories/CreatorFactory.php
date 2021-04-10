<?php

namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Creator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_names' => $this->faker->text(255),
            'last_names' => $this->faker->text(255),
            'author' => $this->faker->boolean,
            'editor' => $this->faker->boolean,
            'translator' => $this->faker->boolean,
            'compiler' => $this->faker->boolean,
        ];
    }
}
