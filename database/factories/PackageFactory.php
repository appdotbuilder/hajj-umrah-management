<?php

namespace Database\Factories;

use App\Models\PackageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $duration = fake()->numberBetween(7, 21);
        $capacity = fake()->numberBetween(20, 100);
        
        return [
            'package_type_id' => PackageType::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 3000, 15000),
            'duration_days' => $duration,
            'start_date' => $startDate,
            'end_date' => (clone $startDate)->modify("+{$duration} days"),
            'capacity' => $capacity,
            'available_slots' => fake()->numberBetween(0, $capacity),
            'inclusions' => [
                'Accommodation',
                'Transportation',
                'Meals',
                'Guide Services',
                'Airport Transfers'
            ],
            'exclusions' => [
                'Personal Expenses',
                'Optional Tours',
                'Travel Insurance'
            ],
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}