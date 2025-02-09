<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PropertyType;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\Rating;
use App\Models\PropertyImage;
use App\Models\Comment;


class AdminDashboardController extends Controller
{
    
    public function dashboard()
    {

           // إحصاءات العقارات
    $availableProperties = Property::where('status', 'available')->count();
    $soldProperties = Property::where('status', 'sold')->count();
    $rentedProperties = Property::where('status', 'rented')->count();

    // إحصاءات المواقع والمناطق وأنواع العقارات
    $totalLocations = Location::count();
    $totalRegions = Region::count();
    $totalPropertyTypes = PropertyType::count();

    // إحصاءات أخرى

    // أحدث العقارات
    $latestProperties = Property::with(['location', 'propertyType'])
                                ->latest()
                                ->take(4)
                                ->get();

    // أحدث التعليقات
    $latestComments = Comment::with(['user', 'property'])
                             ->latest()
                             ->take(4)
                             ->get();

    // أحدث المستخدمين
    $latestUsers = User::latest()
                       ->take(5)
                       ->get();


        // جلب عدد العقارات
        $totalProperties = Property::count();
    
        // جلب عدد التقييمات
        $totalReviews = Rating::count();
    
        // جلب عدد التعليقات
        $totalComments = Comment::count();
    
        // جلب عدد الصور
        $totalImages = PropertyImage::count();
    
        // جلب عدد المستخدمين
        $totalUsers = User::count();
    



        $user = auth()->user(); // إذا كان المستخدم مسجل الدخول
        $visitCount = session('visit_count', 0) + 1;
        session(['visit_count' => $visitCount]);
    
        // تحديث عدد الزيارات في قاعدة البيانات
        if ($user) {
            $user->visit_count = $visitCount;
            $user->save();
        }


        $totalVisits =auth()->user()->visit_count; // عدد الزيارات 
      //  dd($totalVisits);
        $monthlyProperties = Property::whereMonth('created_at', now()->month)->count();
       
       // $completedTransactions = Transaction::count(); // عدد المعاملات المكتملة


        // تمرير المتغيرات إلى العرض
        return view('dashboard', compact(
            
            'monthlyProperties', 'totalVisits', 
            'totalProperties', 'totalReviews', 'totalComments', 'totalImages', 'totalUsers'
        
        
           ,
            'availableProperties',
            'soldProperties',
            'rentedProperties',
            'totalLocations',
            'totalRegions',
            'totalPropertyTypes',
          
      
            'latestProperties',
            'latestComments',
            'latestUsers'
        
        ));
    }
    

    public function trackVisit(Request $request)
{
   

    
}

    
}
