<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    public function index(Property $property)
    {
        $images = $property->images;
        return view('admin.property-images.index', compact('property', 'images'));
    }

    public function create(Property $property)
    {
   
        return view('admin.property-images.create', compact('property'));
    }

    public function store(Request $request, Property $property)
    {
       
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_primary' => 'boolean'
        ]);
    
        $path = $request->file('image')->store('property_images', 'public');

        $property->images()->create([
            'image_url' => $path,
            'is_primary' => $request->is_primary ?? false
        ]);
       // dd($property);
        return redirect()->route('properties.index')->with('success', 'Image added successfully.');
    }

    public function edit(Property $property, PropertyImage $propertyImage)
    {
        return view('admin.property-images.edit', compact('property', 'propertyImage'));
    }

    public function update(Request $request, Property $property, PropertyImage $propertyImage)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_primary' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($propertyImage->image_url);
            $path = $request->file('image')->store('property_images', 'public');
            $propertyImage->image_url = $path;
        }

        $propertyImage->is_primary = $request->is_primary ?? false;
        $propertyImage->save();

        return redirect()->route('properties.property-images.index', ['property' => $property->id])->with('success', 'Image updated successfully.');
    }

    public function destroy(Property $property, PropertyImage $propertyImage)
    {
        Storage::disk('public')->delete($propertyImage->image_url);
        $propertyImage->delete();

        return redirect()->route('properties.property-images.index', ['property' => $property->id])->with('success', 'Image deleted successfully.');
    }
}
