<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
class RoleController extends Controller
{
     // عرض جميع الأدوار
     public function index()
     {
         $roles = Role::all();
         return view('admin.roles.index', compact('roles'));
     }
     // عرض نموذج إنشاء دور جديد
     public function create()
     {
         $permissions = Permission::all();
         return view('admin.roles.create', compact('permissions'));
     }
     // حفظ دور جديد
     public function store(Request $request)
     {
         $role = Role::create(['name' => $request->name]);
         $role->syncPermissions($request->permissions); // تعيين الصلاحيات للدور
         return redirect()->route('roles.index')->with('success', 'Role created successfully.');
     }
 
     // عرض نموذج تعديل دور
     public function edit($id)
     {
         $role = Role::findOrFail($id);
         $permissions = Permission::all();
         return view('admin.roles.edit', compact('role', 'permissions'));
     }
 
     // تحديث دور
     public function update(Request $request, $id)
     {
         $role = Role::findOrFail($id);
         $role->update(['name' => $request->name]);
         $role->syncPermissions($request->permissions); // تحديث الصلاحيات للدور
         return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
     }
 
     // حذف دور
     public function destroy($id)
     {
         $role = Role::findOrFail($id);
         $role->delete();
         return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
     }
}
