<?php

namespace Database\Factories;

use App\Models\Edition;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EditionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Edition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'subtitle' => $this->faker->text(255),
            'title_parent' => $this->faker->text(255),
            'volume' => $this->faker->text(255),
            'page_range' => $this->faker->word(255),
            'page_total' => $this->faker->word(255),
            'publisher_name' => $this->faker->text(255),
            'publisher_city' => $this->faker->text(255),
            'date' => $this->faker->date,
            'isbn' => $this->faker->text(255),
            'document_id' => \App\Models\Document::factory(),
        ];
    }
}
