<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'status'=> $this->faker->randomElement(['active', 'pending', 'inactive']),
            'description' => $this->faker->text,
            'isCompleted' => $this->faker->randomElement(['soon', 'completed', 'completing']),
            'price' => 50000,
            'user_id' => User::query()->inRandomOrder()->first(),
            'image' =>'defaultImage.png',
            'introduction' => $this->faker->text(200),
        ];
    }
}
