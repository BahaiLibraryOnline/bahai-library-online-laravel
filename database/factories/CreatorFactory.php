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
            'is_author' => $this->faker->boolean,
            'is_editor' => $this->faker->boolean,
            'is_translator' => $this->faker->boolean,
            'is_compiler' => $this->faker->boolean,
        ];
    }
}
