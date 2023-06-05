<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
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
            'name' => fake()->bothify('Task ##??'),
            'description' => fake()->text(),
            'priority' => fake()->numberBetween($min = 1, $max = 3),
            'status_id' => fake()->numberBetween($min = 1, $max = 3),
            'start_date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+3 days', $timezone = null),
            'final_date' => fake()->dateTimeBetween($startDate = '+3 days', $endDate = '+30 days', $timezone = null),
            'user_id' => User::all()->random()->id,
            'project_id' => Project::all()->random()->id,
        ];
    }
}
