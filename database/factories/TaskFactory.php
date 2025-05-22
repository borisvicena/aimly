<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goal_id' => \App\Models\Goal::factory(), // Create a new Goal for each Task
            'title' => fake()->sentence(),
            'due_date' => fake()->dateTimeBetween('now', '+1 year'),
            'status' => fake()->randomElement(['in_progress', 'completed', 'overdue']),
        ];
    }
}
