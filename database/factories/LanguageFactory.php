<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'language' => $this->faker->text(255),
            'language_tag' => $this->faker->word(255),
        ];
    }
}
