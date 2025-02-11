<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PropertyType;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PropertyController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $this->authorize('viewAny', Property::class);
        $query = Property::query();
    
        // فلترة بالموقع (location_id)
        if ($request->has('location_id') && $request->location_id != '') {
            $query->where('location_id', $request->location_id);
        }
    
        // فلترة بنوع العقار (property_type_id)
        if ($request->has('property_type_id') && $request->property_type_id != '') {
            $query->where('property_type_id', $request->property_type_id);
        }
    
        // فلترة بالسعر (price)
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
    
        // فلترة بعدد الغرف (num_bedrooms)
        if ($request->has('num_bedrooms') && $request->num_bedrooms != '') {
            $query->where('num_bedrooms', $request->num_bedrooms);
        }
    
        // فلترة بعدد الحمامات (num_bathrooms)
        if ($request->has('num_bathrooms') && $request->num_bathrooms != '') {
            $query->where('num_bathrooms', $request->num_bathrooms);
        }
    
        // فلترة بالاتجاهات (directions)
        if ($request->has('directions') && $request->directions != '') {
            $query->where('directions', 'like', '%' . $request->directions . '%');
        }
    
        // فلترة بالحالة (status)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
    
        // جلب البيانات مع التقسيم (Pagination)
        $properties = $query->with(['images', 'location'])->paginate(10);
        $locations = Location::all(); // للحصول على قائمة المواقع لعرضها في الفلترة
        $propertyTypes = PropertyType::all(); // للحصول على قائمة أنواع العقارات لعرضها في الفلترة
    
        return view('admin.properties.index', compact('properties', 'locations', 'propertyTypes'));
    }
    /*
    public function index()
    {
        //$comments = Comment::where('property_id', $propertyId)->get();
        $locations=Location::all();
        $properties = Property::with(['images', 'location'])->paginate(10);
        return view('admin.properties.index', compact('properties','locations'));
    }

    */
    public function index_web()
    { 
        $locations = Location::all();
        $propertyTypes = PropertyType::withCount('properties')->get(); // جلب الأنواع مع عدد العقارات
        $properties = Property::with('images')->paginate(10);
    
        return view('website.index', compact('properties', 'propertyTypes', 'locations'));
      
    }
    public function create()
    {
        $this->authorize('create', Property::class);
       
        $locations=Location::with('regions')->get();
        $regions=Region::all();
        $propertyTypes = PropertyType::all(); // جلب جميع أنواع العقارات
        return view('admin.properties.create', compact('regions','propertyTypes','locations'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Property::class);
        // التحقق من أن المستخدم مسجل دخول
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a property.');
        }
        // التحقق من الحقول المطلوبة مع رسائل مخصصة
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|max:999999999999999',
            'currency' => 'required|string|max:10', // التحقق من العملة
            'property_type_id' => 'required|exists:property_types,id',
            'location_id' => 'required|exists:locations,id',
            'area' => 'required|numeric',
            'num_bedrooms' => 'required|integer',
            'num_bathrooms' => 'required|integer',
            'status' => 'required',
            'num_balconies' => 'nullable|integer|min:0',
            'is_furnished' => 'nullable|boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'directions' => 'nullable|array',
            'directions.*' => 'in:north,south,east,west',
            'region_id' => 'required|exists:regions,id',
        ], [
            // رسائل مخصصة لكل حقل
            'title.required' => 'The title field is required.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.max' => 'The price exceeds the allowed range.',
            'property_type_id.required' => 'The type field is required.',
            'region_id.required' => 'The region field is required.',
            'location_id.required' => 'The location field is required.',
            'location_id.max' => 'The location must not exceed 255 characters.',
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
            'directions.array' => 'الاتجاهات يجب أن تكون قائمة من القيم.',
            'directions.*.in' => 'الاتجاه المحدد غير صالح.',
            'num_balconies.integer' => 'عدد الشرفات يجب أن يكون رقمًا صحيحًا.',
            'is_furnished.boolean' => 'يجب أن تكون القيمة إما نعم أو لا.',
        ]);
        //dd($request);
        // تحويل الاتجاهات إلى نص إذا تم تحديدها
        if ($request->has('directions')) {
            $validatedData['directions'] = implode(',', $request->directions);
        } else {
            $validatedData['directions'] = null;
        }

        /*
        $validatedData['region_id'] = 'region_id'; 
        $validatedData['location_id'] = 'location_id'; 
        $validatedData['property_type_id'] = 'property_type_id'; 



        */
        $validatedData['region_id'] = $request->region_id;
        $validatedData['location_id'] = $request->location_id;
        $validatedData['property_type_id'] = $request->property_type_id;
        // إضافة user_id إلى البيانات للتحقق من ارتباط العقار بالمستخدم الحالي
        $validatedData['user_id'] = Auth::id(); // تأكد من أن المستخدم مسجل دخول
        //dd($validatedData);
        try {
            // إنشاء سجل العقار
            $property = Property::create($validatedData);
        //dd($property);
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
        $this->authorize('view', $property);
        // تحميل الصورة الرئيسية والصور الأخرى للعقار
        $property->load('mainImage', 'images', 'location.region', 'propertyType', 'location.region');
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
        $this->authorize('update', $property);
        $locations=Location::all();
        $propertyTypes = PropertyType::all();
        return view('admin.properties.edit', compact('property', 'propertyTypes','locations'));
    }
    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:10',
            'property_type_id' => 'required',
            'location_id' => 'required',
            'area' => 'required|numeric',
            'num_bedrooms' => 'required|integer',
            'num_bathrooms' => 'required|integer',
            'status' => 'required',
            'directions' => 'nullable|array',
            'directions.*' => 'in:north,south,east,west',
            'num_balconies' => 'nullable|integer|min:0',
            'is_furnished' => 'nullable|boolean',
        ], [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'property_type_id.required' => 'The type field is required.',
            'location_id.required' => 'The location field is required.',
            'location_id.max' => 'The location must not exceed 255 characters.',
            'area.required' => 'The area field is required.',
            'area.numeric' => 'The area must be a numeric value.',
            'num_bedrooms.required' => 'The number of bedrooms field is required.',
            'num_bedrooms.integer' => 'The number of bedrooms must be an integer.',
            'num_bathrooms.required' => 'The number of bathrooms field is required.',
            'num_bathrooms.integer' => 'The number of bathrooms must be an integer.',
            'directions.array' => 'الاتجاهات يجب أن تكون قائمة من القيم.',
            'directions.*.in' => 'الاتجاه المحدد غير صالح.',
            'num_balconies.integer' => 'عدد الشرفات يجب أن يكون رقمًا صحيحًا.',
            'is_furnished.boolean' => 'يجب أن تكون القيمة إما نعم أو لا.',
            'status.required' => 'The status field is required.'
        ]);
      // تحويل الاتجاهات إلى نص إذا تم تحديدها
        if ($request->has('directions')) {
            $validatedData['directions'] = implode(',', $request->directions);
        } else {
            $validatedData['directions'] = null;
        }

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
        $this->authorize('delete', $property);
               // حذف الصور المرتبطة
               foreach ($property->images as $image) {
                Storage::disk('public')->delete($image->image_url);
                $image->delete();
            }
            $property->delete();
            return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
     
    }
    //websitess
    public function filterweb(Request $request)
    {
        //dd($request); // لاختبار وصول البيانات
        $query = Property::query();
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }
        // فلترة بالموقع (location_id)
        if ($request->has('location_id') && $request->location_id != '') {
            $query->where('location_id', $request->location_id);
        }
        // فلترة بنوع العقار (property_type_id)
        if ($request->has('property_type_id') && $request->property_type_id != '') {
            $query->where('property_type_id', $request->property_type_id);
        }
        $locations=Location::all();
        $propertyTypes = PropertyType::all();
        $properties = $query->with(['images', 'location','propertyType'])->paginate(10);
       // $properties = $query->paginate(10);
        return view('website.index', compact('properties','propertyTypes','locations'));
    }
    public function filter(Request $request)
    {
        // إنشاء الاستعلام مع تحميل الصور
        $query = Property::with('images');
        // فلترة بالموقع
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        // فلترة بنوع العقار
        if ($request->filled('property_type_id')) {
            $query->where('property_type_id', $request->property_type_id);
        }
        // فلترة حسب السعر
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        // فلترة حسب عدد الغرف
        if ($request->filled('num_bedrooms')) {
            $query->where('num_bedrooms', '>=', $request->num_bedrooms);
        }
        // فلترة حسب الحالة (للبيع أو للإيجار)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        // تنفيذ الاستعلام وجلب النتائج مع التصفح
        $properties = $query->paginate(10);
        // إرسال القيم المحددة مع العرض للحفاظ على القيم المحددة في النموذج
        return view('website.properties', compact('properties'))->with($request->all());
    }
    public function propertyList()
    {
        $query = Property::with('images');
        $properties = $query->with(['images', 'location','propertyType'])->paginate(10);
        $locations=Location::all();
        $propertyTypes = PropertyType::withCount('properties')->get();
        return view('website.pages.property-list', compact('properties','locations','propertyTypes'));
    }
    public function propertyTypeList()
    {
        $query = Property::with('images');
        $locations=Location::all();
        $propertyTypes = PropertyType::withCount('properties')->get();
        $properties = $query->with(['images', 'location','propertyType'])->paginate(10);
        return view('website.pages.property-type', compact('properties','propertyTypes','locations'));
    }
    public function propertyTypeSingle()
    {
        $query = Property::with('images');
        $properties = $query->with(['images', 'location','propertyType'])->paginate(10);
        $locations=Location::all();
        $propertyTypes = PropertyType::withCount('properties')->get();
        return view('website.pages.property-type-single', compact('properties','propertyTypes','locations'));
    }
}
