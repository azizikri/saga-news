<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => CategoryFactory::new(),
            'title' => fake()->word(),
            'slug' => fake()->unique()->slug(),
            'content' => fake()->paragraph,
            'banner' => fake()->imageUrl(640, 480),
        ];
    }
}
