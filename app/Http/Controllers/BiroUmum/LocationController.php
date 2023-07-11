<?php

namespace App\Http\Controllers\BiroUmum;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;

class LocationController extends Controller
{
    /**
     * Show list of locations.
     * 
     */
    public function index(Request $request)
    {
        $locations = QueryBuilder::for(Location::class)
            ->allowedFilters(['name'])
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->appends(request()->query());

        return view('biroumum.pages.locations.index', [
            'locations' => $locations
        ]);
    }

    /**
     * Show location creation form.
     * 
     */
    public function create(Request $request)
    {
        return view('biroumum.pages.locations.create');
    }

    /**
     * Show location creation form.
     * 
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:locations,name|max:200'
        ]);

        Location::create($validated);

        // Return success response
        return redirect()->route('biroumum.locations')->with('success', 'Lokasi berhasil dibuat.');
    }

    /**
     * Show location edit form.
     * 
     */
    public function edit(Location $location, Request $request)
    {
        return view('biroumum.pages.locations.edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update organization
     * 
     */
    public function update(Location $location, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique('locations', 'name')->ignore($location->id)]
        ]);

        // Update organization
        $location->update($validated);

        return redirect()->route('biroumum.locations')->with('success', 'Lokasi ' . $location->name . ' berhasil diupdate.');
    }

    /**
     * Delete location
     * 
     */
    public function delete(Location $location, Request $request)
    {
        // Delete location
        $location->delete();

        // Return success response
        return redirect()->route('biroumum.locations')->with('success', 'Lokasi ' . $location->name . ' berhasil dihapus.');
    }
}
