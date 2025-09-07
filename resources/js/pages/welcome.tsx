import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface Props {
    canLogin: boolean;
    canRegister: boolean;
    [key: string]: unknown;
}

export default function Welcome({ canLogin, canRegister }: Props) {
    return (
        <>
            <Head title="Hajj & Umrah Travel Management" />
            
            <div className="min-h-screen bg-gradient-to-br from-purple-900 via-purple-700 to-indigo-800">
                {/* Navigation */}
                <nav className="relative p-6 flex justify-between items-center">
                    <div className="flex items-center space-x-3">
                        <div className="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <span className="text-2xl">🕌</span>
                        </div>
                        <h1 className="text-white text-xl font-bold">Travel Manager</h1>
                    </div>
                    
                    {(canLogin || canRegister) && (
                        <div className="space-x-4">
                            {canLogin && (
                                <Link href="/login">
                                    <Button variant="outline" className="bg-white/10 border-white/20 text-white hover:bg-white/20">
                                        Login
                                    </Button>
                                </Link>
                            )}
                            {canRegister && (
                                <Link href="/register">
                                    <Button className="bg-white text-purple-900 hover:bg-gray-100">
                                        Register
                                    </Button>
                                </Link>
                            )}
                        </div>
                    )}
                </nav>

                {/* Hero Section */}
                <div className="px-6 py-16 text-center text-white">
                    <div className="max-w-4xl mx-auto">
                        <h2 className="text-5xl md:text-6xl font-bold mb-6">
                            🕋 Hajj & Umrah
                            <br />
                            <span className="bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                                Travel Management
                            </span>
                        </h2>
                        
                        <p className="text-xl md:text-2xl text-purple-100 mb-12 leading-relaxed">
                            Complete solution for managing pilgrimage packages, pilgrims, bookings, and financial reports. 
                            Streamline your travel business with professional tools.
                        </p>

                        {/* Feature Highlights */}
                        <div className="grid md:grid-cols-3 gap-8 mb-16">
                            <div className="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20">
                                <div className="text-4xl mb-4">📊</div>
                                <h3 className="text-xl font-semibold mb-3">Smart Dashboard</h3>
                                <p className="text-purple-100">Real-time analytics, sales trends, and payment tracking</p>
                            </div>
                            
                            <div className="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20">
                                <div className="text-4xl mb-4">📦</div>
                                <h3 className="text-xl font-semibold mb-3">Package Management</h3>
                                <p className="text-purple-100">Hajj & Umrah packages with schedules and bookings</p>
                            </div>
                            
                            <div className="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20">
                                <div className="text-4xl mb-4">👥</div>
                                <h3 className="text-xl font-semibold mb-3">Pilgrim Database</h3>
                                <p className="text-purple-100">Complete pilgrim profiles with documents and medical info</p>
                            </div>
                        </div>

                        {/* Key Features */}
                        <div className="bg-white/5 backdrop-blur rounded-2xl p-8 mb-16 border border-white/10">
                            <h3 className="text-3xl font-bold mb-8">✨ Comprehensive Features</h3>
                            
                            <div className="grid md:grid-cols-2 gap-6 text-left">
                                <div className="space-y-4">
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Dashboard with sales analytics</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Hajj & Umrah package management</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Land Arrangement (LA) calculator</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Inventory management system</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Complete accounting module</span>
                                    </div>
                                </div>
                                
                                <div className="space-y-4">
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Pilgrim & partner management</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Financial reports (PDF/Excel)</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Multi-user with role permissions</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>3 beautiful color themes</span>
                                    </div>
                                    <div className="flex items-center space-x-3">
                                        <span className="text-green-400">✅</span>
                                        <span>Mobile responsive design</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Call to Action */}
                        <div className="space-y-6">
                            <h3 className="text-2xl font-semibold">Ready to manage your travel business?</h3>
                            
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                {canRegister && (
                                    <Link href="/register">
                                        <Button size="lg" className="bg-gradient-to-r from-yellow-400 to-orange-500 text-black font-semibold hover:from-yellow-500 hover:to-orange-600 px-8 py-4 text-lg">
                                            🚀 Get Started Free
                                        </Button>
                                    </Link>
                                )}
                                
                                {canLogin && (
                                    <Link href="/login">
                                        <Button size="lg" variant="outline" className="bg-white/10 border-white/30 text-white hover:bg-white/20 px-8 py-4 text-lg">
                                            👤 Login to Dashboard
                                        </Button>
                                    </Link>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <div className="text-center py-8 text-purple-200 border-t border-white/10">
                    <p>&copy; 2024 Hajj & Umrah Travel Management. Built with Laravel & React.</p>
                </div>
            </div>
        </>
    );
}