<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'activity_type' => 'created',
            'comment' => $this->faker->text(255),
            'document_id' => \App\Models\Document::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
