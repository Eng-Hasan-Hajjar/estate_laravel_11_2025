<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
class PropertyController extends Controller
{
    public function index()
    {
        //$comments = Comment::where('property_id', $propertyId)->get();
        $properties = Property::with('images')->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }
    public function index_web()
{  $properties = Property::with('images')->paginate(10);
   // $properties = Property::latest()->get(); // جلب جميع العقارات وترتيبها من الأحدث
    return view('website.index', compact('properties'));
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

    // التحقق من الحقول المطلوبة مع رسائل مخصصة
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric|max:999999999999999',
        'type' => 'required',
        'location' => 'required|max:255',
        'area' => 'required|numeric',
        'num_bedrooms' => 'required|integer',
        'num_bathrooms' => 'required|integer',
        'status' => 'required',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        // رسائل مخصصة لكل حقل
        'title.required' => 'The title field is required.',
        'title.max' => 'The title must not exceed 255 characters.',
        'description.required' => 'The description field is required.',
        'price.required' => 'The price field is required.',
        'price.numeric' => 'The price must be a number.',
        'price.max' => 'The price exceeds the allowed range.',
        'type.required' => 'The type field is required.',
        'location.required' => 'The location field is required.',
        'location.max' => 'The location must not exceed 255 characters.',
        'area.required' => 'The area field is required.',
        'area.numeric' => 'The area must be a number.',
        'num_bedrooms.required' => 'The number of bedrooms field is required.',
        'num_bedrooms.integer' => 'The number of bedrooms must be an integer.',
        'num_bathrooms.required' => 'The number of bathrooms field is required.',
        'num_bathrooms.integer' => 'The number of bathrooms must be an integer.',
        'status.required' => 'The status field is required.',
        'main_image.image' => 'The main image must be an image file.',
        'main_image.mimes' => 'The main image must be in jpeg, png, or jpg format.',
        'main_image.max' => 'The main image size must not exceed 2MB.',
    ]);

    // إضافة user_id إلى البيانات للتحقق من ارتباط العقار بالمستخدم الحالي
    $validatedData['user_id'] = Auth::id(); // تأكد من أن المستخدم مسجل دخول

    try {
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
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('error', 'An unexpected error occurred while creating the property. Please try again.');
    }
}


    

public function show(Property $property)
{
    // تحميل الصورة الرئيسية والصور الأخرى للعقار
    $property->load('mainImage', 'images');
   // dd($property->mainImage->image_url);
    // استخدام الـ property->id بدلاً من $propertyId
    $comments = Comment::where('property_id', $property->id)->get();

    // تمرير الـ property والـ comments إلى الـ View
    return view('admin.properties.show', compact('property', 'comments'));
}

public function show_web($id)
{
    $property = Property::with('mainImage')->findOrFail($id);
    return view('website.pages.property-list-single', compact('property'));
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
        ], [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'type.required' => 'The type field is required.',
            'location.required' => 'The location field is required.',
            'location.max' => 'The location must not exceed 255 characters.',
            'area.required' => 'The area field is required.',
            'area.numeric' => 'The area must be a numeric value.',
            'num_bedrooms.required' => 'The number of bedrooms field is required.',
            'num_bedrooms.integer' => 'The number of bedrooms must be an integer.',
            'num_bathrooms.required' => 'The number of bathrooms field is required.',
            'num_bathrooms.integer' => 'The number of bathrooms must be an integer.',
            'status.required' => 'The status field is required.'
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


    public function filterweb(Request $request)
    {
        //dd($request); // لاختبار وصول البيانات

        $query = Property::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $properties = $query->paginate(10);

        return view('website.index', compact('properties'));
    }

}
