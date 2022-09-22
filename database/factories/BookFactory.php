<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'name' => fake()->word,
            'isbn' => fake()->isbn10,
            'authors' => serialize(fake()->name),
            'number_of_pages' => fake()->numberBetween(100, 500),
            'publisher' => fake()->company,
            'release_date' => fake()->date,
            'country' => fake()->country
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        //
    }
}


