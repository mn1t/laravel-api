<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(100),
            'content' => $this->faker->realText(200),
            'created_at' => $this->faker->dateTimeThisYear(),
            'user_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
