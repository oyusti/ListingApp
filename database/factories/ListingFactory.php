<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6]),
            'title' => $this->faker->sentence(10),
            'desc' => $this->faker->paragraph(12),
            'tags' => $this->faker->randomElement([
                'dev,game',
                'game',
                'biz,tech',
                'tech,game,biz'
            ]),
            'email' => $this->faker->email,
            'link' => $this->faker->url,
            'approved' => 1
        ];
    }
}
