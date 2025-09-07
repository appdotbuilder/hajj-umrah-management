<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'sku' => fake()->unique()->bothify('SKU-####'),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement(['Travel Gear', 'Documentation', 'Clothing', 'Electronics', 'Food']),
            'cost_price' => fake()->randomFloat(2, 5, 100),
            'selling_price' => fake()->randomFloat(2, 10, 150),
            'quantity_in_stock' => fake()->numberBetween(0, 100),
            'reorder_level' => fake()->numberBetween(5, 20),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}