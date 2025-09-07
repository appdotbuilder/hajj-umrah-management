<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelSetting>
 */
class TravelSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'travel_name' => 'Al-Haramain Travel & Tours',
            'travel_address' => fake()->address(),
            'travel_email' => 'info@haramain-travel.com',
            'travel_phone' => fake()->phoneNumber(),
        ];
    }
}