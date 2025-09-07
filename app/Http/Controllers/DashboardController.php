<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Pilgrim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        // Sales trend data (last 12 months)
        $driverName = DB::connection()->getDriverName();
        $monthFormat = match ($driverName) {
            'mysql' => 'DATE_FORMAT(booking_date, "%Y-%m")',
            'sqlite' => "strftime('%Y-%m', booking_date)",
            'pgsql' => "to_char(booking_date, 'YYYY-MM')",
            default => "strftime('%Y-%m', booking_date)",
        };

        $salesTrend = Booking::select(
            DB::raw("{$monthFormat} as month"),
            DB::raw('SUM(total_amount) as total_sales'),
            DB::raw('COUNT(*) as bookings_count')
        )
        ->where('booking_date', '>=', now()->subMonths(12))
        ->groupBy(DB::raw($monthFormat))
        ->orderBy('month')
        ->get();

        // Package distribution
        $packageDistribution = Package::join('package_types', 'packages.package_type_id', '=', 'package_types.id')
            ->join('bookings', 'packages.id', '=', 'bookings.package_id')
            ->select(
                'package_types.name as type_name',
                'package_types.type',
                DB::raw('COUNT(bookings.id) as booking_count'),
                DB::raw('SUM(bookings.total_amount) as total_revenue')
            )
            ->groupBy('package_types.id', 'package_types.name', 'package_types.type')
            ->get();

        // Pilgrims with unpaid balances
        $unpaidPilgrims = Booking::with(['pilgrim', 'package'])
            ->where('payment_status', '!=', 'paid')
            ->orderBy('remaining_amount', 'desc')
            ->limit(10)
            ->get();

        // Dashboard stats
        $stats = [
            'total_pilgrims' => Pilgrim::count(),
            'active_packages' => Package::where('status', 'active')->count(),
            'pending_payments' => Booking::where('payment_status', '!=', 'paid')->sum('remaining_amount'),
            'this_month_revenue' => Booking::whereMonth('booking_date', now()->month)
                ->whereYear('booking_date', now()->year)
                ->sum('total_amount'),
        ];

        return Inertia::render('dashboard', [
            'salesTrend' => $salesTrend,
            'packageDistribution' => $packageDistribution,
            'unpaidPilgrims' => $unpaidPilgrims,
            'stats' => $stats,
        ]);
    }
}