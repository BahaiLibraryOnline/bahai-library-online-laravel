<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_pdf' => $this->faker->boolean,
            'is_audio' => $this->faker->boolean,
            'is_image' => $this->faker->boolean,
            'is_video' => $this->faker->boolean,
            'is_html' => $this->faker->boolean,
            'file_url' => $this->faker->text(255),
            'blurb' => $this->faker->text,
            'content_html' => $this->faker->text,
            'content_size' => $this->faker->word,
            'edit_quality' => 'high',
            'formatting_quality' => 'high',
            'publication_permission' => 'author',
            'notes' => $this->faker->text,
            'input_type' => 'scanned',
            'input_date' => $this->faker->date,
            'proof_date' => $this->faker->date,
            'format_date' => $this->faker->date,
            'post_date' => $this->faker->date,
            'publication_approval' => 'approved',
            'views' => 0,
        ];
    }
}
