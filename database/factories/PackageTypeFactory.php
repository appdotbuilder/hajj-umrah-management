<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageType>
 */
class PackageTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['hajj', 'umrah'];
        $selectedType = fake()->randomElement($types);
        
        $names = [
            'hajj' => ['Premium Hajj', 'Standard Hajj', 'Economy Hajj', 'VIP Hajj'],
            'umrah' => ['Premium Umrah', 'Standard Umrah', 'Economy Umrah', 'Express Umrah']
        ];
        
        return [
            'name' => fake()->randomElement($names[$selectedType]),
            'type' => $selectedType,
            'description' => fake()->paragraph(),
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}