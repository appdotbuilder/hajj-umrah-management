<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\Pilgrim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalAmount = fake()->randomFloat(2, 2000, 12000);
        $paidAmount = fake()->randomFloat(2, 0, $totalAmount);
        $remainingAmount = $totalAmount - $paidAmount;
        
        $paymentStatus = 'pending';
        if ($paidAmount >= $totalAmount) {
            $paymentStatus = 'paid';
            $remainingAmount = 0;
        } elseif ($paidAmount > 0) {
            $paymentStatus = 'partial';
        }
        
        return [
            'booking_number' => 'BK-' . fake()->unique()->numerify('######'),
            'package_id' => Package::factory(),
            'pilgrim_id' => Pilgrim::factory(),
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'remaining_amount' => $remainingAmount,
            'payment_status' => $paymentStatus,
            'booking_status' => fake()->randomElement(['confirmed', 'cancelled']),
            'booking_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}