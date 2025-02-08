<?php

namespace App\Http\Controllers;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function index(Request $request)
{
    $query = Location::query();

    // فلترة بالاسم
    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // فلترة بالوصف
    if ($request->has('description') && $request->description != '') {
        $query->where('description', 'like', '%' . $request->description . '%');
    }

    $locations = $query->get();

    return view('admin.locations.index', compact('locations'));
}
    /*
    public function index()
    {
        $locations = Location::get();
        return view('admin.locations.index', compact('locations'));
    }
*/
    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations,name',
            'description' => 'nullable|string'
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')->with('success', 'Location added successfully.');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|unique:locations,name,' . $location->id,
            'description' => 'nullable|string'
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
