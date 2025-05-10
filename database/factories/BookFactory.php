<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'author' => $this->faker->name(),
            'published_year' => $this->faker->year(),
            'publisher' => $this->faker->company(),
            'description' => $this->faker->paragraph(2),
            'condition' => $this->faker->randomElement(['Good', 'Broken', 'In Repair']),
            // 'category_id' => Category::factory(),
            'category_id' => mt_rand(1, 3),
        ];
    }
}
