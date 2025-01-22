<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with('location')->paginate(10);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.regions.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        Region::create($request->all());

        return redirect()->route('regions.index')->with('success', 'Region created successfully.');
    }

    public function edit(Region $region)
    {
        $locations = Location::all();
        return view('admin.regions.edit', compact('region', 'locations'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        $region->update($request->all());

        return redirect()->route('regions.index')->with('success', 'Region updated successfully.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Region deleted successfully.');
    }
}
