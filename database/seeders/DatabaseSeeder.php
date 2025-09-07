<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Package;
use App\Models\PackageType;
use App\Models\Payment;
use App\Models\Pilgrim;
use App\Models\TravelSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users with different roles
        User::factory()->create([
            'name' => 'Owner User',
            'email' => 'owner@haramain.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'theme' => 'purple',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@haramain.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'theme' => 'green',
        ]);

        // Create travel settings
        TravelSetting::factory()->create();

        // Create package types
        $hajjTypes = PackageType::factory()->count(3)->create(['type' => 'hajj']);
        $umrahTypes = PackageType::factory()->count(3)->create(['type' => 'umrah']);

        // Create packages
        $packages = Package::factory()->count(12)->create();

        // Create pilgrims
        $pilgrims = Pilgrim::factory()->count(50)->create();

        // Create bookings with realistic relationships
        $bookings = collect();
        for ($i = 0; $i < 30; $i++) {
            $package = $packages->random();
            $pilgrim = $pilgrims->random();
            
            $booking = Booking::factory()->create([
                'package_id' => $package->id,
                'pilgrim_id' => $pilgrim->id,
            ]);
            
            $bookings->push($booking);
        }

        // Create payments for some bookings
        $bookings->where('payment_status', '!=', 'pending')->each(function ($booking) {
            Payment::factory()->create([
                'booking_id' => $booking->id,
                'amount' => $booking->paid_amount,
            ]);
        });
    }
}
