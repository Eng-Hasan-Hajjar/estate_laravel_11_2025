<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
      // 1. عرض قائمة المستخدمين
      public function index()
      {
          // جلب جميع المستخدمين مع أدوارهم
          $users = User::with('roles')->paginate(10);
          return view('users.index', compact('users'));
      }
  
      // 2. عرض تفاصيل مستخدم محدد
      public function show($id)
      {
          // جلب المستخدم المحدد مع أدواره
          $user = User::with('roles')->findOrFail($id);
          return view('users.show', compact('user'));
      }
  
      // 3. عرض نموذج إضافة مستخدم جديد
      public function create()
      {
          // جلب جميع الأدوار لإسنادها للمستخدم الجديد
          $roles = Role::all();
          return view('users.create', compact('roles'));
      }
  
      // 4. تخزين مستخدم جديد
      public function store(Request $request)
      {
          // التحقق من صحة المدخلات
          $validated = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email',
              'password' => 'required|string|min:6|confirmed',
              'role' => 'required|exists:roles,name',
          ]);
  
          // إنشاء المستخدم الجديد
          $user = User::create([
              'name' => $validated['name'],
              'email' => $validated['email'],
              'password' => bcrypt($validated['password']),
          ]);
  
          // تعيين الدور للمستخدم الجديد
          $user->assignRole($validated['role']);
  
          return redirect()->route('users.index')->with('success', 'User created and role assigned successfully.');
      }
  
      // 5. عرض نموذج تعديل المستخدم
      public function edit($id)
      {
          // جلب المستخدم والأدوار المتاحة
          $user = User::findOrFail($id);
          $roles = Role::all();
          return view('users.edit', compact('user', 'roles'));
      }
  
      // 6. تحديث بيانات المستخدم
      public function update(Request $request, $id)
      {
          // التحقق من صحة المدخلات
          $validated = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email,' . $id,
              'password' => 'nullable|string|min:6|confirmed',
              'role' => 'required|exists:roles,name',
          ]);
  
          // جلب المستخدم من قاعدة البيانات
          $user = User::findOrFail($id);
  
          // تحديث بيانات المستخدم
          $user->update([
              'name' => $validated['name'],
              'email' => $validated['email'],
              'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
          ]);
  
          // تحديث الدور المخصص للمستخدم
          $user->syncRoles([$validated['role']]);
  
          return redirect()->route('users.index')->with('success', 'User updated and role changed successfully.');
      }
  
      // 7. حذف مستخدم
      public function destroy($id)
      {
          // جلب المستخدم
          $user = User::findOrFail($id);
  
          // حذف المستخدم
          $user->delete();
  
          return redirect()->route('users.index')->with('success', 'User deleted successfully.');
      }
}
