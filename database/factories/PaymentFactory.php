<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'payment_reference' => 'PAY-' . fake()->unique()->numerify('######'),
            'amount' => fake()->randomFloat(2, 100, 5000),
            'payment_method' => fake()->randomElement(['cash', 'bank_transfer', 'card', 'other']),
            'payment_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['confirmed', 'pending', 'cancelled']),
        ];
    }
}