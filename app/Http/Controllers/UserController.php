<?php

namespace App\Http\Controllers;


use App\Models\Role;
use Illuminate\Http\Request;


use App\Models\User; // تأكد من إضافة هذه السطر
class UserController extends Controller
{
      // 1. عرض قائمة المستخدمين
      public function index()
      {
        // جلب جميع المستخدمين
        $users = User::with('roles')->get();

        // التأكد من وجود المستخدم
        $user = User::find(1);
        if ($user) {
            // إنشاء الدور إذا لم يكن موجودًا
            $adminRole = Role::firstOrCreate(['name' => 'admin']);

            // التحقق من عدم وجود الدور قبل الإضافة لمنع التكرار
            if (!$user->roles()->where('role_id', $adminRole->id)->exists()) {
                $user->roles()->attach($adminRole->id);
            }
        }

        return view('admin.users.index', compact('users'));
       
      }
  
      // 2. عرض تفاصيل مستخدم محدد
      public function show($id)
      {
          // جلب المستخدم المحدد مع أدواره
          
          $user = User::with('roles')->findOrFail($id);
          return view('admin.users.show', compact('user'));
      }
  
      // 3. عرض نموذج إضافة مستخدم جديد
      public function create()
      {
          // جلب جميع الأدوار لإسنادها للمستخدم الجديد
          $roles = Role::all();
          return view('admin.users.create', compact('roles'));
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
      
          // إسناد الدور للمستخدم الجديد مع التأكد من عدم التكرار
          $role = Role::where('name', $validated['role'])->first();
          if ($role) {
              $user->roles()->sync([$role->id]); // يزيل الأدوار السابقة ويضيف الدور الجديد
          }
      
          return redirect()->route('users.index')->with('success', 'User created and role assigned successfully.');
      }
  
      // 5. عرض نموذج تعديل المستخدم
      public function edit($id)
      {
          // جلب المستخدم والأدوار المتاحة
          $user = User::with('roles')->findOrFail($id);
         
     
          $roles = Role::all();
          return view('admin.users.edit', compact('user', 'roles'));
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
      
          // تحديث الدور الجديد مع التأكد من عدم التكرار
          $role = Role::where('name', $validated['role'])->first();
          if ($role) {
              $user->roles()->sync([$role->id]);
          }
      
          return redirect()->route('users.index')->with('success', 'User updated and role changed successfully.');
      }
      // 7. حذف مستخدم
      public function destroy($id)
      {
        
          // جلب المستخدم
          $user = User::findOrFail($id);
        // التحقق مما إذا كان المستخدم ADMIN
        if ($user->roles->contains('name', 'admin')) {
            return redirect()->route('users.index')->with('error', 'Cannot delete an ADMIN user.');
        }
        else{
                // حذف المستخدم
                $user->delete();
                
        }
        
          return redirect()->route('users.index')->with('success', 'User deleted successfully.');
      }


  /**
     * إسناد دور للمستخدم
     */
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);
    
        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);
    
        if ($role) {
            $user->assignRole($role->name);
            return back()->with('success', "تم إسناد الدور {$role->name} للمستخدم {$user->name} بنجاح.");
        }
    
        return back()->with('error', 'حدث خطأ أثناء إسناد الدور.');
    }
    

    /**
     * إزالة دور من المستخدم
     */
    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role->name)) {
            $user->removeRole($role->name);
            return back()->with('success', "تم إزالة الدور {$role->name} من المستخدم {$user->name} بنجاح.");
        }

        return back()->with('error', 'لا يمكن إزالة دور غير موجود.');
    }














       // تعيين دور للمستخدم
    public function assignRoleToUser($userId, $roleName)
    {
        $user = User::findOrFail($userId);
        $user->assignRole($roleName); // تعيين دور للمستخدم
        return redirect()->back()->with('success', 'Role assigned successfully.');
    }


    // تعيين صلاحية مباشرة للمستخدم
    public function assignPermissionToUser($userId, $permissionName)
    {
        $user = User::findOrFail($userId);
        $user->givePermissionTo($permissionName); // تعيين صلاحية مباشرة للمستخدم
        return redirect()->back()->with('success', 'Permission assigned successfully.');
    }

    // إزالة دور من المستخدم
    public function removeRoleFromUser($userId, $roleName)
    {
        $user = User::findOrFail($userId);
        $user->removeRole($roleName); // إزالة دور من المستخدم
        return redirect()->back()->with('success', 'Role removed successfully.');
    }

    // إزالة صلاحية من المستخدم
    public function removePermissionFromUser($userId, $permissionName)
    {
        $user = User::findOrFail($userId);
        $user->revokePermissionTo($permissionName); // إزالة صلاحية من المستخدم
        return redirect()->back()->with('success', 'Permission removed successfully.');
    }


}
