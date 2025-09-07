<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use App\Models\PackageType;
use Inertia\Inertia;

class PackageController extends Controller
{
    /**
     * Display a listing of the packages.
     */
    public function index()
    {
        $packages = Package::with('packageType')
            ->latest()
            ->paginate(10);

        return Inertia::render('packages/index', [
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for creating a new package.
     */
    public function create()
    {
        $packageTypes = PackageType::active()->get();

        return Inertia::render('packages/create', [
            'packageTypes' => $packageTypes,
        ]);
    }

    /**
     * Store a newly created package.
     */
    public function store(StorePackageRequest $request)
    {
        Package::create($request->validated());

        return redirect()->route('packages.index')
            ->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified package.
     */
    public function show(Package $package)
    {
        $package->load(['packageType', 'bookings.pilgrim']);

        return Inertia::render('packages/show', [
            'package' => $package,
        ]);
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit(Package $package)
    {
        $packageTypes = PackageType::active()->get();

        return Inertia::render('packages/edit', [
            'package' => $package,
            'packageTypes' => $packageTypes,
        ]);
    }

    /**
     * Update the specified package.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->validated());

        return redirect()->route('packages.show', $package)
            ->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified package.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}