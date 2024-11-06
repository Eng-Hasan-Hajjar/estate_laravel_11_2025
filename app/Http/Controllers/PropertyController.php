<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }
    public function store(Request $request)
    {


           // التحقق من أن المستخدم مسجل دخول
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to create a property.');
    }

        // التحقق من الحقول المطلوبة
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'location' => 'required|max:255',
            'area' => 'required|numeric',
            'num_bedrooms' => 'required|integer',
            'num_bathrooms' => 'required|integer',
            'status' => 'required',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // للتحقق من الصورة
        ]);
    
        // إضافة user_id إلى البيانات للتحقق من ارتباط العقار بالمستخدم الحالي
        $validatedData['user_id'] = Auth::id(); // تأكد من أن المستخدم مسجل دخول
  
        // إنشاء سجل العقار
        $property = Property::create($validatedData);
    
        // التحقق من رفع الصورة وتخزينها
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('property_images', 'public');
            
            // إنشاء سجل للصورة المرتبطة
            PropertyImage::create([
                'property_id' => $property->id,
                'image_url' => $path,
                'is_primary' => true
            ]);
        }
    
        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    

    public function show(Property $property)
    {
        $property->load('mainImage', 'images');
        return view('admin.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'location' => 'required|max:255',
            'area' => 'required|numeric',
            'num_bedrooms' => 'required|integer',
            'num_bathrooms' => 'required|integer',
            'status' => 'required'
        ]);

        $property->update($validatedData);

        // تحديث الصورة إن وُجدت
        if ($request->hasFile('main_image')) {
            // حذف الصورة السابقة
            if ($property->images()->where('is_primary', true)->exists()) {
                $existingImage = $property->images()->where('is_primary', true)->first();
                Storage::disk('public')->delete($existingImage->image_url);
                $existingImage->delete();
            }

            // تخزين الصورة الجديدة
            $path = $request->file('main_image')->store('property_images', 'public');
            PropertyImage::create([
                'property_id' => $property->id,
                'image_url' => $path,
                'is_primary' => true
            ]);
        }

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
  
    }

    public function destroy(Property $property)
    {
               // حذف الصور المرتبطة
               foreach ($property->images as $image) {
                Storage::disk('public')->delete($image->image_url);
                $image->delete();
            }
    
            $property->delete();
            return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
     
    }



    public function propertyList()
    {
        $properties = Property::with('images')->paginate(10);
        return view('website.pages.property-list', compact('properties'));
    }

    public function filter(Request $request)
    {
        // تعريف متغير `query` لبدء إنشاء الاستعلام.
        $query = Property::with('images');

        // فلترة حسب الموقع
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // فلترة حسب السعر
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // فلترة حسب النوع
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // فلترة حسب عدد الغرف
        if ($request->filled('num_bedrooms')) {
            $query->where('num_bedrooms', '>=', $request->num_bedrooms);
        }

        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // تنفيذ الاستعلام وجلب النتائج مع التصفح
        $properties = $query->paginate(10);

        return view('admin.properties.index', compact('properties'));
    }

}
