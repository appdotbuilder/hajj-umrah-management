<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePilgrimRequest;
use App\Http\Requests\UpdatePilgrimRequest;
use App\Models\Pilgrim;
use Inertia\Inertia;

class PilgrimController extends Controller
{
    /**
     * Display a listing of the pilgrims.
     */
    public function index()
    {
        $pilgrims = Pilgrim::with('bookings')
            ->latest()
            ->paginate(10);

        return Inertia::render('pilgrims/index', [
            'pilgrims' => $pilgrims,
        ]);
    }

    /**
     * Show the form for creating a new pilgrim.
     */
    public function create()
    {
        return Inertia::render('pilgrims/create');
    }

    /**
     * Store a newly created pilgrim.
     */
    public function store(StorePilgrimRequest $request)
    {
        Pilgrim::create($request->validated());

        return redirect()->route('pilgrims.index')
            ->with('success', 'Pilgrim created successfully.');
    }

    /**
     * Display the specified pilgrim.
     */
    public function show(Pilgrim $pilgrim)
    {
        $pilgrim->load(['bookings.package', 'bookings.payments']);

        return Inertia::render('pilgrims/show', [
            'pilgrim' => $pilgrim,
        ]);
    }

    /**
     * Show the form for editing the specified pilgrim.
     */
    public function edit(Pilgrim $pilgrim)
    {
        return Inertia::render('pilgrims/edit', [
            'pilgrim' => $pilgrim,
        ]);
    }

    /**
     * Update the specified pilgrim.
     */
    public function update(UpdatePilgrimRequest $request, Pilgrim $pilgrim)
    {
        $pilgrim->update($request->validated());

        return redirect()->route('pilgrims.show', $pilgrim)
            ->with('success', 'Pilgrim updated successfully.');
    }

    /**
     * Remove the specified pilgrim.
     */
    public function destroy(Pilgrim $pilgrim)
    {
        $pilgrim->delete();

        return redirect()->route('pilgrims.index')
            ->with('success', 'Pilgrim deleted successfully.');
    }
}