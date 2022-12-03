<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title' => strtolower(fake()->sentence(rand(1, 3))),
            'isbn_code' => fake()->numberBetween(100, 999) . '-' .
                fake()->numberBetween(100, 999) . '-' .
                fake()->numberBetween(1000, 9999) . '-' .
                fake()->numberBetween(10, 99) . '-' .
                fake()->numberBetween(0, 9),
            'publication_year' => fake()->numberBetween(1985, 2022),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }
}
