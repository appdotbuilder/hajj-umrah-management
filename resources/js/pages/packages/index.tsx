import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppContent } from '@/components/app-content';
import { AppShell } from '@/components/app-shell';
import { AppSidebar } from '@/components/app-sidebar';
import { Button } from '@/components/ui/button';
import { SidebarInset } from '@/components/ui/sidebar';

interface PackageType {
    id: number;
    name: string;
    type: string;
}

interface Package {
    id: number;
    name: string;
    price: number;
    duration_days: number;
    start_date: string;
    end_date: string;
    capacity: number;
    available_slots: number;
    status: string;
    package_type: PackageType;
}

interface PaginationData {
    data: Package[];
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
    meta: {
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
}

interface Props {
    packages: PaginationData;
    [key: string]: unknown;
}

export default function PackagesIndex({ packages }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(amount);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    };

    return (
        <AppShell variant="sidebar">
            <Head title="Packages - Hajj & Umrah Travel" />
            <AppSidebar />
            <SidebarInset>
                <AppContent>
                    <div className="p-6 space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                            <span className="text-4xl">📦</span>
                            Travel Packages
                        </h1>
                        <p className="text-gray-600 dark:text-gray-400 mt-1">
                            Manage Hajj and Umrah packages
                        </p>
                    </div>
                    
                    <Link href="/packages/create">
                        <Button className="flex items-center gap-2">
                            <span>➕</span>
                            Add New Package
                        </Button>
                    </Link>
                </div>

                {/* Packages Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {packages.data.map((pkg) => (
                        <div key={pkg.id} className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                            {/* Package Header */}
                            <div className={`p-4 ${pkg.package_type.type === 'hajj' ? 'bg-green-50 dark:bg-green-900/20' : 'bg-purple-50 dark:bg-purple-900/20'}`}>
                                <div className="flex items-center justify-between">
                                    <div className="flex items-center gap-2">
                                        <span className="text-2xl">
                                            {pkg.package_type.type === 'hajj' ? '🕋' : '🌙'}
                                        </span>
                                        <span className={`text-sm font-medium px-2 py-1 rounded-full ${
                                            pkg.package_type.type === 'hajj' 
                                                ? 'bg-green-200 text-green-800 dark:bg-green-800 dark:text-green-200'
                                                : 'bg-purple-200 text-purple-800 dark:bg-purple-800 dark:text-purple-200'
                                        }`}>
                                            {pkg.package_type.name}
                                        </span>
                                    </div>
                                    
                                    <span className={`px-2 py-1 text-xs font-semibold rounded-full ${
                                        pkg.status === 'active'
                                            ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                            : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
                                    }`}>
                                        {pkg.status}
                                    </span>
                                </div>
                            </div>

                            {/* Package Content */}
                            <div className="p-6">
                                <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    {pkg.name}
                                </h3>

                                <div className="space-y-3 mb-4">
                                    <div className="flex items-center justify-between">
                                        <span className="text-gray-600 dark:text-gray-400">Price:</span>
                                        <span className="font-bold text-green-600 text-lg">
                                            {formatCurrency(pkg.price)}
                                        </span>
                                    </div>
                                    
                                    <div className="flex items-center justify-between">
                                        <span className="text-gray-600 dark:text-gray-400">Duration:</span>
                                        <span className="font-medium text-gray-900 dark:text-white">
                                            {pkg.duration_days} days
                                        </span>
                                    </div>
                                    
                                    <div className="flex items-center justify-between">
                                        <span className="text-gray-600 dark:text-gray-400">Availability:</span>
                                        <span className="font-medium text-gray-900 dark:text-white">
                                            {pkg.available_slots} / {pkg.capacity}
                                        </span>
                                    </div>
                                    
                                    <div className="flex items-center justify-between">
                                        <span className="text-gray-600 dark:text-gray-400">Dates:</span>
                                        <div className="text-right text-sm">
                                            <div className="font-medium text-gray-900 dark:text-white">
                                                {formatDate(pkg.start_date)}
                                            </div>
                                            <div className="text-gray-500 dark:text-gray-400">
                                                to {formatDate(pkg.end_date)}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* Actions */}
                                <div className="flex gap-2">
                                    <Link href={`/packages/${pkg.id}`} className="flex-1">
                                        <Button variant="outline" size="sm" className="w-full">
                                            View Details
                                        </Button>
                                    </Link>
                                    <Link href={`/packages/${pkg.id}/edit`} className="flex-1">
                                        <Button size="sm" className="w-full">
                                            Edit
                                        </Button>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Empty State */}
                {packages.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">📦</div>
                        <h3 className="text-xl font-medium text-gray-900 dark:text-white mb-2">
                            No packages yet
                        </h3>
                        <p className="text-gray-600 dark:text-gray-400 mb-6">
                            Start by creating your first Hajj or Umrah package.
                        </p>
                        <Link href="/packages/create">
                            <Button>Create Your First Package</Button>
                        </Link>
                    </div>
                )}
                    </div>
                </AppContent>
            </SidebarInset>
        </AppShell>
    );
}