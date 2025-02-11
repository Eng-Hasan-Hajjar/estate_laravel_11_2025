<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\Property;
class SearchController extends Controller
{
    public function advanceSearch(Request $request)
    {
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
        $locations=Location::all();
        $propertyTypes = PropertyType::all();

  
        // إرسال القيم المحددة مع العرض للحفاظ على القيم المحددة في النموذج
        return view('website.pages.advance-search', compact('properties','locations','propertyTypes'))->with($request->all());
    }
}
