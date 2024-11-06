<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 // روابط التحكم بالمستخدمين 
 Route::get('/users', [UserController::class, 'index'])->name('users.index'); // عرض قائمة المستخدمين
 Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // إضافة مستخدم جديد
 Route::post('/users', [UserController::class, 'store'])->name('users.store'); // تخزين مستخدم جديد
 Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show'); // عرض تفاصيل مستخدم معين
 Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // تعديل مستخدم
 Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); // تحديث بيانات المستخدم
 Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // حذف مستخدم





use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserRoleController;

Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('users/roles', [UserRoleController::class, 'index'])->name('users.roles.index');
    Route::post('users/{user}/roles', [UserRoleController::class, 'assignRole'])->name('users.roles.assign');
});



Route::get('admin-page',function(){
    return view('admin.index');
});
Route::get('template',function(){
    return view('website.index');
});




use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyImageController;

Route::resource('properties', PropertyController::class);
Route::resource('properties.property-images', PropertyImageController::class);





/*   website   */
Route::get('indexproperty',function(){
    return view('website.index');
});
Route::get('about-web',function(){
    return view('website.pages.about');
});


Route::get('property-agent-web',function(){
    return view('website.pages.property-agent');
});

Route::get('property-list-web',[PropertyController::class, 'propertyList']);



Route::get('property-type-web',function(){
    return view('website.pages.property-type');
});

Route::get('advance-search',function(){
    return view('website.pages.advance-search');
});