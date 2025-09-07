import React from 'react';
import { Head } from '@inertiajs/react';
import { AppContent } from '@/components/app-content';
import { AppShell } from '@/components/app-shell';
import { AppSidebar } from '@/components/app-sidebar';
import { SidebarInset } from '@/components/ui/sidebar';

interface SalesTrend {
    month: string;
    total_sales: number;
    bookings_count: number;
}

interface PackageDistribution {
    type_name: string;
    type: string;
    booking_count: number;
    total_revenue: number;
}

interface UnpaidPilgrim {
    id: number;
    booking_number: string;
    pilgrim: {
        full_name: string;
        email: string;
    };
    package: {
        name: string;
    };
    remaining_amount: number;
    payment_status: string;
}

interface DashboardStats {
    total_pilgrims: number;
    active_packages: number;
    pending_payments: number;
    this_month_revenue: number;
}

interface Props {
    salesTrend: SalesTrend[];
    packageDistribution: PackageDistribution[];
    unpaidPilgrims: UnpaidPilgrim[];
    stats: DashboardStats;
    [key: string]: unknown;
}

export default function Dashboard({ salesTrend, packageDistribution, unpaidPilgrims, stats }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(amount);
    };

    const formatMonth = (monthString: string) => {
        const date = new Date(monthString + '-01');
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short' });
    };

    return (
        <AppShell variant="sidebar">
            <Head title="Dashboard - Hajj & Umrah Travel" />
            <AppSidebar />
            <SidebarInset>
                <AppContent>
                    <div className="p-6 space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                            <span className="text-4xl">📊</span>
                            Travel Dashboard
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Overview of your Hajj & Umrah travel business
                        </p>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pilgrims</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.total_pilgrims}</p>
                            </div>
                            <div className="text-4xl">👥</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Active Packages</p>
                                <p className="text-3xl font-bold text-gray-900 dark:text-white">{stats.active_packages}</p>
                            </div>
                            <div className="text-4xl">📦</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">Pending Payments</p>
                                <p className="text-3xl font-bold text-red-600">{formatCurrency(stats.pending_payments)}</p>
                            </div>
                            <div className="text-4xl">💰</div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600 dark:text-gray-400">This Month Revenue</p>
                                <p className="text-3xl font-bold text-green-600">{formatCurrency(stats.this_month_revenue)}</p>
                            </div>
                            <div className="text-4xl">📈</div>
                        </div>
                    </div>
                </div>

                {/* Charts Section */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {/* Sales Trend */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                            <span className="text-2xl">📈</span>
                            Sales Trend (Last 12 Months)
                        </h3>
                        
                        <div className="space-y-4">
                            {salesTrend.length > 0 ? (
                                salesTrend.map((item, index) => (
                                    <div key={index} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div>
                                            <p className="font-medium text-gray-900 dark:text-white">{formatMonth(item.month)}</p>
                                            <p className="text-sm text-gray-600 dark:text-gray-400">{item.bookings_count} bookings</p>
                                        </div>
                                        <div className="text-right">
                                            <p className="font-bold text-green-600">{formatCurrency(item.total_sales)}</p>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-8">No sales data available</p>
                            )}
                        </div>
                    </div>

                    {/* Package Distribution */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                            <span className="text-2xl">📊</span>
                            Package Distribution
                        </h3>
                        
                        <div className="space-y-4">
                            {packageDistribution.length > 0 ? (
                                packageDistribution.map((item, index) => (
                                    <div key={index} className="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div className="flex items-center gap-3">
                                            <div className="text-2xl">{item.type === 'hajj' ? '🕋' : '🌙'}</div>
                                            <div>
                                                <p className="font-medium text-gray-900 dark:text-white">{item.type_name}</p>
                                                <p className="text-sm text-gray-600 dark:text-gray-400">{item.booking_count} bookings</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <p className="font-bold text-blue-600">{formatCurrency(item.total_revenue)}</p>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 dark:text-gray-400 text-center py-8">No package data available</p>
                            )}
                        </div>
                    </div>
                </div>

                {/* Unpaid Pilgrims Table */}
                <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <span className="text-2xl">⚠️</span>
                            Pilgrims with Outstanding Payments
                        </h3>
                        <p className="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Bookings that require payment follow-up
                        </p>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="w-full">
                            <thead className="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Booking
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Pilgrim
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Package
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Outstanding Amount
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 dark:divide-gray-600">
                                {unpaidPilgrims.length > 0 ? (
                                    unpaidPilgrims.map((booking) => (
                                        <tr key={booking.id} className="hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                    {booking.booking_number}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div className="text-sm font-medium text-gray-900 dark:text-white">
                                                        {booking.pilgrim.full_name}
                                                    </div>
                                                    <div className="text-sm text-gray-500 dark:text-gray-400">
                                                        {booking.pilgrim.email}
                                                    </div>
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm text-gray-900 dark:text-white">
                                                    {booking.package.name}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-bold text-red-600">
                                                    {formatCurrency(booking.remaining_amount)}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                                                    booking.payment_status === 'pending' 
                                                        ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                                        : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
                                                }`}>
                                                    {booking.payment_status === 'pending' ? '⏳ Pending' : '💳 Partial'}
                                                </span>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan={5} className="px-6 py-8 text-center">
                                            <div className="text-gray-500 dark:text-gray-400">
                                                <div className="text-6xl mb-4">🎉</div>
                                                <p className="text-lg font-medium">All payments are up to date!</p>
                                                <p className="text-sm">No outstanding payments at this time.</p>
                                            </div>
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
                    </div>
                </AppContent>
            </SidebarInset>
        </AppShell>
    );
}